<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Str;
use App\Helpers\Url;

$post = $post ?? [];
$related = $related ?? [];
$readingTime = Str::readingTime($post['content'] ?? '');
$postUrl = Url::full('blog/' . $post['slug']);
?>
<?= View::capture('components/breadcrumbs', [
    'items' => array_filter([
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Blog', 'href' => '/blog'],
        !empty($post['category_name']) ? ['label' => $post['category_name'], 'href' => '/blog/category/' . $post['category_slug']] : null,
        ['label' => $post['title'], 'href' => null],
    ]),
]) ?>

<article class="section-py bg-white">
    <div class="container-custom max-w-3xl">
        <?php if (!empty($post['category_name'])): ?>
            <a href="/blog/category/<?= View::e($post['category_slug']) ?>" class="eyebrow">
                <?= View::e($post['category_name']) ?>
            </a>
        <?php endif; ?>

        <h1 class="mt-3 text-3xl md:text-4xl font-semibold text-navy-950 leading-tight">
            <?= View::e($post['title']) ?>
        </h1>

        <div class="mt-5 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-ink-500">
            <span><?= View::e($post['author_name'] ?? 'BMCS Team') ?></span>
            <span aria-hidden="true">&middot;</span>
            <time datetime="<?= View::e(date('c', strtotime($post['published_at']))) ?>">
                <?= View::e(date('F j, Y', strtotime($post['published_at']))) ?>
            </time>
            <?php if ($post['updated_at'] && $post['updated_at'] !== $post['created_at']): ?>
                <span aria-hidden="true">&middot;</span>
                <span>Updated <?= View::e(date('F j, Y', strtotime($post['updated_at']))) ?></span>
            <?php endif; ?>
            <span aria-hidden="true">&middot;</span>
            <span><?= $readingTime ?> min read</span>
        </div>

        <?php if (!empty($post['featured_image'])): ?>
            <img src="<?= View::e($post['featured_image']) ?>" alt="<?= View::e($post['title']) ?>"
                 width="1200" height="675" fetchpriority="high" decoding="async"
                 class="mt-8 w-full h-auto rounded-2xl shadow-premium">
        <?php endif; ?>

        <div class="mt-10 prose-blog max-w-none">
            <?= $post['content'] ?>
        </div>

        <?php if (!empty($post['tags'])): ?>
            <div class="mt-10 flex flex-wrap gap-2">
                <?php foreach ($post['tags'] as $tag): ?>
                    <a href="/blog/tag/<?= View::e($tag['slug']) ?>" class="filter-pill !py-1.5 !text-xs"><?= View::e($tag['name']) ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="mt-10 pt-8 border-t border-ink-900/[0.08] flex items-center gap-3">
            <span class="text-sm font-medium text-ink-700">Share:</span>
            <a href="https://twitter.com/intent/tweet?url=<?= urlencode($postUrl) ?>&text=<?= urlencode($post['title']) ?>" target="_blank" rel="noopener" class="filter-pill !py-1.5 !text-xs">X / Twitter</a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode($postUrl) ?>" target="_blank" rel="noopener" class="filter-pill !py-1.5 !text-xs">LinkedIn</a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($postUrl) ?>" target="_blank" rel="noopener" class="filter-pill !py-1.5 !text-xs">Facebook</a>
        </div>
    </div>
</article>

<?php if (!empty($related)): ?>
<section class="section-py bg-ink-100/50">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'Keep Reading',
            'title' => 'Related Articles',
        ]) ?>
        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($related as $i => $relatedPost): ?>
                <?= View::capture('components/blog-card', ['post' => $relatedPost, 'delay' => $i * 80]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 hero-grid opacity-40 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white">Have a Technology Question?</h2>
        <div class="mt-6">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>
