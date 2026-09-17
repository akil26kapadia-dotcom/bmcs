<?php

use App\Core\View;

$term = $term ?? '';
$count = $count ?? 0;
$results = $results ?? [];
$posts = $results['posts'] ?? [];
$services = $results['services'] ?? [];
$portfolio = $results['portfolio'] ?? [];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Search', 'href' => null]],
]) ?>

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
        <span class="eyebrow-on-dark">Search</span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white">
            <?= $term !== '' ? 'Results for &ldquo;' . View::e($term) . '&rdquo;' : 'Search BMCS' ?>
        </h1>
        <?php if ($term !== ''): ?>
            <p class="mt-4 text-white/70"><?= $count ?> result<?= $count === 1 ? '' : 's' ?> found</p>
        <?php endif; ?>

        <form action="/search" method="GET" class="mt-8 max-w-md mx-auto relative">
            <label for="site-search" class="sr-only">Search the site</label>
            <input type="search" id="site-search" name="q" value="<?= View::e($term) ?>" placeholder="Search services, portfolio, articles&hellip;"
                   class="w-full rounded-full border border-white/20 bg-white/10 text-white placeholder-white/50 pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500">
            <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-white/50" viewBox="0 0 20 20" fill="none">
                <circle cx="9" cy="9" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M18 18l-4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </form>
    </div>
</section>

<section class="section-py bg-white">
    <div class="container-custom">
        <?php if ($term === ''): ?>
            <p class="text-center text-ink-500">Enter a search term above to find services, portfolio projects and blog articles.</p>
        <?php elseif ($count === 0): ?>
            <div class="card p-12 text-center">
                <p class="text-ink-500">No results found for &ldquo;<?= View::e($term) ?>&rdquo;. Try a different search term.</p>
            </div>
        <?php else: ?>
            <?php if (!empty($services)): ?>
                <div class="mb-16">
                    <h2 class="text-xl font-semibold text-navy-950 mb-6">Services</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($services as $i => $service): ?>
                            <?= View::capture('components/service-card', ['service' => $service, 'icon' => 'network', 'delay' => $i * 60]) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($portfolio)): ?>
                <div class="mb-16">
                    <h2 class="text-xl font-semibold text-navy-950 mb-6">Portfolio</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($portfolio as $i => $project): ?>
                            <?= View::capture('components/portfolio-card', ['project' => $project, 'delay' => $i * 60]) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($posts)): ?>
                <div>
                    <h2 class="text-xl font-semibold text-navy-950 mb-6">Blog</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($posts as $i => $post): ?>
                            <?= View::capture('components/blog-card', ['post' => $post, 'delay' => $i * 60]) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
