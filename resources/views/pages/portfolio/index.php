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

<section class="relative isolate overflow-hidden text-white">
    <div class="aurora" aria-hidden="true">
        <span class="aurora-blob aurora-blob--sky"></span>
        <span class="aurora-blob aurora-blob--deep"></span>
        <span class="aurora-blob aurora-blob--yellow"></span>
    </div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="inline-flex items-center gap-2.5 rounded-full glass px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide" data-animate="fade-up">
            <span class="pulse-dot w-2 h-2 rounded-full bg-gold-500 text-gold-500"></span>
            Our Work
        </span>
        <h1 class="mt-5 text-3xl md:text-5xl font-semibold tracking-tight text-white" data-animate="fade-up" data-delay="80">Portfolio</h1>
        <p class="mt-4 text-white/85 max-w-2xl mx-auto text-lg" data-animate="fade-up" data-delay="160">
            Representative examples of the network, security, cloud and digital projects BMCS
            delivers for businesses across Dubai and the UAE.
        </p>
        <p class="mt-3 text-xs text-white/70 uppercase tracking-wide" data-animate="fade-up" data-delay="200">
            Sample projects shown for illustration &mdash; case studies will be added as they are completed.
        </p>
    </div>
    <svg class="hero-wave absolute bottom-0 inset-x-0 text-white" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true"><path fill="currentColor" d="M0 60V28C240 4 480 0 720 14s480 26 720 4v42z"/></svg>
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
            <div id="portfolio-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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

<section class="cta-section relative isolate overflow-hidden text-white" data-spot>
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <span class="cta-spot" aria-hidden="true"></span>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white">Have a Project in Mind?</h2>
        <p class="mt-3 text-white/85 max-w-xl mx-auto">Tell us what you're trying to achieve and we'll help you plan it.</p>
        <div class="cta-btns mt-6">
            <?= \App\Helpers\Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>
