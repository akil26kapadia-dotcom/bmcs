<?php

use App\Core\View;
use App\Helpers\Html;
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

<?= View::capture('components/page-hero', [
    'eyebrow' => 'What We Do',
    'title' => 'Our Services',
    'subtitle' => 'A complete range of IT infrastructure, security, cloud, telecommunication and digital services for businesses across Dubai and the UAE.',
]) ?>

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

        <div id="services-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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

<section class="cta-section relative isolate overflow-hidden text-white" data-spot>
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <span class="cta-spot" aria-hidden="true"></span>
    <div class="relative container-custom section-py text-center">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'Not Sure Where to Start?',
            'title' => 'Talk to Our Team About Your Requirements',
            'align' => 'center',
            'onDark' => true,
        ]) ?>
        <div class="cta-btns mt-8 flex flex-wrap items-center justify-center gap-4">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to an Expert', 'variant' => 'primary', 'icon' => true]) ?>
            <?= Html::whatsappButton('WhatsApp Us') ?>
        </div>
    </div>
</section>
