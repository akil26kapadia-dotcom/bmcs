<?php

use App\Core\View;
use App\Helpers\Asset;
use App\Helpers\SEO;
use App\Helpers\SiteConfig;
use App\Helpers\Url;

$siteName = SiteConfig::get('site_name');
$pageTitle = $title ?? $siteName;
$metaDescription = $description ?? SiteConfig::get('default_seo_description', 'BMCS delivers enterprise IT infrastructure, networking, security, cloud and digital solutions across Dubai and the UAE.');
$currentPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/', '/');
$canonicalUrl = $canonicalOverride ?? Url::full($currentPath);
$fullTitle = $titleOverride ?? ($pageTitle === $siteName ? $siteName : $pageTitle . ' | ' . $siteName);

$ogImagePath = $ogImage ?? '/assets/images/hero/hero-datacenter-1920.webp';
$schemaList = isset($schema) ? (array_is_list($schema) && isset($schema[0]) ? $schema : [$schema]) : [];

$whatsapp = SiteConfig::get('whatsapp_number');

$schemaList[] = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $siteName,
    'url' => Url::full(''),
    'logo' => Url::full('/assets/images/logo-mark.png'),
    'image' => Url::full('/assets/images/logo-mark.png'),
    'telephone' => SiteConfig::get('site_phone'),
    'email' => SiteConfig::get('site_email'),
    'address' => [
        '@type' => 'PostalAddress',
        'addressLocality' => 'Dubai',
        'addressCountry' => 'AE',
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= View::e($fullTitle) ?></title>
    <meta name="description" content="<?= View::e($metaDescription) ?>">
    <link rel="canonical" href="<?= View::e($canonicalUrl) ?>">

    <?= SEO::openGraph([
        'title' => $ogTitle ?? $fullTitle,
        'description' => $ogDescription ?? $metaDescription,
        'url' => $canonicalUrl,
        'image' => $ogImagePath ? Url::full($ogImagePath) : null,
        'type' => $ogType ?? 'website',
    ]) ?>

    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon-16.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/images/favicon-192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">

    <link rel="preload" href="/assets/fonts/inter/Inter-latin.woff2" as="font" type="font/woff2" crossorigin>
    <?php if (!empty($preloadHero)): ?>
    <link rel="preload" as="image" href="/assets/images/hero/dubai-skyline-1920.jpg" imagesrcset="/assets/images/hero/dubai-skyline-960.jpg 960w, /assets/images/hero/dubai-skyline-1920.jpg 1920w" imagesizes="100vw" fetchpriority="high">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= View::e(Asset::versioned('/assets/css/app.css')) ?>">
    <noscript><style>#site-preloader{display:none}</style></noscript>

    <?php foreach ($schemaList as $schemaItem): ?>
        <?= SEO::schema($schemaItem) ?>
    <?php endforeach; ?>
</head>
<body class="bg-white">
    <div id="site-preloader" role="status" aria-label="Loading">
        <img src="/assets/images/logo-mark.png" alt="" width="72" height="90" class="preloader-logo h-20 w-auto">
    </div>

    <a href="#main-content" class="skip-link">Skip to content</a>

    <?= View::capture('components/navbar', ['currentPath' => $currentPath]) ?>

    <main id="main-content">
        <?= $content ?? '' ?>
    </main>

    <?= View::capture('components/footer') ?>

    <?php if ($whatsapp): ?>
        <a href="https://wa.me/<?= View::e(preg_replace('/[^0-9]/', '', $whatsapp)) ?>" target="_blank" rel="noopener"
           aria-label="Chat with BMCS on WhatsApp"
           class="fixed bottom-6 right-6 z-50 inline-flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] text-white shadow-premium hover:-translate-y-1 hover:shadow-glow transition-all duration-300 ease-premium">
            <svg class="w-7 h-7" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 00-6.9 12.02L2 18l4.1-1.07A8 8 0 1010 2zm0 14.4a6.4 6.4 0 01-3.26-.9l-.23-.14-2.43.64.65-2.37-.15-.24A6.4 6.4 0 1116.4 10 6.41 6.41 0 0110 16.4z"/></svg>
        </a>
    <?php endif; ?>

    <script src="<?= View::e(Asset::versioned('/assets/js/app.js')) ?>" defer></script>
</body>
</html>
