<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

// --- Service category content ---
$categoryContent = require __DIR__ . '/content/service_categories_content.php';

$catStmt = $pdo->prepare(
    'UPDATE service_categories SET description = :description, capabilities = :capabilities,
        benefits = :benefits, applications = :applications, faq = :faq
     WHERE slug = :slug'
);

$catCount = 0;
foreach ($categoryContent as $slug => $data) {
    $catStmt->execute([
        'description' => $data['description'],
        'capabilities' => json_encode($data['capabilities']),
        'benefits' => json_encode($data['benefits']),
        'applications' => json_encode($data['applications']),
        'faq' => json_encode($data['faq']),
        'slug' => $slug,
    ]);
    $catCount += $catStmt->rowCount() >= 0 ? 1 : 0;
}
echo "Service category content updated ({$catCount} categories processed).\n";

// --- Service content ---
$serviceContent = require __DIR__ . '/content/services_content.php';

$svcStmt = $pdo->prepare(
    'UPDATE services SET short_description = :short_description, description = :description,
        technologies = :technologies, meta_title = :meta_title, meta_description = :meta_description
     WHERE slug = :slug'
);

$svcCount = 0;
foreach ($serviceContent as $slug => $data) {
    $result = $svcStmt->execute([
        'short_description' => $data['short_description'],
        'description' => $data['description'],
        'technologies' => $data['technologies'],
        'meta_title' => $data['meta_title'],
        'meta_description' => $data['meta_description'],
        'slug' => $slug,
    ]);

    if ($result && $svcStmt->rowCount() === 0) {
        fwrite(STDERR, "WARNING: no service row matched slug '{$slug}' — check it exists in the seeder.\n");
    }
    $svcCount++;
}
echo "Service content updated ({$svcCount} services processed).\n";
