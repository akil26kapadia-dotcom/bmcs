<?php

use App\Core\View;
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Contact', 'href' => null]],
]) ?>

<section class="relative bg-gradient-to-b from-navy-950 via-navy-900 to-[#241a35] overflow-hidden">
    <div class="absolute inset-0 hero-grid opacity-50 pointer-events-none" aria-hidden="true"></div>
    <?= View::capture('components/dubai-skyline') ?>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="eyebrow-on-dark">Get In Touch</span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white">Contact BMCS</h1>
        <p class="mt-4 text-white/70 max-w-2xl mx-auto">
            Tell us about your business and one of our specialists will get back to you.
        </p>
    </div>
</section>

<?= View::capture('components/contact-section') ?>
