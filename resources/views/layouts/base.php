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
$fullTitle = $pageTitle === $siteName ? $siteName : $pageTitle . ' | ' . $siteName;

$ogImagePath = $ogImage ?? null;
$schemaList = isset($schema) ? (array_is_list($schema) && isset($schema[0]) ? $schema : [$schema]) : [];
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

    <script src="<?= View::e(Asset::versioned('/assets/js/app.js')) ?>" defer></script>
</body>
</html>
