<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;
use App\Helpers\SiteConfig;

$categories = $categories ?? [];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Products', 'href' => null],
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
        <span class="eyebrow-on-dark"><?= View::e(SiteConfig::get('products_hero_eyebrow', 'IT Distribution')) ?></span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white"><?= View::e(SiteConfig::get('products_hero_heading', 'IT Products & Distribution')) ?></h1>
        <p class="mt-4 text-white/80 max-w-2xl mx-auto">
            <?= View::e(SiteConfig::get('products_hero_subtext', 'BMCS supplies and configures the hardware businesses need — from servers and workstations to networking equipment and accessories.')) ?>
        </p>
    </div>
</section>

<section class="section-py bg-white">
    <div class="container-custom grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($categories as $i => $category): ?>
            <div class="group card card-hover p-7" data-animate="fade-up" data-delay="<?= ($i % 4) * 80 ?>">
                <span class="icon-badge">
                    <?= Icon::svg($category['icon'], 'w-6 h-6') ?>
                </span>
                <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($category['name']) ?></h3>
                <p class="mt-2 text-sm text-ink-500 leading-relaxed"><?= View::e($category['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-14 card p-8 md:p-10 text-center bg-ink-100/50 border-none">
        <h2 class="text-xl md:text-2xl font-semibold text-navy-950"><?= View::e(SiteConfig::get('products_cta_heading', 'Looking for Specific Hardware?')) ?></h2>
        <p class="mt-3 text-ink-500 max-w-xl mx-auto">
            <?= View::e(SiteConfig::get('products_cta_subtext', "Tell us what your business needs and we'll help you source and configure the right equipment, at the right budget.")) ?>
        </p>
        <div class="mt-6">
            <?= Html::button(['href' => '/contact', 'label' => 'Enquire About Products', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>
