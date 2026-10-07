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

<?= View::capture('components/page-hero', [
    'eyebrow' => SiteConfig::get('products_hero_eyebrow', 'IT Distribution'),
    'title' => SiteConfig::get('products_hero_heading', 'IT Products & Distribution'),
    'subtitle' => SiteConfig::get('products_hero_subtext', 'BMCS supplies and configures the hardware businesses need — from servers and workstations to networking equipment and accessories.'),
]) ?>

<section class="section-py bg-white">
    <div class="container-custom grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($categories as $i => $category): ?>
            <div class="group card card-hover spotlight p-7" data-animate="fade-up" data-delay="<?= ($i % 4) * 80 ?>">
                <span class="icon-badge">
                    <?= Icon::svg($category['icon'], 'w-6 h-6') ?>
                </span>
                <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($category['name']) ?></h3>
                <p class="mt-2 text-sm text-ink-500 leading-relaxed"><?= View::e($category['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-14 relative isolate overflow-hidden rounded-3xl p-8 md:p-12 text-center text-white">
        <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
        <div class="relative">
            <h2 class="text-xl md:text-2xl font-semibold text-white"><?= View::e(SiteConfig::get('products_cta_heading', 'Looking for Specific Hardware?')) ?></h2>
            <p class="mt-3 text-white/85 max-w-xl mx-auto">
                <?= View::e(SiteConfig::get('products_cta_subtext', "Tell us what your business needs and we'll help you source and configure the right equipment, at the right budget.")) ?>
            </p>
            <div class="mt-6">
                <?= Html::button(['href' => '/contact', 'label' => 'Enquire About Products', 'variant' => 'primary', 'icon' => true]) ?>
            </div>
        </div>
    </div>
</section>
