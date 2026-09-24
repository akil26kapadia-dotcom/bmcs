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
    'description' => 'TallyPrime sales and licensing, TSS renewal, Tally on Cloud, customization, TallyPrime Server, support and AMC, and data migration for businesses across Dubai and the UAE.',
    'icon' => 'coin',
    'sort_order' => 0,
]);
$idStmt = $pdo->prepare('SELECT id FROM service_categories WHERE slug = :slug');
$idStmt->execute(['slug' => 'tally-solutions']);
$categoryId = (int) $idStmt->fetchColumn();
echo "Tally Solutions category ready (id {$categoryId}).\n";

// --- Tally services --------------------------------------------------------
// Each service has its own description, capabilities, benefits, use cases and
// FAQ (see content/tally_services_content.php) — nothing is inherited from the
// category. Order follows the client's list.
$content = require __DIR__ . '/content/tally_services_content.php';
$order = ['tallyprime-sales', 'tally-renewal', 'tally-on-cloud', 'tally-customization', 'tallyprime-server', 'tally-support', 'tally-integration'];

$svcStmt = $pdo->prepare(
    'INSERT INTO services (category_id, name, slug, short_description, description, technologies, capabilities, benefits, applications, faq, meta_title, meta_description, is_featured, sort_order, status)
     VALUES (:category_id, :name, :slug, :short_description, :description, :technologies, :capabilities, :benefits, :applications, :faq, :meta_title, :meta_description, :is_featured, :sort_order, "published")
     ON DUPLICATE KEY UPDATE
        category_id = VALUES(category_id), name = VALUES(name), short_description = VALUES(short_description),
        description = VALUES(description), technologies = VALUES(technologies), capabilities = VALUES(capabilities),
        benefits = VALUES(benefits), applications = VALUES(applications), faq = VALUES(faq),
        meta_title = VALUES(meta_title), meta_description = VALUES(meta_description),
        is_featured = VALUES(is_featured), sort_order = VALUES(sort_order)'
);

foreach ($order as $i => $slug) {
    $svc = $content[$slug];
    $svcStmt->execute([
        'category_id' => $categoryId,
        'name' => $svc['name'],
        'slug' => $slug,
        'short_description' => $svc['short_description'],
        'description' => $svc['description'],
        'technologies' => $svc['technologies'],
        'capabilities' => json_encode($svc['capabilities'], JSON_UNESCAPED_UNICODE),
        'benefits' => json_encode($svc['benefits'], JSON_UNESCAPED_UNICODE),
        'applications' => json_encode($svc['applications'], JSON_UNESCAPED_UNICODE),
        'faq' => json_encode($svc['faq'], JSON_UNESCAPED_UNICODE),
        'meta_title' => $svc['meta_title'],
        'meta_description' => $svc['meta_description'],
        'is_featured' => in_array($slug, ['tallyprime-sales', 'tally-on-cloud', 'tallyprime-server'], true) ? 1 : 0,
        'sort_order' => $i + 1,
    ]);
}
echo 'Tally services seeded (' . count($order) . ").
";
