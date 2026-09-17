<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;

$category = $category ?? [];
$services = $services ?? [];
$otherCategories = $otherCategories ?? [];
$capabilities = $category['capabilities'] ?? [];
$benefits = $category['benefits'] ?? [];
$applications = $category['applications'] ?? [];
$faq = $category['faq'] ?? [];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Solutions', 'href' => '/solutions'],
        ['label' => $category['name'], 'href' => null],
    ],
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
        <div class="absolute inset-0 bg-navy-950/75"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-20">
        <span class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-white/10 text-gold-400">
            <?= Icon::svg($category['icon'] ?? 'network', 'w-7 h-7') ?>
        </span>
        <h1 class="mt-6 text-3xl md:text-5xl font-semibold text-white max-w-3xl"><?= View::e($category['name']) ?></h1>
        <p class="mt-4 text-white/70 max-w-2xl text-lg"><?= View::e($category['description']) ?></p>
        <div class="mt-8">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to an Expert', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>

<!-- SERVICES IN THIS CATEGORY -->
<section class="section-py bg-white">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'Services',
            'title' => 'What\'s Included in ' . $category['name'],
            'align' => 'center',
        ]) ?>
        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($services as $i => $service): ?>
                <?= View::capture('components/service-card', [
                    'service' => $service,
                    'icon' => $category['icon'] ?? 'network',
                    'delay' => $i * 70,
                ]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CAPABILITIES / BENEFITS / APPLICATIONS / FAQ -->
<section class="section-py bg-ink-100/50">
    <div class="container-custom grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2">
            <?php if (!empty($capabilities)): ?>
                <h2 class="text-2xl font-semibold text-navy-950">Key Capabilities</h2>
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
                <div class="mt-5 bg-white rounded-xl px-6">
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

            <?php if (!empty($otherCategories)): ?>
                <div class="card p-6">
                    <h3 class="font-semibold text-navy-950">Other Solutions</h3>
                    <ul class="mt-4 space-y-2.5">
                        <?php foreach ($otherCategories as $other): ?>
                            <li>
                                <a href="/solutions/<?= View::e($other['slug']) ?>" class="text-sm text-ink-500 hover:text-gold-600">
                                    <?= View::e($other['name']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</section>

<!-- CTA -->
<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 hero-grid opacity-40 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white">Ready to Discuss <?= View::e($category['name']) ?>?</h2>
        <div class="mt-6">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>
