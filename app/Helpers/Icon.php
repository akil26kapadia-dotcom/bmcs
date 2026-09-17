<?php

namespace App\Helpers;

/**
 * Small shared inline-SVG icon set (Heroicons-style paths) used across
 * service/category cards, the trust strip, and the Why BMCS section.
 */
class Icon
{
    private const PATHS = [
        'network' => '<circle cx="4.5" cy="5" r="2.2"/><circle cx="15.5" cy="5" r="2.2"/><circle cx="10" cy="15.5" r="2.2"/><path d="M6.3 6.3L8.6 13M13.7 6.3L11.4 13M6.7 5H13.3" stroke="currentColor" stroke-width="1.4" fill="none" stroke-linecap="round"/>',
        'server' => '<rect x="3" y="3" width="14" height="5" rx="1.2"/><rect x="3" y="12" width="14" height="5" rx="1.2"/><circle cx="6.2" cy="5.5" r="0.9" fill="#fff" fill-opacity="0.85"/><circle cx="6.2" cy="14.5" r="0.9" fill="#fff" fill-opacity="0.85"/>',
        'cloud' => '<path d="M5.5 13a3.5 3.5 0 01-.42-6.98A4.5 4.5 0 0113.9 7.3 3.5 3.5 0 0114 13H5.5z"/>',
        'shield' => '<path fill-rule="evenodd" d="M10 1l7 3v5c0 4.5-3 8.2-7 9-4-.8-7-4.5-7-9V4l7-3z" clip-rule="evenodd"/>',
        'phone' => '<path d="M3.5 3A1.5 1.5 0 002 4.5v.5c0 7.732 6.268 14 14 14h.5a1.5 1.5 0 001.5-1.5v-2.086a1.5 1.5 0 00-1.048-1.43l-3.176-1.058a1.5 1.5 0 00-1.638.44l-.72.84a11.04 11.04 0 01-5.124-5.124l.84-.72a1.5 1.5 0 00.44-1.638L6.516 3.048A1.5 1.5 0 005.086 2H3.5z"/>',
        'monitor' => '<path fill-rule="evenodd" d="M2 4a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2h-4l1 3h1a1 1 0 110 2H8a1 1 0 110-2h1l1-3H4a2 2 0 01-2-2V4zm2 0v8h12V4H4z" clip-rule="evenodd"/>',
        'briefcase' => '<path fill-rule="evenodd" d="M6 4a2 2 0 012-2h4a2 2 0 012 2v1h2a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V7a2 2 0 012-2h2V4zm2 1h4V4H8v1zM4 7v8h12V7H4z" clip-rule="evenodd"/>',
        'life-buoy' => '<path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 3a5 5 0 015 5 5 5 0 01-5 5 5 5 0 01-5-5 5 5 0 015-5zm0 2a3 3 0 100 6 3 3 0 000-6z" clip-rule="evenodd"/>',
        'projector' => '<path fill-rule="evenodd" d="M3 6a2 2 0 012-2h10a2 2 0 012 2v2a2 2 0 01-2 2h-.17a3 3 0 11-5.66 0H7.83a3 3 0 11-5.66 0H2a1 1 0 010-2V6zm7 7a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>',
        'coin' => '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v.163a2.5 2.5 0 00-1.75 2.337c0 1.28.932 2.096 2.166 2.42l.834.22c.86.226 1 .55 1 .81 0 .36-.386.75-1.25.75-.71 0-1.14-.34-1.28-.66a.75.75 0 10-1.38.58c.34.79 1.09 1.31 1.91 1.47v.16a.75.75 0 001.5 0v-.163a2.5 2.5 0 001.75-2.337c0-1.28-.932-2.096-2.166-2.42l-.834-.22c-.86-.226-1-.55-1-.81 0-.36.386-.75 1.25-.75.71 0 1.14.34 1.28.66a.75.75 0 101.38-.58c-.34-.79-1.09-1.31-1.91-1.47v-.16z" clip-rule="evenodd"/>',
        'badge' => '<path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a.75.75 0 00-1.214-.882l-2.474 3.4-1.187-1.187a.75.75 0 10-1.06 1.06l1.8 1.8a.75.75 0 001.137-.089l3-4.1z" clip-rule="evenodd"/>',
        'heart' => '<path d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.128 12.688 2 10.328 2 7.5 2 5.014 4.014 3 6.5 3c1.376 0 2.61.622 3.5 1.601C10.89 3.622 12.124 3 13.5 3 15.986 3 18 5.014 18 7.5c0 2.828-2.128 5.188-3.885 6.82a22.045 22.045 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z"/>',
        'layers' => '<path d="M9.653 1.649a.75.75 0 01.694 0l7.25 3.792a.75.75 0 010 1.318L10.347 10.55a.75.75 0 01-.694 0L2.403 6.759a.75.75 0 010-1.318l7.25-3.792zM2.403 9.759L9.653 13.55a.75.75 0 00.694 0l7.25-3.792 1.5.784a.75.75 0 010 1.318l-8.25 4.318a.75.75 0 01-.694 0L1.903 11.86a.75.75 0 010-1.318l1.5-.784z"/>',
        'check' => '<path fill-rule="evenodd" d="M16.704 5.29a1 1 0 00-1.408-1.42l-7.3 7.24-3.29-3.26a1 1 0 00-1.41 1.42l4 3.96a1 1 0 001.41 0l8-7.94z" clip-rule="evenodd"/>',
        'arrow-right' => '<path d="M4 10h12M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" fill="none"/>',
    ];

    public static function raw(string $name): string
    {
        return self::PATHS[$name] ?? '';
    }

    public static function svg(string $name, string $class = 'w-6 h-6'): string
    {
        return '<svg class="' . htmlspecialchars($class, ENT_QUOTES) . '" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">'
            . self::raw($name) . '</svg>';
    }
}
