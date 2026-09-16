<?php

use App\Core\View;
use App\Helpers\Icon;

$post = $post ?? [];
$delay = $delay ?? 0;
?>
<a href="/blog/<?= View::e($post['slug']) ?>" class="group card card-hover overflow-hidden block h-full flex flex-col" data-animate="fade-up" data-delay="<?= (int) $delay ?>">
    <?php if (!empty($post['featured_image'])): ?>
        <div class="h-48 overflow-hidden shrink-0">
            <img src="<?= View::e($post['featured_image']) ?>" alt="<?= View::e($post['title']) ?>"
                 width="600" height="400" loading="lazy" decoding="async"
                 class="w-full h-full object-cover transition-transform duration-500 ease-premium group-hover:scale-105">
        </div>
    <?php endif; ?>
    <div class="p-6 flex-1 flex flex-col">
        <?php if (!empty($post['category_name'])): ?>
            <p class="text-xs font-semibold uppercase tracking-wide text-gold-600"><?= View::e($post['category_name']) ?></p>
        <?php endif; ?>
        <h3 class="mt-2 font-semibold text-navy-950 leading-snug"><?= View::e($post['title']) ?></h3>
        <p class="mt-2 text-sm text-ink-500 leading-relaxed flex-1"><?= View::e($post['excerpt'] ?? '') ?></p>
        <div class="mt-4 flex items-center gap-2 text-xs text-ink-500">
            <?= Icon::svg('life-buoy', 'w-3.5 h-3.5') ?>
            <?= View::e(date('M j, Y', strtotime($post['published_at']))) ?>
        </div>
    </div>
</a>
