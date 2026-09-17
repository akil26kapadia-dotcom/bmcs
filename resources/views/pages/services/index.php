<?php

use App\Core\View;
use App\Helpers\Icon;

$categories = $categories ?? [];
$grouped = $grouped ?? [];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Services', 'href' => null],
    ],
]) ?>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/assets/images/hero/dubai-skyline-1920.jpg"
             srcset="/assets/images/hero/dubai-skyline-960.jpg 960w, /assets/images/hero/dubai-skyline-1920.jpg 1920w"
             sizes="100vw"
             alt="Dubai skyline at sunset with the Burj Khalifa"
             width="1920" height="776" decoding="async" fetchpriority="high"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-navy-950/75"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="eyebrow-on-dark">What We Do</span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white">Our Services</h1>
        <p class="mt-4 text-white/70 max-w-2xl mx-auto">
            A complete range of IT infrastructure, security, cloud, telecommunication and digital
            services for businesses across Dubai and the UAE.
        </p>
    </div>
</section>

<section class="section-py bg-white">
    <div class="container-custom">
        <div data-filter-group="#services-grid" class="flex flex-wrap gap-3 justify-center mb-14">
            <button type="button" data-filter-btn="all" class="filter-pill is-active">All Services</button>
            <?php foreach ($categories as $category): ?>
                <button type="button" data-filter-btn="<?= View::e($category['slug']) ?>" class="filter-pill">
                    <?= View::e($category['name']) ?>
                </button>
            <?php endforeach; ?>
        </div>

        <div id="services-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $i = 0; foreach ($grouped as $group): ?>
                <?php foreach ($group['services'] as $service): $i++; ?>
                    <div data-filter-item="<?= View::e($group['category']['slug']) ?>">
                        <?= View::capture('components/service-card', [
                            'service' => $service,
                            'icon' => $group['category']['icon'] ?? 'network',
                            'delay' => ($i % 6) * 60,
                        ]) ?>
                    </div>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section-py bg-ink-100/50">
    <div class="container-custom text-center">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'Not Sure Where to Start?',
            'title' => 'Talk to Our Team About Your Requirements',
            'align' => 'center',
        ]) ?>
        <div class="mt-8">
            <?= \App\Helpers\Html::button(['href' => '/contact', 'label' => 'Talk to an Expert', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>
