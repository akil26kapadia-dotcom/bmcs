<?php

use App\Core\View;
use App\Helpers\SEO;

/** Expects $items: array of ['q' => string, 'a' => string]. */
$items = $items ?? [];

if (empty($items)) {
    return;
}

$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn ($item) => [
        '@type' => 'Question',
        'name' => $item['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
    ], $items),
];
?>
<div class="divide-y divide-ink-900/[0.08] border-t border-b border-ink-900/[0.08]">
    <?php foreach ($items as $item): ?>
        <details class="group py-5">
            <summary class="flex items-center justify-between gap-4 cursor-pointer list-none font-medium text-navy-950">
                <?= View::e($item['q']) ?>
                <svg class="w-5 h-5 shrink-0 text-gold-600 transition-transform duration-300 group-open:rotate-45" viewBox="0 0 20 20" fill="none">
                    <path d="M10 4v12M4 10h12" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/>
                </svg>
            </summary>
            <p class="mt-3 text-sm text-ink-500 leading-relaxed"><?= View::e($item['a']) ?></p>
        </details>
    <?php endforeach; ?>
</div>
<?= SEO::schema($schema) ?>
