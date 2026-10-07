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

<section class="relative isolate overflow-hidden text-white">
    <div class="aurora" aria-hidden="true">
        <span class="aurora-blob aurora-blob--sky"></span>
        <span class="aurora-blob aurora-blob--deep"></span>
        <span class="aurora-blob aurora-blob--yellow"></span>
    </div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="inline-flex items-center gap-2.5 rounded-full glass px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide" data-animate="fade-up">
            <span class="pulse-dot w-2 h-2 rounded-full bg-gold-500 text-gold-500"></span>
            Search
        </span>
        <h1 class="mt-5 text-3xl md:text-5xl font-semibold tracking-tight text-white" data-animate="fade-up" data-delay="80">
            <?= $term !== '' ? 'Results for &ldquo;' . View::e($term) . '&rdquo;' : 'Search BMCS' ?>
        </h1>
        <?php if ($term !== ''): ?>
            <p class="mt-4 text-white/85" data-animate="fade-up" data-delay="160"><?= $count ?> result<?= $count === 1 ? '' : 's' ?> found</p>
        <?php endif; ?>

        <form action="/search" method="GET" class="mt-8 max-w-md mx-auto relative" data-animate="fade-up" data-delay="240">
            <label for="site-search" class="sr-only">Search the site</label>
            <input type="search" id="site-search" name="q" value="<?= View::e($term) ?>" placeholder="Search services, portfolio, articles&hellip;"
                   class="w-full rounded-full border border-white/20 bg-white/10 text-white placeholder-white/50 pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500">
            <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-white/80" viewBox="0 0 20 20" fill="none">
                <circle cx="9" cy="9" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M18 18l-4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
        </form>
    </div>
    <svg class="hero-wave absolute bottom-0 inset-x-0 text-white" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true"><path fill="currentColor" d="M0 60V28C240 4 480 0 720 14s480 26 720 4v42z"/></svg>
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
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($services as $i => $service): ?>
                            <?= View::capture('components/service-card', ['service' => $service, 'icon' => 'network', 'delay' => $i * 60]) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($portfolio)): ?>
                <div class="mb-16">
                    <h2 class="text-xl font-semibold text-navy-950 mb-6">Portfolio</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($portfolio as $i => $project): ?>
                            <?= View::capture('components/portfolio-card', ['project' => $project, 'delay' => $i * 60]) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($posts)): ?>
                <div>
                    <h2 class="text-xl font-semibold text-navy-950 mb-6">Blog</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($posts as $i => $post): ?>
                            <?= View::capture('components/blog-card', ['post' => $post, 'delay' => $i * 60]) ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>
