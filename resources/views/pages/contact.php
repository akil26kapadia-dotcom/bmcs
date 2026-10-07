<?php

use App\Core\View;
use App\Helpers\SiteConfig;
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Contact', 'href' => null]],
]) ?>

<?= View::capture('components/page-hero', [
    'eyebrow' => SiteConfig::get('contact_hero_eyebrow', 'Get In Touch'),
    'title' => SiteConfig::get('contact_hero_heading', 'Contact BMCS'),
    'subtitle' => SiteConfig::get('contact_hero_subtext', 'Tell us about your business and one of our specialists will get back to you.'),
]) ?>

<?= View::capture('components/contact-section') ?>
