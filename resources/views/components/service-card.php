<?php

use App\Core\View;
use App\Helpers\Icon;

/** Expects $service (row from services table) and optional $icon override. */
$service = $service ?? [];
$iconName = $icon ?? 'network';
$delay = $delay ?? 0;
?>
<a href="/services/<?= View::e($service['slug']) ?>" class="group card card-hover p-7 flex flex-col" data-animate="fade-up" data-delay="<?= (int) $delay ?>">
    <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-navy-950 text-gold-400">
        <?= Icon::svg($iconName, 'w-6 h-6') ?>
    </span>
    <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($service['name']) ?></h3>
    <p class="mt-2 text-sm text-ink-500 leading-relaxed flex-1"><?= View::e($service['short_description'] ?? '') ?></p>
    <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-gold-600 group-hover:gap-2.5 transition-all">
        Learn more
        <?= Icon::svg('arrow-right', 'w-4 h-4') ?>
    </span>
</a>
