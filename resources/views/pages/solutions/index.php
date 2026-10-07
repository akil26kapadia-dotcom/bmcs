<?php

use App\Core\View;
use App\Helpers\Html;

$categories = $categories ?? [];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Solutions We Deliver', 'href' => null],
    ],
]) ?>

<?= View::capture('components/page-hero', [
    'eyebrow' => 'Bright Mind Computer Solutions',
    'title' => 'Solutions We Deliver in Dubai & the UAE',
    'subtitle' => 'TallyPrime solutions and the IT services around them — networking, cloud, security, telecommunication, Microsoft, IT support and digital. Explore the area most relevant to you.',
]) ?>

<section class="section-py bg-white">
    <div class="container-custom grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <?php foreach ($categories as $i => $category): ?>
            <?= View::capture('components/category-card', ['category' => $category, 'delay' => ($i % 4) * 80]) ?>
        <?php endforeach; ?>
    </div>
</section>

<section class="cta-section relative isolate overflow-hidden text-white" data-spot>
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <span class="cta-spot" aria-hidden="true"></span>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white"><span class="cta-word">Not</span> <span class="cta-word">Sure</span> <span class="cta-word">Which</span> <span class="cta-word">Solution</span> <span class="cta-word">Fits?</span></h2>
        <p class="mt-3 text-white/85 max-w-xl mx-auto">Tell us about your business and we'll point you to the right service.</p>
        <div class="cta-btns mt-6 flex flex-wrap items-center justify-center gap-4">
            <?= Html::button(['href' => '/contact', 'label' => 'Book a Consultation', 'variant' => 'primary', 'icon' => true]) ?>
            <?= Html::whatsappButton('WhatsApp Us') ?>
        </div>
    </div>
</section>
