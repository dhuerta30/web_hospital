<?php
namespace App\core;

class ArtifyStencil
{
    protected string $cachePath;
    protected string $viewPath;

    protected array $sections = [];
    protected array $sectionStack = [];

    public function __construct()
    {
        $this->cachePath = __DIR__ . '/cache/';
        $this->viewPath  = __DIR__ . '/../Views/';
    }

    /* =========================
       RENDER
    ========================= */
    public function render(string $view, array $data = []): string
    {
        $viewFile = $this->viewPath . $view . '.php';
        $compiled = $this->getCompiledPath($viewFile);

        if (!file_exists($compiled) || filemtime($viewFile) > filemtime($compiled)) {
            $this->compile($viewFile, $compiled);
        }

        extract($data, EXTR_SKIP);
        $__env = $this;

        ob_start();
        include $compiled;
        return ob_get_clean();
    }

    protected function getCompiledPath(string $viewFile): string
    {
        return $this->cachePath . md5($viewFile) . '.php';
    }

    /* =========================
       SECTIONS (Blade-style)
    ========================= */
    public function startSection(string $name): void
    {
        $this->sectionStack[] = $name;
        ob_start();
    }

    public function endSection(): void
    {
        $name = array_pop($this->sectionStack);
        $this->sections[$name] = ob_get_clean();
    }

    public function yieldSection(string $name): void
    {
        echo $this->sections[$name] ?? '';
    }

    /* =========================
       COMPILER
    ========================= */
    protected function compile(string $viewFile, string $compiledFile): void
    {
        if (!is_dir($this->cachePath)) {
            mkdir($this->cachePath, 0777, true);
        }

        $content = file_get_contents($viewFile);

        /* ---------- ECHO ---------- */

        // {!! $var !!}
        $content = preg_replace(
            '/\{!!\s*(.*?)\s*!!\}/s',
            '<?php echo $1; ?>',
            $content
        );

        // {{ $var }}
        $content = preg_replace_callback(
            '/\{\{\s*(.*?)\s*\}\}/s',
            fn($m) => "<?php echo htmlspecialchars({$m[1]}, ENT_QUOTES, 'UTF-8'); ?>",
            $content
        );

        /* ---------- CONTROL ---------- */

        $content = preg_replace('/@if\s*\((.*?)\)/', '<?php if ($1): ?>', $content);
        $content = preg_replace('/@elseif\s*\((.*?)\)/', '<?php elseif ($1): ?>', $content);
        $content = preg_replace('/@else/', '<?php else: ?>', $content);
        $content = preg_replace('/@endif/', '<?php endif; ?>', $content);

        $content = preg_replace('/@foreach\s*\((.*?)\)/', '<?php foreach ($1): ?>', $content);
        $content = preg_replace('/@endforeach/', '<?php endforeach; ?>', $content);

        /* ---------- PHP ---------- */

        $content = preg_replace('/@php\s*(.*?)\s*@endphp/s', '<?php $1 ?>', $content);

        /* ---------- SECTIONS ---------- */

        $content = preg_replace(
            '/@section\s*\(\s*[\'"](.*?)[\'"]\s*\)/',
            '<?php $__env->startSection(\'$1\'); ?>',
            $content
        );

        $content = preg_replace(
            '/@endsection/',
            '<?php $__env->endSection(); ?>',
            $content
        );

        $content = preg_replace(
            '/@yield\s*\(\s*[\'"](.*?)[\'"]\s*\)/',
            '<?php $__env->yieldSection(\'$1\'); ?>',
            $content
        );

        /* ---------- INCLUDE ---------- */

        $content = preg_replace_callback(
            '/@include\s*\(\s*[\'"](.+?)[\'"]\s*(?:,\s*(\[[^\)]*\]))?\)/',
            function ($m) {
                $view = $m[1];
                $data = $m[2] ?? '[]';
                return "<?php echo (new \\App\\core\\ArtifyStencil())->render('$view', $data); ?>";
            },
            $content
        );

        /* ---------- EXTENDS ---------- */

        if (preg_match('/@extends\s*\(\s*[\'"](.*?)[\'"]\s*\)/', $content, $m)) {

            $layout = $m[1];
            $layoutFile = $this->viewPath . $layout . '.php';
            $compiledLayout = $this->getCompiledPath($layoutFile);

            if (!file_exists($compiledLayout) || filemtime($layoutFile) > filemtime($compiledLayout)) {
                $this->compile($layoutFile, $compiledLayout);
            }

            $content = preg_replace('/@extends\s*\(\s*[\'"](.*?)[\'"]\s*\)/', '', $content);
            $content .= "\n<?php include '$compiledLayout'; ?>";
        }

        file_put_contents($compiledFile, $content);
    }
}
