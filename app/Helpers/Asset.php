<?php

namespace App\Helpers;

use App\Core\View;

/**
 * Consistent, performance-friendly <img> markup: lazy-loaded by default,
 * with explicit dimensions to avoid layout shift. Pass eager=true for the
 * LCP image (e.g. the hero) so it is not lazy-loaded.
 */
class Asset
{
    /**
     * Appends a cache-busting query string (the file's mtime) to a public
     * asset path, so browsers and the host's CDN always fetch the current
     * build after a deploy instead of serving a stale cached copy.
     */
    public static function versioned(string $path): string
    {
        $fullPath = __DIR__ . '/../../public' . $path;
        $version = is_file($fullPath) ? filemtime($fullPath) : time();

        return $path . '?v=' . $version;
    }

    public static function img(
        string $src,
        string $alt,
        int $width,
        int $height,
        string $class = '',
        bool $eager = false
    ): string {
        return sprintf(
            '<img src="%s" alt="%s" width="%d" height="%d" class="%s" loading="%s" decoding="async">',
            View::e($src),
            View::e($alt),
            $width,
            $height,
            View::e($class),
            $eager ? 'eager' : 'lazy'
        );
    }
}
