<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

// Per-service icons, so cards within the same category no longer all show
// the identical category icon. Keys are Icon.php icon names.
$icons = [
    // Tally Solutions
    'tallyprime-sales' => 'cart',
    'tally-renewal' => 'refresh',
    'tally-customization' => 'gear',
    'tally-on-cloud' => 'cloud',
    'tallyprime-server' => 'server',
    'tally-support' => 'life-buoy',
    'tally-integration' => 'link',

    // Network & Infrastructure
    'structured-cabling' => 'plug',
    'wireless-infrastructure' => 'network',
    'vpn-installation' => 'lock',
    'network-services' => 'gear',

    // Cloud & Data
    'cloud-solutions' => 'cloud',
    'data-recovery-backup' => 'refresh',
    'business-continuity-disaster-recovery' => 'shield',

    // Security & Surveillance
    'cctv-surveillance' => 'camera',
    'access-control' => 'lock',
    'firewall-solutions' => 'shield',
    'antivirus-scanning' => 'search',

    // Telecommunication
    'pabx-ip-telephony' => 'phone',
    'telephone-recording-system' => 'microphone',

    // Microsoft & Business Solutions
    'microsoft-365' => 'briefcase',
    'microsoft-licensing' => 'badge',

    // IT Support & Distribution
    'it-consultancy' => 'bulb',
    'it-helpdesk' => 'life-buoy',
    'computer-hardware-supplies' => 'server',

    // Web & Digital
    'web-design-development' => 'code',
    'mobile-app-development' => 'mobile',
    'seo-sem' => 'chart',
    'graphic-design-branding' => 'palette',

    // Audio Visual
    'video-conferencing' => 'video',
    'projectors' => 'projector',
];

$stmt = $pdo->prepare('UPDATE services SET icon = :icon WHERE slug = :slug');
$count = 0;
foreach ($icons as $slug => $icon) {
    $stmt->execute(['icon' => $icon, 'slug' => $slug]);
    $count++;
}
echo "Service icons set ({$count} services processed).\n";
