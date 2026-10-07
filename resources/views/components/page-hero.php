<?php

use App\Core\View;

/**
 * Shared inner-page hero — the aurora gradient + glass eyebrow used across
 * the whole site (introduced alongside the new homepage). CSS-only (no
 * canvas/JS), so it's cheap to use on every page.
 *
 * Expects: $title (required), $eyebrow (optional), $subtitle (optional),
 * $cta (optional, pre-rendered HTML string — e.g. Html::button() calls),
 * $align ('center'|'left', default 'center').
 */
$eyebrow = $eyebrow ?? null;
$title = $title ?? '';
$subtitle = $subtitle ?? null;
$cta = $cta ?? null;
$align = $align ?? 'center';
$centered = $align === 'center';
?>
<section class="relative isolate overflow-hidden text-white">
    <div class="aurora" aria-hidden="true">
        <span class="aurora-blob aurora-blob--sky"></span>
        <span class="aurora-blob aurora-blob--deep"></span>
        <span class="aurora-blob aurora-blob--yellow"></span>
    </div>
    <div class="relative container-custom py-16 md:py-20 <?= $centered ? 'text-center' : '' ?>">
        <?php if ($eyebrow): ?>
            <span class="inline-flex items-center gap-2.5 rounded-full glass px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide" data-animate="fade-up">
                <span class="pulse-dot w-2 h-2 rounded-full bg-gold-500 text-gold-500"></span>
                <?= View::e($eyebrow) ?>
            </span>
        <?php endif; ?>
        <h1 class="mt-5 text-3xl md:text-5xl font-semibold tracking-tight leading-[1.1] text-white <?= $centered ? 'max-w-3xl mx-auto' : 'max-w-3xl' ?>" data-animate="fade-up" data-delay="80">
            <?= View::e($title) ?>
        </h1>
        <?php if ($subtitle): ?>
            <p class="mt-4 text-lg text-white/85 leading-relaxed <?= $centered ? 'max-w-2xl mx-auto' : 'max-w-2xl' ?>" data-animate="fade-up" data-delay="160">
                <?= View::e($subtitle) ?>
            </p>
        <?php endif; ?>
        <?php if ($cta): ?>
            <div class="mt-8 flex flex-wrap items-center gap-4 <?= $centered ? 'justify-center' : '' ?>" data-animate="fade-up" data-delay="240">
                <?= $cta ?>
            </div>
        <?php endif; ?>
    </div>
    <svg class="hero-wave absolute bottom-0 inset-x-0 text-white" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true"><path fill="currentColor" d="M0 60V28C240 4 480 0 720 14s480 26 720 4v42z"/></svg>
</section>
