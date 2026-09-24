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

    /**
     * wa.me link for the configured WhatsApp number, optionally with a
     * pre-filled message. Returns '' when no number is configured.
     */
    public static function whatsappUrl(?string $message = null): string
    {
        $number = preg_replace('/[^0-9]/', '', (string) SiteConfig::get('whatsapp_number'));
        if ($number === '') {
            return '';
        }

        return 'https://wa.me/' . $number . ($message ? '?text=' . rawurlencode($message) : '');
    }

    /** Outlined WhatsApp button (opens in a new tab); empty when not configured. */
    public static function whatsappButton(string $label = 'WhatsApp Us', ?string $message = null, string $variant = 'outline-light', string $class = ''): string
    {
        $url = self::whatsappUrl($message);
        if ($url === '') {
            return '';
        }

        return sprintf(
            '<a href="%s" target="_blank" rel="noopener" class="%s">%s</a>',
            View::e($url),
            View::e(trim((self::VARIANT_CLASSES[$variant] ?? 'btn-outline-light') . ' ' . $class)),
            View::e($label)
        );
    }

    /** Call button using the main site phone number. */
    public static function callButton(string $label = 'Call BMCS', string $variant = 'outline-light', string $class = ''): string
    {
        $phone = (string) SiteConfig::get('site_phone');
        if ($phone === '') {
            return '';
        }

        return sprintf(
            '<a href="tel:%s" class="%s">%s</a>',
            View::e(preg_replace('/[^0-9+]/', '', $phone)),
            View::e(trim((self::VARIANT_CLASSES[$variant] ?? 'btn-outline-light') . ' ' . $class)),
            View::e($label)
        );
    }
}
