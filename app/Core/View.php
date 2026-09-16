<?php

namespace App\Core;

class View
{
    private static string $basePath = __DIR__ . '/../../resources/views/';

    public static function render(string $view, array $data = [], ?string $layout = 'layouts/base'): void
    {
        $content = self::capture($view, $data);

        if ($layout === null) {
            echo $content;
            return;
        }

        echo self::capture($layout, array_merge($data, ['content' => $content]));
    }

    public static function capture(string $view, array $data = []): string
    {
        $path = self::$basePath . $view . '.php';

        if (!is_file($path)) {
            throw new \RuntimeException("View not found: {$view}");
        }

        extract($data, EXTR_SKIP);
        ob_start();
        include $path;
        return ob_get_clean();
    }

    public static function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}
