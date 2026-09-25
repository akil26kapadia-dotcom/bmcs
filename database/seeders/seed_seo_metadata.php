<?php

declare(strict_types=1);

/**
 * Prefills Admin > SEO with the titles/descriptions the site already shows
 * today (copied from each controller), so the admin panel reflects reality
 * from the start instead of showing blank fields. Insert-only: an existing
 * row (including one an admin has since edited) is left untouched.
 */

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

$rows = [
    'home' => [
        'meta_title' => 'TallyPrime Solutions & Complete IT Services in Dubai, UAE',
        'meta_description' => 'Bright Mind Computer Solutions LLC: TallyPrime sales, TSS renewal, Tally on Cloud, TallyPrime Server, customization and support in Dubai and the UAE, plus IT hardware, servers, networking, cybersecurity, CCTV and AMC.',
    ],
    'about' => [
        'meta_title' => 'About BMCS',
        'meta_description' => 'Bright Mind Computer Solutions (BMCS) is a Dubai-based IT and technology solutions provider delivering enterprise computing, networking, security and digital services across the UAE.',
    ],
    'services' => [
        'meta_title' => 'Our Services',
        'meta_description' => 'Explore the full range of IT infrastructure, security, cloud, telecommunication and digital services BMCS delivers across Dubai and the UAE.',
    ],
    'solutions' => [
        'meta_title' => 'Solutions We Deliver in Dubai & UAE',
        'meta_description' => 'TallyPrime solutions plus network infrastructure, cloud, security, telecommunication, Microsoft, IT support and digital services delivered by Bright Mind Computer Solutions in Dubai and the UAE.',
    ],
    'solutions/tally-solutions' => [
        'meta_title' => 'TallyPrime Solutions in Dubai & UAE',
        'meta_description' => 'TallyPrime Dubai and UAE: sales and licensing, TSS renewal, Tally on Cloud, TallyPrime Server, customization, support and AMC, and data migration from Bright Mind Computer Solutions.',
    ],
    'products' => [
        'meta_title' => 'IT Products & Distribution',
        'meta_description' => 'BMCS supplies and configures servers, desktops, laptops, networking equipment and IT accessories for businesses across Dubai and the UAE.',
    ],
    'portfolio' => [
        'meta_title' => 'Portfolio',
        'meta_description' => 'Representative examples of the network, security, cloud and digital projects BMCS delivers for businesses across Dubai and the UAE.',
    ],
    'blog' => [
        'meta_title' => 'Blog',
        'meta_description' => 'Technology insights and updates from BMCS covering IT infrastructure, networking, security, cloud and digital solutions.',
    ],
    'contact' => [
        'meta_title' => 'Contact Us',
        'meta_description' => 'Get in touch with Bright Mind Computer Solutions (BMCS) for IT infrastructure, networking, security, cloud and digital solutions in Dubai and the UAE.',
    ],
];

$stmt = $pdo->prepare(
    'INSERT INTO seo_metadata (route_key, meta_title, meta_description)
     VALUES (:route_key, :meta_title, :meta_description)
     ON DUPLICATE KEY UPDATE route_key = route_key'
);

foreach ($rows as $routeKey => $data) {
    $stmt->execute([
        'route_key' => $routeKey,
        'meta_title' => $data['meta_title'],
        'meta_description' => $data['meta_description'],
    ]);
}

echo 'SEO metadata seeded (' . count($rows) . ").\n";
