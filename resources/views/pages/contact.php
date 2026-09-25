<?php

use App\Core\View;
use App\Helpers\SiteConfig;
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Contact', 'href' => null]],
]) ?>

<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <?= View::capture('components/hero-image', ['alt' => "Dubai skyline at sunset with the Burj Khalifa"]) ?>
        <div class="absolute inset-0 bg-navy-600 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-navy-950/25"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <span class="eyebrow-on-dark"><?= View::e(SiteConfig::get('contact_hero_eyebrow', 'Get In Touch')) ?></span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white"><?= View::e(SiteConfig::get('contact_hero_heading', 'Contact BMCS')) ?></h1>
        <p class="mt-4 text-white/80 max-w-2xl mx-auto">
            <?= View::e(SiteConfig::get('contact_hero_subtext', 'Tell us about your business and one of our specialists will get back to you.')) ?>
        </p>
    </div>
</section>

<?= View::capture('components/contact-section') ?>
