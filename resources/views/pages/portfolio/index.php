<?php

use App\Core\View;

$projects = $projects ?? [];
$categories = $categories ?? [];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Portfolio', 'href' => null],
    ],
]) ?>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <?= View::capture('components/hero-image', ['alt' => "Dubai skyline at sunset with the Burj Khalifa"]) ?>
        <div class="absolute inset-0 bg-navy-600 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-navy-950/25"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="eyebrow-on-dark">Our Work</span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white">Portfolio</h1>
        <p class="mt-4 text-white/80 max-w-2xl mx-auto">
            Representative examples of the network, security, cloud and digital projects BMCS
            delivers for businesses across Dubai and the UAE.
        </p>
        <p class="mt-3 text-xs text-white/80 uppercase tracking-wide">
            Sample projects shown for illustration &mdash; case studies will be added as they are completed.
        </p>
    </div>
</section>

<section class="section-py bg-white">
    <div class="container-custom">
        <div data-filter-group="#portfolio-grid" class="mb-14 space-y-6">
            <div class="max-w-md mx-auto">
                <div class="relative">
                    <label for="portfolio-search" class="sr-only">Search projects by name or industry</label>
                    <input type="search" id="portfolio-search" data-filter-search placeholder="Search projects by name or industry&hellip;"
                           class="w-full rounded-full border border-ink-300 pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                    <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-ink-500" viewBox="0 0 20 20" fill="none">
                        <circle cx="9" cy="9" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M18 18l-4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 justify-center">
                <button type="button" data-filter-btn="all" class="filter-pill is-active">All Projects</button>
                <?php foreach ($categories as $category): ?>
                    <button type="button" data-filter-btn="<?= View::e($category['slug']) ?>" class="filter-pill">
                        <?= View::e($category['name']) ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (empty($projects)): ?>
            <div class="card p-12 text-center">
                <p class="text-ink-500">No projects to show yet. Check back soon.</p>
            </div>
        <?php else: ?>
            <div id="portfolio-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($projects as $i => $project): ?>
                    <div data-filter-item="<?= View::e($project['category_slug'] ?? '') ?>"
                         data-filter-text="<?= View::e(mb_strtolower($project['title'] . ' ' . ($project['industry'] ?? ''))) ?>">
                        <?= View::capture('components/portfolio-card', ['project' => $project, 'delay' => ($i % 6) * 60]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 hero-grid opacity-40 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white">Have a Project in Mind?</h2>
        <p class="mt-3 text-white/80 max-w-xl mx-auto">Tell us what you're trying to achieve and we'll help you plan it.</p>
        <div class="mt-6">
            <?= \App\Helpers\Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>
