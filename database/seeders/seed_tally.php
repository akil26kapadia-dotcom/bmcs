<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

// --- WhatsApp number -----------------------------------------------------
$stmt = $pdo->prepare('UPDATE settings SET setting_value = :value WHERE setting_key = :key');
$stmt->execute(['value' => '+971 50 840 2607', 'key' => 'whatsapp_number']);
echo "WhatsApp number set.\n";

// --- Tally Solutions category (sort_order 0 = shown first / top position) -
$catStmt = $pdo->prepare(
    'INSERT INTO service_categories (name, slug, description, icon, sort_order)
     VALUES (:name, :slug, :description, :icon, :sort_order)
     ON DUPLICATE KEY UPDATE description = VALUES(description), icon = VALUES(icon), sort_order = VALUES(sort_order)'
);
$catStmt->execute([
    'name' => 'Tally Solutions',
    'slug' => 'tally-solutions',
    'description' => 'Authorized TallyPrime sales, renewal, customization, cloud hosting, support and data migration services for businesses across Dubai and the UAE.',
    'icon' => 'coin',
    'sort_order' => 0,
]);
$idStmt = $pdo->prepare('SELECT id FROM service_categories WHERE slug = :slug');
$idStmt->execute(['slug' => 'tally-solutions']);
$categoryId = (int) $idStmt->fetchColumn();
echo "Tally Solutions category ready (id {$categoryId}).\n";

// --- Tally services --------------------------------------------------------
$services = [
    [
        'name' => 'TallyPrime Sales & Licensing',
        'slug' => 'tallyprime-sales',
        'short_description' => 'Genuine TallyPrime licences — single-user and multi-user — sold and set up by an authorized Dubai partner.',
        'description' => 'We supply and activate genuine TallyPrime licences for businesses across the UAE, covering both Silver (single-user) and Gold (multi-user, multi-location) editions. Our team handles licence selection, activation and initial configuration so your business is transacting in TallyPrime correctly from day one, with a local partner on hand for ongoing support.',
        'technologies' => 'TallyPrime Silver, TallyPrime Gold, TallyPrime Server',
        'meta_title' => 'TallyPrime Sales & Support in Dubai, UAE',
        'meta_description' => 'Genuine TallyPrime single-user and multi-user licences, sold and configured by an authorized partner in Dubai. Get TallyPrime set up correctly from day one.',
        'is_featured' => 1,
    ],
    [
        'name' => 'TallyPrime Renewal & TSS',
        'slug' => 'tally-renewal',
        'short_description' => 'On-time TallyPrime and TSS (Tally Software Services) renewal so you never lose access to updates or connected services.',
        'description' => 'A lapsed TSS subscription can cut off statutory updates, remote access and other connected Tally services right when you need them most. We manage TallyPrime licence and TSS renewals for our clients, tracking expiry dates and handling the renewal process directly so your Tally environment stays current and compliant.',
        'technologies' => 'TallyPrime renewal, TSS (Tally Software Services)',
        'meta_title' => 'TallyPrime Renewal & TSS Renewal UAE',
        'meta_description' => 'TallyPrime licence and TSS renewal services in Dubai and the UAE — stay current on updates and connected services with no lapse in coverage.',
        'is_featured' => 0,
    ],
    [
        'name' => 'TallyPrime Customization',
        'slug' => 'tally-customization',
        'short_description' => 'Custom TDL add-ons and report tweaks that adapt TallyPrime to how your business actually works.',
        'description' => 'Out-of-the-box TallyPrime does not always match a business\'s exact invoicing, reporting or approval workflow. We build custom TDL (Tally Definition Language) add-ons, custom print formats and modified reports so TallyPrime fits your specific processes instead of the other way around.',
        'technologies' => 'TDL (Tally Definition Language), custom reports, custom print formats',
        'meta_title' => 'TallyPrime Customization Services Dubai',
        'meta_description' => 'Custom TDL add-ons, reports and print formats for TallyPrime, built in Dubai to match your business\'s exact workflow.',
        'is_featured' => 0,
    ],
    [
        'name' => 'Tally on Cloud',
        'slug' => 'tally-on-cloud',
        'short_description' => 'Access your TallyPrime data securely from anywhere, on any device, with Tally on Cloud hosting.',
        'description' => 'Tally on Cloud hosts your TallyPrime installation and data on secure remote servers, so your team — and your accountant — can work from the office, from home or while traveling, without carrying data on a single machine. We handle setup, data migration and ongoing hosting, with daily backups included.',
        'technologies' => 'Tally on Cloud, remote desktop access, cloud hosting',
        'meta_title' => 'Tally on Cloud Services in Dubai, UAE',
        'meta_description' => 'Host TallyPrime on the cloud and access your accounts securely from any device, anywhere. Setup, migration and hosting handled by BMCS in Dubai.',
        'is_featured' => 1,
    ],
    [
        'name' => 'TallyPrime Support & AMC',
        'slug' => 'tally-support',
        'short_description' => 'Ongoing TallyPrime technical support and Annual Maintenance Contracts (AMC) for peace of mind.',
        'description' => 'From day-to-day troubleshooting to data repair and performance issues, our TallyPrime support covers what your business needs to keep running. We offer Annual Maintenance Contracts (AMC) with defined response times, alongside one-off support for businesses that just need an issue resolved.',
        'technologies' => 'TallyPrime AMC, remote and on-site support, data repair',
        'meta_title' => 'TallyPrime AMC & Technical Support UAE',
        'meta_description' => 'TallyPrime technical support and Annual Maintenance Contracts (AMC) in Dubai and the UAE, covering troubleshooting, data repair and day-to-day issues.',
        'is_featured' => 0,
    ],
    [
        'name' => 'TallyPrime Integration & Data Migration',
        'slug' => 'tally-integration',
        'short_description' => 'Migrate from an older Tally version or another accounting system, and connect TallyPrime to the other tools you use.',
        'description' => 'Moving to TallyPrime from Tally.ERP 9 or another accounting package involves careful data migration to avoid losing transaction history. We manage that migration end to end, and also integrate TallyPrime with e-commerce platforms, payment gateways, CRMs and other business systems where needed.',
        'technologies' => 'Tally.ERP 9 to TallyPrime migration, third-party integrations, data import/export',
        'meta_title' => 'TallyPrime Integration & Data Migration',
        'meta_description' => 'TallyPrime data migration from Tally.ERP 9 or other systems, plus integration with e-commerce, payment and CRM platforms. Handled by BMCS in Dubai.',
        'is_featured' => 0,
    ],
];

$svcStmt = $pdo->prepare(
    'INSERT INTO services (category_id, name, slug, short_description, description, technologies, meta_title, meta_description, is_featured, sort_order, status)
     VALUES (:category_id, :name, :slug, :short_description, :description, :technologies, :meta_title, :meta_description, :is_featured, :sort_order, "published")
     ON DUPLICATE KEY UPDATE
        category_id = VALUES(category_id), name = VALUES(name), short_description = VALUES(short_description),
        description = VALUES(description), technologies = VALUES(technologies), meta_title = VALUES(meta_title),
        meta_description = VALUES(meta_description), is_featured = VALUES(is_featured), sort_order = VALUES(sort_order)'
);

foreach ($services as $i => $svc) {
    $svcStmt->execute([
        'category_id' => $categoryId,
        'name' => $svc['name'],
        'slug' => $svc['slug'],
        'short_description' => $svc['short_description'],
        'description' => $svc['description'],
        'technologies' => $svc['technologies'],
        'meta_title' => $svc['meta_title'],
        'meta_description' => $svc['meta_description'],
        'is_featured' => $svc['is_featured'],
        'sort_order' => $i + 1,
    ]);
}
echo 'Tally services seeded (' . count($services) . ").\n";
