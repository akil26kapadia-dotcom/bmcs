<?php

use App\Core\View;

/**
 * Animated "dashboard" illustration used inside a featured bento tile
 * (Tally and IT Services sections on the homepage). Shows an uploaded
 * image instead when one is set — see tile-photo in app.css for that path.
 * Expects: $image (string, possibly empty), $chips (array of up to 3 short labels).
 */
$image = $image ?? '';
$chips = $chips ?? [];
$chipClasses = ['mock-chip--1', 'mock-chip--2', 'mock-chip--3'];
?>
<div class="tile-media relative mt-6 flex-1 min-h-[210px] rounded-2xl overflow-hidden">
    <?php if ($image !== ''): ?>
        <img src="<?= View::e($image) ?>" alt="" class="tile-photo" loading="lazy" decoding="async">
        <span class="absolute inset-0" style="background:linear-gradient(180deg,rgba(42,103,178,.15),rgba(42,103,178,.65))" aria-hidden="true"></span>
    <?php else: ?>
        <div class="tile-mock" aria-hidden="true">
            <svg viewBox="0 0 400 220" class="w-full h-full" preserveAspectRatio="xMidYMid meet" fill="none">
                <rect x="8" y="8" width="384" height="204" rx="18" fill="rgba(255,255,255,.12)" stroke="rgba(255,255,255,.4)"/>
                <circle cx="30" cy="28" r="4.5" fill="#FFC632"/><circle cx="46" cy="28" r="4.5" fill="rgba(255,255,255,.55)"/><circle cx="62" cy="28" r="4.5" fill="rgba(255,255,255,.35)"/>
                <rect x="90" y="23" width="120" height="10" rx="5" fill="rgba(255,255,255,.3)"/>
                <g>
                    <rect class="mock-bar" x="28" y="90" width="22" height="90" rx="5" fill="rgba(255,255,255,.55)"/>
                    <rect class="mock-bar" x="60" y="70" width="22" height="110" rx="5" fill="#FFC632"/>
                    <rect class="mock-bar" x="92" y="105" width="22" height="75" rx="5" fill="rgba(255,255,255,.55)"/>
                    <rect class="mock-bar" x="124" y="60" width="22" height="120" rx="5" fill="#FFC632"/>
                    <rect class="mock-bar" x="156" y="85" width="22" height="95" rx="5" fill="rgba(255,255,255,.55)"/>
                    <rect class="mock-bar" x="188" y="50" width="22" height="130" rx="5" fill="#FFC632"/>
                </g>
                <path d="M232 150 C 262 140, 272 100, 300 108 S 340 60, 372 52" class="mock-line" stroke="#FFC632" stroke-width="3.5" stroke-linecap="round"/>
                <circle cx="372" cy="52" r="5" fill="#fff"/>
                <circle cx="300" cy="108" r="4" fill="rgba(255,255,255,.8)"/>
                <circle cx="336" cy="172" r="19" stroke="rgba(255,255,255,.25)" stroke-width="7"/>
                <circle cx="336" cy="172" r="19" class="mock-donut" stroke="#FFC632" stroke-width="7" stroke-linecap="round" transform="rotate(-90 336 172)"/>
                <g fill="rgba(255,255,255,.55)">
                    <rect class="mock-skel" x="232" y="168" width="70" height="7" rx="3.5"/>
                    <rect class="mock-skel" x="232" y="182" width="52" height="7" rx="3.5"/>
                    <rect class="mock-skel" x="232" y="196" width="62" height="7" rx="3.5"/>
                </g>
            </svg>
        </div>
    <?php endif; ?>
    <?php foreach (array_slice($chips, 0, 3) as $ci => $chip): ?>
        <span class="mock-chip <?= $chipClasses[$ci] ?>"><i></i><?= View::e($chip) ?></span>
    <?php endforeach; ?>
</div>
