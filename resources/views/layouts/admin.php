<?php

use App\Core\View;

$pageTitle = $title ?? 'Admin';
$currentPath = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/', '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= View::e($pageTitle) ?> | BMCS Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>
<body class="bg-ink-100/40">
    <?= View::capture('components/admin/sidebar', ['currentPath' => $currentPath]) ?>

    <div class="lg:pl-64">
        <header class="sticky top-0 z-20 bg-white border-b border-ink-900/[0.06]">
            <div class="flex items-center justify-between px-5 py-4">
                <div class="flex items-center gap-4">
                    <button type="button" data-admin-sidebar-toggle class="lg:hidden text-navy-950">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16M4 12h16M4 17h16"/></svg>
                    </button>
                    <h1 class="text-lg font-semibold text-navy-950"><?= View::e($pageTitle) ?></h1>
                </div>
                <a href="/" target="_blank" class="text-sm text-ink-500 hover:text-navy-950">View Site &rarr;</a>
            </div>
        </header>

        <main class="p-5 lg:p-8">
            <?= View::capture('components/admin/flash') ?>
            <?= $content ?? '' ?>
        </main>
    </div>

    <script src="/assets/js/admin.js" defer></script>
</body>
</html>
