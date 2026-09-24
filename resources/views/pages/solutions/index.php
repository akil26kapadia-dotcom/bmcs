<?php

use App\Core\View;

$categories = $categories ?? [];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Solutions We Deliver', 'href' => null],
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
        <div class="absolute inset-0 bg-navy-600 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-navy-950/25"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="eyebrow-on-dark">Bright Mind Computer Solutions</span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white">Solutions We Deliver in Dubai &amp; the UAE</h1>
        <p class="mt-4 text-white/80 max-w-2xl mx-auto">
            TallyPrime solutions and the IT services around them &mdash; networking, cloud, security,
            telecommunication, Microsoft, IT support and digital. Explore the area most relevant to you.
        </p>
    </div>
</section>

<section class="section-py bg-white">
    <div class="container-custom grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($categories as $i => $category): ?>
            <?= View::capture('components/category-card', ['category' => $category, 'delay' => ($i % 4) * 80]) ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 hero-grid opacity-40 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white">Not Sure Which Solution Fits?</h2>
        <p class="mt-3 text-white/80 max-w-xl mx-auto">Tell us about your business and we'll point you to the right service.</p>
        <div class="mt-6 flex flex-wrap items-center justify-center gap-4">
            <?= \App\Helpers\Html::button(['href' => '/contact', 'label' => 'Book a Consultation', 'variant' => 'primary', 'icon' => true]) ?>
            <?= \App\Helpers\Html::whatsappButton('WhatsApp Us') ?>
        </div>
    </div>
</section>
