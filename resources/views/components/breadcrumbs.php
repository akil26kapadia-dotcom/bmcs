<?php

use App\Helpers\SEO;
use App\Helpers\Url;
use App\Core\View;

/**
 * Expects $items: array of ['label' => string, 'href' => string|null].
 * The last item (or any with href === null) renders as the current page.
 */
$items = $items ?? [];

if (empty($items)) {
    return;
}

$schemaItems = [];
foreach ($items as $item) {
    $schemaItems[] = [
        'name' => $item['label'],
        'url' => Url::full($item['href'] ?? '/'),
    ];
}
?>
<nav aria-label="Breadcrumb" class="bg-ink-100/60 border-b border-ink-900/[0.05]">
    <div class="container-custom py-3.5">
        <ol class="flex flex-wrap items-center gap-1.5 text-sm text-ink-500">
            <?php foreach ($items as $i => $item): ?>
                <?php $isLast = $i === array_key_last($items) || empty($item['href']); ?>
                <li class="flex items-center gap-1.5">
                    <?php if ($i > 0): ?>
                        <svg class="w-3.5 h-3.5 text-ink-300" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.24a.75.75 0 010 1.08l-4.5 4.24a.75.75 0 01-1.06-.02z" clip-rule="evenodd"/></svg>
                    <?php endif; ?>
                    <?php if ($isLast): ?>
                        <span class="font-medium text-navy-950" aria-current="page"><?= View::e($item['label']) ?></span>
                    <?php else: ?>
                        <a href="<?= View::e($item['href']) ?>" class="hover:text-navy-950"><?= View::e($item['label']) ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</nav>
<?= SEO::schema(SEO::breadcrumbSchema($schemaItems)) ?>
