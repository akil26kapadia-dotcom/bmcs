<?php

namespace App\Helpers;

use App\Models\Setting;

/**
 * Memoized, failure-safe access to CMS settings for use in global layout
 * components (navbar/footer). Falls back to sensible defaults if the
 * database is unreachable, so an error page never fails a second time
 * just from rendering the header/footer.
 */
class SiteConfig
{
    private static ?array $settings = null;

    private const DEFAULTS = [
        'site_name' => 'Bright Mind Computer Solutions',
        'site_phone' => '+971 4 227 1773',
        'site_email' => 'info@bmcs.ae',
        'whatsapp_number' => '',
        'footer_text' => 'Empowering Effective Solutions.',
    ];

    public static function get(string $key, ?string $default = null): string
    {
        if (self::$settings === null) {
            try {
                self::$settings = Setting::allAsMap();
            } catch (\Throwable $e) {
                self::$settings = [];
            }
        }

        return self::$settings[$key] ?? $default ?? self::DEFAULTS[$key] ?? '';
    }
}
