<?php

use App\Core\View;
use App\Helpers\Icon;

/** Expects $category (row from service_categories table). */
$category = $category ?? [];
$delay = $delay ?? 0;
?>
<a href="/solutions/<?= View::e($category['slug']) ?>" class="group card card-hover p-7 flex flex-col" data-animate="fade-up" data-delay="<?= (int) $delay ?>">
    <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-navy-950 text-gold-400">
        <?= Icon::svg($category['icon'] ?? 'network', 'w-6 h-6') ?>
    </span>
    <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($category['name']) ?></h3>
    <p class="mt-2 text-sm text-ink-500 leading-relaxed flex-1">
        <?= View::e($category['description'] ?: 'Explore our ' . $category['name'] . ' capabilities.') ?>
    </p>
    <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-gold-600 group-hover:gap-2.5 transition-all">
        Learn more
        <?= Icon::svg('arrow-right', 'w-4 h-4') ?>
    </span>
</a>
