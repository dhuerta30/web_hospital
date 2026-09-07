<?php

namespace App\core;

class Security
{
    public const INACTIVIDAD_MINUTOS = 30;

    public const ROTACION_MINUTOS = 15;

    private static $cabecerasEnviadas = false;

    public static function boot(): void
    {
        self::enviarCabeceras();
        self::configurarCookieSesion();
    }

    public static function enviarCabeceras(): void
    {
        if (self::$cabecerasEnviadas || headers_sent()) {
            return;
        }
        self::$cabecerasEnviadas = true;

        header_remove('X-Powered-By');

        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('Referrer-Policy: strict-origin-when-cross-origin');
        header('Permissions-Policy: geolocation=(), microphone=(), camera=(), payment=()');
        header('Cross-Origin-Opener-Policy: same-origin');
        if (self::esHttps()) {
            header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
        }

        header('Content-Security-Policy: ' . self::politicaCSP());
    }

    public static function politicaCSP(): string
    {
        $propio = "'self'";

        $directivas = [
            "default-src {$propio}",
            "base-uri {$propio}",
            "object-src 'none'",
            "frame-ancestors 'none'",
            "form-action {$propio}",
            "img-src {$propio} data: https:",
            "font-src {$propio} data: https://fonts.gstatic.com https://cdnjs.cloudflare.com",
            "style-src {$propio} 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com",
            "script-src {$propio} 'unsafe-inline' https://cdnjs.cloudflare.com",
            "connect-src {$propio}",
            "frame-src {$propio} https://www.youtube.com https://youcanbook.me",
        ];

        return implode('; ', $directivas);
    }

    public static function esHttps(): bool
    {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return true;
        }
        if (($_SERVER['SERVER_PORT'] ?? null) == 443) {
            return true;
        }

        if (strtolower($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https') {
            return true;
        }
        return false;
    }

    public static function configurarCookieSesion(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }

        ini_set('session.use_strict_mode', '1');
        ini_set('session.use_only_cookies', '1');
        ini_set('session.cookie_httponly', '1');
        ini_set('session.sid_length', '48');
        ini_set('session.sid_bits_per_character', '6');

        session_set_cookie_params([
            'lifetime' => 0,
            'path'     => '/',
            'domain'   => '',
            'secure'   => self::esHttps(),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    public static function vigilarSesion(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return true;
        }

        $ahora = time();

        if (isset($_SESSION['_ultima_actividad'])) {
            $inactivo = $ahora - (int) $_SESSION['_ultima_actividad'];
            if ($inactivo > self::INACTIVIDAD_MINUTOS * 60) {
                self::cerrarSesion();
                return false;
            }
        }
        $_SESSION['_ultima_actividad'] = $ahora;

        if (!isset($_SESSION['_creada'])) {
            $_SESSION['_creada'] = $ahora;
        } elseif ($ahora - (int) $_SESSION['_creada'] > self::ROTACION_MINUTOS * 60) {
            session_regenerate_id(true);
            $_SESSION['_creada'] = $ahora;
        }

        return true;
    }

    public static function cerrarSesion(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            return;
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $p = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                [
                    'expires'  => time() - 42000,
                    'path'     => $p['path'],
                    'domain'   => $p['domain'],
                    'secure'   => $p['secure'],
                    'httponly' => $p['httponly'],
                    'samesite' => $p['samesite'] ?? 'Lax',
                ]
            );
        }

        session_destroy();
    }

    public static function tokenCsrf(string $formulario = 'default'): string
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            @session_start();
        }

        if (empty($_SESSION['_csrf'][$formulario])) {
            $_SESSION['_csrf'][$formulario] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf'][$formulario];
    }

    public static function verificarCsrf(string $formulario, $token): bool
    {
        if (!is_string($token) || $token === '') {
            return false;
        }
        $esperado = $_SESSION['_csrf'][$formulario] ?? null;
        if (!is_string($esperado) || $esperado === '') {
            return false;
        }
        return hash_equals($esperado, $token);
    }

    public static function campoCsrf(string $formulario = 'default'): string
    {
        return '<input type="hidden" name="auth_token" value="'
            . self::e(self::tokenCsrf($formulario)) . '">';
    }

    public static function e($valor): string
    {
        return htmlspecialchars((string) $valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    public static function eUrl($url): string
    {
        $url = trim((string) $url);

        if ($url === '') {
            return '#';
        }

        $esquema = strtolower((string) parse_url($url, PHP_URL_SCHEME));
        $peligrosos = ['javascript', 'data', 'vbscript', 'file'];

        if ($esquema !== '' && in_array($esquema, $peligrosos, true)) {
            return '#';
        }

        if ($esquema !== '' && !in_array($esquema, ['http', 'https', 'mailto', 'tel'], true)) {
            return '#';
        }

        return self::e($url);
    }

    public static function eJs($valor): string
    {
        return json_encode(
            $valor,
            JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE
        );
    }

    public static function apuntaARedInterna($url): bool
    {
        $host = parse_url(trim((string) $url), PHP_URL_HOST);

        if (!$host) {
            return false;
        }

        $host = trim($host, '[]'); 

        if (!filter_var($host, FILTER_VALIDATE_IP)) {
            $sufijosInternos = ['.local', '.lan', '.internal', '.intranet', '.corp'];
            $hostMin = strtolower($host);
            foreach ($sufijosInternos as $sufijo) {
                if (substr($hostMin, -strlen($sufijo)) === $sufijo) {
                    return true;
                }
            }
            return false;
        }

        $esPublica = filter_var(
            $host,
            FILTER_VALIDATE_IP,
            FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE
        );

        return $esPublica === false;
    }

    public static function html($html): string
    {
        $html = html_entity_decode((string)$html, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        if (preg_match('/<script/i', $html)) {
            return '';
        }

        if (preg_match('/on[a-z]+\s*=/i', $html)) {
            return '';
        }

        return $html;
    }

    public static function urlPublicaSegura($url, string $reemplazo = '#'): string
    {
        $permitidas = [
            '10.63.247.125',
        ];
        $host = parse_url($url, PHP_URL_HOST);
        if (in_array($host, $permitidas, true)) {
            return (string)$url;
        }
        if (self::apuntaARedInterna($url)) {
            self::registrar(
                'URL interna bloqueada en el HTML público (hallazgo 4.1). '
                . 'Corregir el registro en la base de datos. Valor: ' . $url
            );
            return $reemplazo;
        }
        return (string) $url;
    }

    public static function href($url, string $reemplazo = '#'): string
    {
        return self::eUrl(self::urlPublicaSegura($url, $reemplazo));
    }

    public static function nombreArchivoSeguro(string $nombreOriginal): string
    {
        $nombreOriginal = basename($nombreOriginal);
        $ext  = strtolower((string) pathinfo($nombreOriginal, PATHINFO_EXTENSION));
        $base = (string) pathinfo($nombreOriginal, PATHINFO_FILENAME);
        $base = preg_replace('/[^A-Za-z0-9._-]/', '_', $base);
        $base = trim((string) $base, '._-');
        $base = substr($base !== '' ? $base : 'archivo', 0, 60);
        $ext = preg_replace('/[^a-z0-9]/', '', $ext);
        $aleatorio = bin2hex(random_bytes(8));
        return time() . '_' . $aleatorio . '_' . $base . ($ext !== '' ? '.' . $ext : '');
    }

    public static function extensionEjecutable(string $nombreArchivo): bool
    {
        $prohibidas = [
            'php', 'php1', 'php2', 'php3', 'php4', 'php5', 'php6', 'php7', 'php8',
            'phtml', 'phtm', 'pht', 'phps', 'phar', 'pgif', 'inc', 'hphp', 'ctp',
            'htaccess', 'phtaccess', 'htpasswd', 'shtml', 'shtm', 'stm',
            'cgi', 'pl', 'py', 'sh', 'bash', 'rb', 'lua', 'asp', 'aspx', 'jsp',
            'jspx', 'cfm', 'cfc',
            'exe', 'dll', 'so', 'bat', 'cmd', 'com', 'msi', 'jar', 'vbs', 'ws',
            'wsf', 'ps1',
        ];
        $nombre = strtolower(basename($nombreArchivo));
        $segmentos = explode('.', $nombre);
        array_shift($segmentos);
        foreach ($segmentos as $seg) {
            $seg = trim($seg);
            if ($seg === '') {
                continue;
            }
            if (in_array($seg, $prohibidas, true)) {
                return true;
            }
            if (strpos($seg, 'php') !== false) {
                return true;
            }
        }
        return false;
    }

    public static function gridIdValido($id): bool
    {
        if (!is_string($id) || $id === '') {
            return false;
        }
        return (bool) preg_match('/^[A-Za-z0-9]{6,64}$/', $id);
    }

    public static function mismoOrigen(): bool
    {
        $hostSitio = strtolower((string) ($_SERVER['HTTP_HOST'] ?? ''));
        if ($hostSitio === '' && !empty($_ENV['DOMINIO'])) {
            $hostSitio = strtolower((string) parse_url($_ENV['DOMINIO'], PHP_URL_HOST));
        }
        if ($hostSitio === '') {
            return true;
        }
        foreach (['HTTP_ORIGIN', 'HTTP_REFERER'] as $cabecera) {
            if (empty($_SERVER[$cabecera])) {
                continue;
            }
            $hostPet = strtolower((string) parse_url($_SERVER[$cabecera], PHP_URL_HOST));
            if ($hostPet === '') {
                continue;
            }
            return $hostPet === $hostSitio;
        }
        return true;
    }

    public static function registrar(string $mensaje): void
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '-';
        error_log('[SEGURIDAD][' . date('c') . '][' . $ip . '] ' . $mensaje);
    }
}
