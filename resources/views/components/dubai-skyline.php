<?php

use App\Core\View;

/**
 * Purely decorative Dubai skyline silhouette for hero sections (Burj Khalifa,
 * Burj Al Arab, generic towers, twinkling window lights, glowing horizon line).
 * No content lives here — safe to reorder or remove. Respects
 * prefers-reduced-motion via the global CSS rule in app.css.
 *
 * Optional $heightClass overrides the default band height (taller heroes,
 * like the homepage, have more vertical room to show more of the skyline).
 */
$heightClass = $heightClass ?? 'h-16 md:h-20 lg:h-24';
?>
<div class="absolute inset-x-0 bottom-0 h-40 md:h-56 skyline-sunglow pointer-events-none" aria-hidden="true"></div>

<svg class="absolute inset-x-0 bottom-0 w-full <?= View::e($heightClass) ?> pointer-events-none skyline-svg" viewBox="0 0 1440 220" preserveAspectRatio="none" aria-hidden="true">
    <defs>
        <linearGradient id="skylineFade" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#050c1a" stop-opacity="0" />
            <stop offset="100%" stop-color="#050c1a" stop-opacity="1" />
        </linearGradient>
    </defs>

    <!-- horizon glow line -->
    <line x1="0" y1="176" x2="1440" y2="176" class="skyline-horizon" />

    <!-- back row (further, lighter) -->
    <g fill="#0f1f3d" opacity="0.55">
        <rect x="40" y="120" width="46" height="56" />
        <rect x="150" y="100" width="34" height="76" />
        <rect x="260" y="130" width="52" height="46" />
        <rect x="980" y="110" width="40" height="66" />
        <rect x="1080" y="128" width="56" height="48" />
        <rect x="1200" y="96" width="36" height="80" />
        <rect x="1310" y="122" width="50" height="54" />
    </g>

    <!-- front row (closer, solid) -->
    <g fill="#0a1428">
        <rect x="0" y="150" width="38" height="26" />
        <rect x="95" y="132" width="42" height="44" />
        <rect x="190" y="150" width="30" height="26" />
        <rect x="330" y="112" width="44" height="64" />
        <rect x="385" y="140" width="36" height="36" />
        <rect x="430" y="122" width="50" height="54" />

        <!-- Burj Al Arab (sail) -->
        <path d="M540,176 L540,108 C558,96 578,96 596,110 C602,130 600,155 596,176 Z" />

        <rect x="770" y="126" width="46" height="50" />
        <rect x="830" y="104" width="34" height="72" />

        <!-- Burj Khalifa (tapering spire) -->
        <path d="M690,176 L690,90 L697,72 L704,52 L707,20 L710,52 L713,72 L720,90 L720,176 Z" />

        <rect x="1140" y="140" width="40" height="36" />
        <rect x="1250" y="116" width="38" height="60" />
        <rect x="1370" y="146" width="46" height="30" />
        <rect x="900" y="144" width="34" height="32" />
    </g>

    <!-- twinkling window lights -->
    <g class="skyline-light">
        <circle cx="107" cy="144" r="1.6" style="animation-delay:0.1s" />
        <circle cx="345" cy="128" r="1.6" style="animation-delay:0.8s" />
        <circle cx="398" cy="154" r="1.6" style="animation-delay:1.6s" />
        <circle cx="450" cy="140" r="1.6" style="animation-delay:0.4s" />
        <circle cx="782" cy="142" r="1.6" style="animation-delay:1.2s" />
        <circle cx="845" cy="122" r="1.6" style="animation-delay:2s" />
        <circle cx="1155" cy="156" r="1.6" style="animation-delay:0.6s" />
        <circle cx="1265" cy="134" r="1.6" style="animation-delay:1.4s" />
        <circle cx="1385" cy="160" r="1.6" style="animation-delay:2.4s" />
    </g>

    <!-- Burj Khalifa spire beacon -->
    <circle cx="710" cy="20" r="2.5" class="skyline-beacon" />

    <rect x="0" y="176" width="1440" height="44" fill="url(#skylineFade)" />
</svg>
