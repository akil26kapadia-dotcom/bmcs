<?php

use App\Core\View;

/**
 * Expects $pagination: ['page' => int, 'totalPages' => int].
 * $baseUrl: path only (e.g. '/blog'). $queryParams: extra query string
 * params to preserve across page links (e.g. ['q' => 'search term']).
 */
$pagination = $pagination ?? ['page' => 1, 'totalPages' => 1];
$baseUrl = $baseUrl ?? '/blog';
$queryParams = $queryParams ?? [];

$page = (int) $pagination['page'];
$totalPages = (int) $pagination['totalPages'];

if ($totalPages <= 1) {
    return;
}

$urlFor = function (int $p) use ($baseUrl, $queryParams) {
    $params = array_filter(array_merge($queryParams, ['page' => $p]), fn ($v) => $v !== null && $v !== '');
    return $baseUrl . '?' . http_build_query($params);
};

$start = max(1, $page - 2);
$end = min($totalPages, $page + 2);
?>
<nav aria-label="Pagination" class="flex items-center justify-center gap-1.5 mt-4">
    <?php if ($page > 1): ?>
        <a href="<?= View::e($urlFor($page - 1)) ?>" class="filter-pill">&larr; Prev</a>
    <?php endif; ?>

    <?php if ($start > 1): ?>
        <a href="<?= View::e($urlFor(1)) ?>" class="filter-pill">1</a>
        <?php if ($start > 2): ?><span class="px-1 text-ink-500">&hellip;</span><?php endif; ?>
    <?php endif; ?>

    <?php for ($i = $start; $i <= $end; $i++): ?>
        <a href="<?= View::e($urlFor($i)) ?>" class="filter-pill <?= $i === $page ? 'is-active' : '' ?>"><?= $i ?></a>
    <?php endfor; ?>

    <?php if ($end < $totalPages): ?>
        <?php if ($end < $totalPages - 1): ?><span class="px-1 text-ink-500">&hellip;</span><?php endif; ?>
        <a href="<?= View::e($urlFor($totalPages)) ?>" class="filter-pill"><?= $totalPages ?></a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="<?= View::e($urlFor($page + 1)) ?>" class="filter-pill">Next &rarr;</a>
    <?php endif; ?>
</nav>
