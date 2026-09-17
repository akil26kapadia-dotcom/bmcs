<?php

use App\Core\View;
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Contact', 'href' => null]],
]) ?>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/assets/images/hero/dubai-skyline-1920.jpg"
             srcset="/assets/images/hero/dubai-skyline-960.jpg 960w, /assets/images/hero/dubai-skyline-1920.jpg 1920w"
             sizes="100vw"
             alt="Dubai skyline at sunset with the Burj Khalifa"
             width="1920" height="776" decoding="async" fetchpriority="high"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-navy-950 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-navy-950/40"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="eyebrow-on-dark">Get In Touch</span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white">Contact BMCS</h1>
        <p class="mt-4 text-white/70 max-w-2xl mx-auto">
            Tell us about your business and one of our specialists will get back to you.
        </p>
    </div>
</section>

<?= View::capture('components/contact-section') ?>
