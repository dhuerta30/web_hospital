<?php
/*
 * Compatibilidad PHP 8.0 - 8.4
 * Se silencian deprecaciones y avisos (E_DEPRECATED / E_NOTICE) generados por
 * librerías de terceros (propiedades dinámicas en 8.2+, paso de null a funciones
 * internas en 8.1+, etc.) para que NO se impriman antes de las respuestas JSON/AJAX
 * y rompan el frontend. No se ocultan errores ni excepciones reales.
 */
//error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT);

require('vendor/autoload.php');
$dotenv = DotenvVault\DotenvVault::createImmutable(__DIR__);
$dotenv->safeLoad();
require __DIR__ . '/app/libs/' . $_ENV["url_artify"];
require __DIR__ . '/app/libs/docufy/docufy.php';

use App\core\ArtifyRouter;
use App\core\Request;
use App\core\Security;

/*
 * Endurecimiento de seguridad — INF-CIBER-2026-10
 * Debe ejecutarse ANTES de cualquier salida y de cualquier session_start():
 *   - envía las cabeceras de seguridad (hallazgo 4.4)
 *   - fija los atributos seguros de la cookie de sesión (hallazgo 4.7)
 */
Security::boot();

$router = new ArtifyRouter();

// Definir rutas
$router->get('/', 'WebController@index');
$router->get('/admin', 'LoginController@index');
$router->get('/login', 'LoginController@index');
$router->get('/salir', 'LoginController@salir');
$router->get('/recuperar', 'LoginController@reset');

$router->get('/slider', 'sliderController@index');

$router->get('/modulos', 'HomeController@modulos');
$router->get('/usuarios', 'HomeController@usuarios');
$router->get('/perfil', 'HomeController@perfil');
$router->get('/respaldos', 'HomeController@respaldos');
$router->get('/menu', 'HomeController@menu');
$router->get('/acceso_menus', 'HomeController@acceso_menus');
$router->post('/generarToken', 'HomeController@generarToken');
$router->post('/obtener_campos_relacion_union_interna', 'HomeController@obtener_campos_relacion_union_interna');
$router->post('/obtener_id_tabla', 'HomeController@obtener_id_tabla');
$router->post('/obtener_tablas', 'HomeController@obtener_tablas');
$router->post('/obtener_columnas_tabla', 'HomeController@obtener_columnas_tabla');
$router->post('/obtener_tabla_id', 'HomeController@obtener_tabla_id');
$router->post('/refrescarMenu', 'HomeController@refrescarMenu');
$router->post('/generar_datos_usuario', 'HomeController@generar_datos_usuario');
$router->post('/export_db', 'HomeController@export_db');
$router->post('/editar_iconos_menu', 'HomeController@editar_iconos_menu');
$router->post('/actualizar_orden_menu', 'HomeController@actualizar_orden_menu');
$router->post('/actualizar_orden_submenu', 'HomeController@actualizar_orden_submenu');
$router->post('/asignar_menus_usuario', 'HomeController@asignar_menus_usuario');
$router->post('/obtener_menu_usuario', 'HomeController@obtener_menu_usuario');
$router->post('/obtener_campos_union_izquierda', 'HomeController@obtener_campos_union_izquierda');
$router->post('/cargar_imagenes_configuracion', 'HomeController@cargar_imagenes_configuracion');
$router->post('/cargar_vista_submenu', 'HomeController@cargar_vista_submenu');

$router->get('/Configuracion', 'ConfiguracionController@index');
$router->get('/Slider', 'SliderController@index');

$router->get('/documentacion', 'DocumentacionController@documentacion');
$router->get('/error', 'ErrorController@index');

$router->get('/hola', 'UserController@index');
$router->get('/usuario/{id}/{val}/{val}', 'UserController@show');

$router->post('/buscar_noticias', 'WebController@buscar_noticias');
$router->get('/noticia/{titulo}', 'WebController@noticia');

$router->get('/pagina/{titulo}', 'WebController@page');

/* Api Controllers */
$router->post('/Restp/generarToken', 'RestpController@generarToken');

$router->get('/Restp/listar/{tabla}/{token}', 'RestpController@listar');
$router->get('/Restp/listar/{tabla}/{filtro_url}/{token}', 'RestpController@listar');
$router->get('/noticias', 'NoticiasController@index');
$router->get('/paginas', 'PaginaController@index');
$router->get('/carga_masiva_noticias', 'NoticiasController@carga_masiva_noticias');

$router->get('/web_menu', 'MenuWebController@index');

$router->post('/Restp/insertar', 'RestpController@insertar');
$router->post('/Restp/actualizar', 'RestpController@actualizar');
$router->post('/Restp/eliminar', 'RestpController@eliminar');

$additionalRoutesPath = __DIR__ . '/app/core/extra_routes.php';

if (file_exists($additionalRoutesPath)) {
    $additionalRoutes = require $additionalRoutesPath;
    $additionalRoutes($router);
}

$request = new Request();
$router->dispatch($request);
