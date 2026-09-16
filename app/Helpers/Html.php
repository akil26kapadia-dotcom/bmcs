<?php

namespace App\Helpers;

use App\Core\View;

/**
 * Small inline-markup helpers for repeated atoms (buttons, etc.) that are
 * too small to warrant their own view partial file.
 */
class Html
{
    private const VARIANT_CLASSES = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'outline-light' => 'btn-outline-light',
        'outline-dark' => 'btn-outline-dark',
        'ghost' => 'btn-ghost',
    ];

    public static function button(array $opts): string
    {
        $href = $opts['href'] ?? '#';
        $label = $opts['label'] ?? '';
        $variant = self::VARIANT_CLASSES[$opts['variant'] ?? 'primary'] ?? self::VARIANT_CLASSES['primary'];
        $icon = $opts['icon'] ?? false;
        $class = trim($variant . ' ' . ($opts['class'] ?? ''));

        $arrow = $icon
            ? '<svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 10h12M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>'
            : '';

        return sprintf(
            '<a href="%s" class="group %s">%s%s</a>',
            View::e($href),
            View::e($class),
            View::e($label),
            $arrow
        );
    }
}
