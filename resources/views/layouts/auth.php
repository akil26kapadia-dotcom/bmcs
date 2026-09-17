<?php

use App\Core\View;
use App\Helpers\Asset;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= View::e($title ?? 'Admin Login') ?> | BMCS Admin</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon-32.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/apple-touch-icon.png">
    <link rel="stylesheet" href="<?= View::e(Asset::versioned('/assets/css/app.css')) ?>">
</head>
<body class="bg-navy-950 min-h-screen flex items-center justify-center px-6">
    <?= $content ?? '' ?>
</body>
</html>
