<?php

namespace App\Helpers;

use App\Core\View;

/**
 * Central SEO tag builder. Pages pass their specific values in;
 * this class is the only place that knows how the tags are assembled,
 * so head markup is never duplicated per page.
 */
class SEO
{
    public static function title(?string $pageTitle, string $siteName): string
    {
        $pageTitle = trim((string) $pageTitle);
        return $pageTitle === '' ? $siteName : "{$pageTitle} | {$siteName}";
    }

    public static function description(?string $description, string $fallback): string
    {
        $description = trim((string) $description);
        return $description === '' ? $fallback : $description;
    }

    public static function canonical(string $baseUrl, string $path): string
    {
        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }

    /**
     * @param array{title:string,description:string,url:string,image?:string,type?:string} $data
     */
    public static function openGraph(array $data): string
    {
        $tags = [
            'og:title' => $data['title'],
            'og:description' => $data['description'],
            'og:url' => $data['url'],
            'og:type' => $data['type'] ?? 'website',
        ];

        if (!empty($data['image'])) {
            $tags['og:image'] = $data['image'];
        }

        $html = '';
        foreach ($tags as $property => $content) {
            $html .= sprintf(
                '<meta property="%s" content="%s">' . "\n",
                View::e($property),
                View::e($content)
            );
        }

        $html .= sprintf('<meta name="twitter:card" content="%s">' . "\n", empty($data['image']) ? 'summary' : 'summary_large_image');
        $html .= sprintf('<meta name="twitter:title" content="%s">' . "\n", View::e($data['title']));
        $html .= sprintf('<meta name="twitter:description" content="%s">' . "\n", View::e($data['description']));

        return $html;
    }

    /**
     * Renders a JSON-LD script tag from an associative schema.org array.
     */
    public static function schema(array $data): string
    {
        return '<script type="application/ld+json">' .
            json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
            '</script>';
    }

    public static function breadcrumbSchema(array $items): array
    {
        $listItems = [];
        foreach ($items as $index => $item) {
            $listItems[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $item['name'],
                'item' => $item['url'],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $listItems,
        ];
    }
}
