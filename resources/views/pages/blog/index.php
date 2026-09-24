<?php

use App\Core\View;

$posts = $posts ?? [];
$categories = $categories ?? [];
$tags = $tags ?? [];
$heading = $heading ?? 'Blog';
$search = $search ?? '';
$activeFilter = $activeFilter ?? null;

$breadcrumbItems = [['label' => 'Home', 'href' => '/'], ['label' => 'Blog', 'href' => $activeFilter ? '/blog' : null]];
if ($activeFilter) {
    $breadcrumbItems[] = ['label' => $activeFilter['label'], 'href' => null];
}
?>
<?= View::capture('components/breadcrumbs', ['items' => $breadcrumbItems]) ?>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/assets/images/hero/dubai-skyline-1920.jpg"
             srcset="/assets/images/hero/dubai-skyline-960.jpg 960w, /assets/images/hero/dubai-skyline-1920.jpg 1920w"
             sizes="100vw"
             alt="Dubai skyline at sunset with the Burj Khalifa"
             width="1920" height="776" decoding="async" fetchpriority="high"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-navy-600 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-navy-950/25"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="eyebrow-on-dark">Insights</span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white"><?= View::e($heading) ?></h1>
        <p class="mt-4 text-white/80 max-w-2xl mx-auto">
            Technology insights and updates from BMCS on IT infrastructure, networking, security, cloud and digital solutions.
        </p>

        <form action="/blog" method="GET" class="mt-8 max-w-md mx-auto relative">
            <label for="blog-search" class="sr-only">Search articles</label>
            <input type="search" id="blog-search" name="q" value="<?= View::e($search) ?>" placeholder="Search articles&hellip;"
                   class="w-full rounded-full border border-white/20 bg-white/10 text-white placeholder-white/50 pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500">
            <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-white/80" viewBox="0 0 20 20" fill="none">
                <circle cx="9" cy="9" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M18 18l-4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </form>
    </div>
</section>

<section class="section-py bg-white">
    <div class="container-custom grid lg:grid-cols-4 gap-12">
        <div class="lg:col-span-3">
            <?php if (empty($posts)): ?>
                <div class="card p-12 text-center">
                    <p class="text-ink-500">
                        <?= $search !== '' ? 'No articles matched your search.' : 'No articles published yet. Check back soon.' ?>
                    </p>
                </div>
            <?php else: ?>
                <div class="grid sm:grid-cols-2 gap-6">
                    <?php foreach ($posts as $i => $post): ?>
                        <?= View::capture('components/blog-card', ['post' => $post, 'delay' => ($i % 6) * 60]) ?>
                    <?php endforeach; ?>
                </div>

                <?= View::capture('components/pagination', [
                    'pagination' => $pagination,
                    'baseUrl' => strtok($_SERVER['REQUEST_URI'], '?'),
                    'queryParams' => array_filter(['q' => $search]),
                ]) ?>
            <?php endif; ?>
        </div>

        <aside class="lg:col-span-1 space-y-8">
            <div>
                <h3 class="font-semibold text-navy-950 mb-4">Categories</h3>
                <ul class="space-y-2">
                    <?php foreach ($categories as $category): ?>
                        <li>
                            <a href="/blog/category/<?= View::e($category['slug']) ?>"
                               class="text-sm text-ink-500 hover:text-gold-600 <?= ($activeFilter['type'] ?? null) === 'category' && $activeFilter['label'] === $category['name'] ? 'text-gold-600 font-semibold' : '' ?>">
                                <?= View::e($category['name']) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php if (!empty($tags)): ?>
                <div>
                    <h3 class="font-semibold text-navy-950 mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach ($tags as $tag): ?>
                            <a href="/blog/tag/<?= View::e($tag['slug']) ?>" class="filter-pill !py-1.5 !text-xs">
                                <?= View::e($tag['name']) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</section>
