<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;
use App\Helpers\SEO;
use App\Helpers\Url;

$service = $service ?? [];
$category = $category ?? null;
$capabilities = $capabilities ?? [];
$benefits = $benefits ?? [];
$applications = $applications ?? [];
$faq = $faq ?? [];
$related = $related ?? [];
$categoryIcon = $category['icon'] ?? 'network';

$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'Service',
    'name' => $service['name'],
    'description' => $service['short_description'] ?: $service['description'],
    'provider' => ['@type' => 'Organization', 'name' => 'Bright Mind Computer Solutions'],
    'areaServed' => 'Dubai, United Arab Emirates',
    'url' => Url::full('services/' . $service['slug']),
];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => array_filter([
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Services', 'href' => '/services'],
        $category ? ['label' => $category['name'], 'href' => '/solutions/' . $category['slug']] : null,
        ['label' => $service['name'], 'href' => null],
    ]),
]) ?>

<!-- HERO -->
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
    <div class="relative container-custom py-16 md:py-20">
        <div class="flex items-center gap-4">
            <span class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-white/10 text-gold-400">
                <?= Icon::svg($categoryIcon, 'w-7 h-7') ?>
            </span>
            <?php if ($category): ?>
                <a href="/solutions/<?= View::e($category['slug']) ?>" class="eyebrow-on-dark hover:text-gold-300"><?= View::e($category['name']) ?></a>
            <?php endif; ?>
        </div>
        <h1 class="mt-6 text-3xl md:text-5xl font-semibold text-white max-w-3xl"><?= View::e($service['name']) ?></h1>
        <p class="mt-4 text-white/70 max-w-2xl text-lg"><?= View::e($service['short_description']) ?></p>
        <div class="mt-8">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to an Expert', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>

<!-- INTRODUCTION -->
<section class="section-py bg-white">
    <div class="container-custom grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2">
            <h2 class="text-2xl font-semibold text-navy-950">Overview</h2>
            <p class="mt-4 text-ink-500 leading-relaxed"><?= View::e($service['description']) ?></p>

            <?php if (!empty($capabilities)): ?>
                <h2 class="mt-12 text-2xl font-semibold text-navy-950">Key Capabilities</h2>
                <ul class="mt-5 space-y-3">
                    <?php foreach ($capabilities as $item): ?>
                        <li class="flex items-start gap-3 text-ink-500">
                            <span class="text-gold-600 mt-0.5 shrink-0"><?= Icon::svg('check', 'w-5 h-5') ?></span>
                            <?= View::e($item) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($applications)): ?>
                <h2 class="mt-12 text-2xl font-semibold text-navy-950">Applications &amp; Use Cases</h2>
                <ul class="mt-5 space-y-3">
                    <?php foreach ($applications as $item): ?>
                        <li class="flex items-start gap-3 text-ink-500">
                            <span class="text-gold-600 mt-0.5 shrink-0"><?= Icon::svg('check', 'w-5 h-5') ?></span>
                            <?= View::e($item) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <?php if (!empty($faq)): ?>
                <h2 class="mt-12 text-2xl font-semibold text-navy-950">Frequently Asked Questions</h2>
                <div class="mt-5">
                    <?= View::capture('components/faq', ['items' => $faq]) ?>
                </div>
            <?php endif; ?>
        </div>

        <aside class="lg:col-span-1 space-y-6">
            <?php if (!empty($benefits)): ?>
                <div class="card p-6">
                    <h3 class="font-semibold text-navy-950">Benefits</h3>
                    <ul class="mt-4 space-y-3">
                        <?php foreach ($benefits as $item): ?>
                            <li class="flex items-start gap-2.5 text-sm text-ink-500">
                                <span class="text-gold-600 mt-0.5 shrink-0"><?= Icon::svg('check', 'w-4 h-4') ?></span>
                                <?= View::e($item) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (!empty($service['technologies'])): ?>
                <div class="card p-6">
                    <h3 class="font-semibold text-navy-950">Technology &amp; Solutions</h3>
                    <p class="mt-3 text-sm text-ink-500 leading-relaxed"><?= View::e($service['technologies']) ?></p>
                </div>
            <?php endif; ?>

            <div class="card p-6 bg-navy-950 border-none">
                <h3 class="font-semibold text-white">Need this for your business?</h3>
                <p class="mt-2 text-sm text-white/60">Tell us about your requirements and we'll recommend the right solution.</p>
                <div class="mt-4">
                    <?= Html::button(['href' => '/contact', 'label' => 'Request a Consultation', 'variant' => 'primary', 'icon' => true, 'class' => 'w-full']) ?>
                </div>
            </div>
        </aside>
    </div>
</section>

<!-- RELATED SERVICES -->
<?php if (!empty($related)): ?>
<section class="section-py bg-ink-100/50">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'Related Services',
            'title' => 'You May Also Need',
        ]) ?>
        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($related as $i => $relatedService): ?>
                <?= View::capture('components/service-card', [
                    'service' => $relatedService,
                    'icon' => $categoryIcon,
                    'delay' => $i * 80,
                ]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA -->
<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 hero-grid opacity-40 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white">Ready to Talk About <?= View::e($service['name']) ?>?</h2>
        <div class="mt-6">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>

<?= SEO::schema($schema) ?>
