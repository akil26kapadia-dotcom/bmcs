<?php

use App\Core\View;

/** Expects $project (row from portfolio_projects, optionally joined with category_name/category_slug). */
$project = $project ?? [];
$delay = $delay ?? 0;
?>
<a href="/portfolio/<?= View::e($project['slug']) ?>" class="group card card-hover overflow-hidden block h-full flex flex-col" data-animate="fade-up" data-delay="<?= (int) $delay ?>">
    <div class="relative h-56 overflow-hidden shrink-0">
        <img src="<?= View::e($project['featured_image']) ?>"
             alt="<?= View::e($project['title']) ?>"
             width="1000" height="750" loading="lazy" decoding="async"
             class="w-full h-full object-cover transition-transform duration-500 ease-premium group-hover:scale-105">
        <?php if (!empty($project['is_demo'])): ?>
            <span class="absolute top-3 left-3 bg-navy-950/90 text-gold-400 text-[11px] font-semibold uppercase tracking-wide px-2.5 py-1 rounded">Sample Project</span>
        <?php endif; ?>
    </div>
    <div class="p-6 flex-1 flex flex-col">
        <p class="text-xs font-semibold uppercase tracking-wide text-gold-600"><?= View::e($project['industry'] ?? '') ?></p>
        <h3 class="mt-2 font-semibold text-navy-950 leading-snug"><?= View::e($project['title']) ?></h3>
        <p class="mt-2 text-sm text-ink-500 leading-relaxed flex-1"><?= View::e($project['summary'] ?? '') ?></p>
        <span class="mt-4 inline-flex items-center gap-1.5 text-sm font-semibold text-gold-600 group-hover:gap-2.5 transition-all">
            View Project
            <?= \App\Helpers\Icon::svg('arrow-right', 'w-4 h-4') ?>
        </span>
    </div>
</a>
