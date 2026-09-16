<?php

declare(strict_types=1);

/**
 * Old URLs are the real paths from the previous bmcs.ae WordPress site
 * (confirmed via the live site's navigation), mapped to their closest
 * equivalent on the new site. This preserves search visibility for any
 * existing inbound links/rankings rather than losing them to a 404.
 */

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

$redirects = [
    '/about/' => '/about',
    '/portfolio/' => '/portfolio',
    '/contact-us/' => '/contact',
    '/structured-cabling-2/' => '/services/structured-cabling',
    '/wireless-solution/' => '/services/wireless-infrastructure',
    '/vpn-services/' => '/services/vpn-installation',
    '/small-office/' => '/services/pabx-ip-telephony',
    '/ip-telephony/' => '/services/pabx-ip-telephony',
    '/microsoft-server-platform/' => '/solutions/microsoft-business-solutions',
    '/microsoft-office-365/' => '/services/microsoft-365',
    '/cctv/' => '/services/cctv-surveillance',
    '/biometricc-time-attendance/' => '/services/access-control',
    '/door-access-control/' => '/services/access-control',
    '/helpdesk/' => '/services/it-helpdesk',
    '/accounting-app-on-cloud/' => '/services/tally-on-cloud',
    '/shop/' => '/products',
    '/cart/' => '/products',
];

$stmt = $pdo->prepare(
    'INSERT INTO redirects (old_path, new_path, status_code) VALUES (:old_path, :new_path, 301)
     ON DUPLICATE KEY UPDATE new_path = VALUES(new_path)'
);

foreach ($redirects as $oldPath => $newPath) {
    // Normalize: stored old_path is compared against our own leading-slash
    // path in index.php, without the trailing slash the old WP site used.
    $stmt->execute(['old_path' => rtrim($oldPath, '/') ?: '/', 'new_path' => $newPath]);
}

echo 'Redirects seeded (' . count($redirects) . ").\n";
