<?php

use App\Core\View;
use App\Helpers\Asset;
use App\Helpers\SEO;
use App\Helpers\SiteConfig;
use App\Helpers\Url;
use App\Models\SeoMetadata;

$siteName = SiteConfig::get('site_name');
$pageTitle = $title ?? $siteName;
$metaDescription = $description ?? SiteConfig::get('default_seo_description', 'BMCS delivers enterprise IT infrastructure, networking, security, cloud and digital solutions across Dubai and the UAE.');
$currentPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/', '/');
$canonicalUrl = $canonicalOverride ?? Url::full($currentPath);
$ogImagePath = $ogImage ?? SiteConfig::get('site_hero_image', '/assets/images/hero/dubai-skyline-1920.jpg');
$ogTitleValue = $ogTitle ?? null;
$ogDescriptionValue = $ogDescription ?? null;

// Admin-editable overrides (Admin > SEO) for the current route, keyed by its
// path ('home' for '/'). Only applied to static/listing pages — a dynamic
// page (a specific service/post/portfolio slug) has its own currentPath per
// item, so a generic row here never collides with per-item meta from its
// own database record. Safe to fail: a DB hiccup just means no override.
try {
    $seoOverride = SeoMetadata::findByRouteKey($currentPath === '' ? 'home' : $currentPath);
} catch (\Throwable $e) {
    $seoOverride = null;
}
if ($seoOverride) {
    $pageTitle = $seoOverride['meta_title'] ?: $pageTitle;
    $metaDescription = $seoOverride['meta_description'] ?: $metaDescription;
    $canonicalUrl = $seoOverride['canonical_url'] ?: $canonicalUrl;
    $ogTitleValue = $seoOverride['og_title'] ?: $ogTitleValue;
    $ogDescriptionValue = $seoOverride['og_description'] ?: $ogDescriptionValue;
    $ogImagePath = $seoOverride['og_image'] ?: $ogImagePath;
}

$fullTitle = $titleOverride ?? ($pageTitle === $siteName ? $siteName : $pageTitle . ' | ' . $siteName);
$schemaList = isset($schema) ? (array_is_list($schema) && isset($schema[0]) ? $schema : [$schema]) : [];

$whatsapp = SiteConfig::get('whatsapp_number');

// Address and social links are set in Admin > Settings; both are optional so
// the schema degrades gracefully to just a locality until the real street
// address is confirmed (see standing reminder to the client).
$streetAddress = SiteConfig::get('site_address');
$socialLinks = array_values(array_filter([
    SiteConfig::get('facebook_url'),
    SiteConfig::get('instagram_url'),
    SiteConfig::get('linkedin_url'),
    SiteConfig::get('twitter_url'),
]));

$schemaList[] = array_filter([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => $siteName,
    'url' => Url::full(''),
    'logo' => Url::full(SiteConfig::get('site_logo', '/assets/images/logo-mark.png')),
    'image' => Url::full(SiteConfig::get('site_logo', '/assets/images/logo-mark.png')),
    'telephone' => SiteConfig::get('site_phone'),
    'email' => SiteConfig::get('site_email'),
    'address' => array_filter([
        '@type' => 'PostalAddress',
        'streetAddress' => $streetAddress ?: null,
        'addressLocality' => SiteConfig::get('site_city', 'Dubai'),
        'addressCountry' => SiteConfig::get('site_country_code', 'AE'),
    ]),
    'sameAs' => $socialLinks ?: null,
]);
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
        'title' => $ogTitleValue ?? $fullTitle,
        'description' => $ogDescriptionValue ?? $metaDescription,
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
    <link rel="preload" as="image" href="<?= View::e(SiteConfig::get('site_hero_image', '/assets/images/hero/dubai-skyline-1920.jpg')) ?>" fetchpriority="high">
    <?php endif; ?>
    <link rel="stylesheet" href="<?= View::e(Asset::versioned('/assets/css/app.css')) ?>">
    <noscript><style>#site-preloader{display:none}</style></noscript>

    <?php foreach ($schemaList as $schemaItem): ?>
        <?= SEO::schema($schemaItem) ?>
    <?php endforeach; ?>
</head>
<body class="bg-white">
    <div id="site-preloader" role="status" aria-label="Loading">
        <img src="<?= View::e(SiteConfig::get('site_logo', '/assets/images/logo-mark.png')) ?>" alt="" width="72" height="90" class="preloader-logo h-20 w-auto">
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
