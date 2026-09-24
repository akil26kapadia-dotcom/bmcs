<?php

use App\Core\View;

/**
 * Expects: $title (required), $eyebrow, $subtitle, $align ('left'|'center'),
 * $onDark (bool) for use on navy-950 backgrounds.
 */
$eyebrow = $eyebrow ?? null;
$title = $title ?? '';
$subtitle = $subtitle ?? null;
$align = $align ?? 'left';
$onDark = $onDark ?? false;

$wrapClass = $align === 'center' ? 'text-center mx-auto' : 'text-left';
$maxWidth = $align === 'center' ? 'max-w-2xl' : 'max-w-xl';
$titleColor = $onDark ? 'text-white' : 'text-navy-950';
$subtitleColor = $onDark ? 'text-white/80' : 'text-ink-500';
$eyebrowClass = $onDark ? 'eyebrow-on-dark' : 'eyebrow';
?>
<div class="<?= $wrapClass ?> <?= $align === 'left' ? $maxWidth : '' ?>">
    <?php if ($eyebrow): ?>
        <span class="<?= $eyebrowClass ?> inline-flex items-center gap-3 <?= $align === 'center' ? 'justify-center' : '' ?>">
            <span class="h-px w-8 <?= $onDark ? 'bg-gold-400' : 'bg-gold-500' ?>"></span>
            <?= View::e($eyebrow) ?>
        </span>
    <?php endif; ?>
    <h2 class="mt-3 text-3xl md:text-4xl lg:text-[2.75rem] font-bold tracking-tight leading-[1.15] <?= $titleColor ?>">
        <?= View::e($title) ?>
    </h2>
    <?php if ($subtitle): ?>
        <p class="mt-4 text-base md:text-lg leading-relaxed <?= $subtitleColor ?> <?= $maxWidth ?> <?= $align === 'center' ? 'mx-auto' : '' ?>">
            <?= View::e($subtitle) ?>
        </p>
    <?php endif; ?>
</div>
