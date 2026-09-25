<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

$categories = [
    ['name' => 'Servers', 'slug' => 'servers', 'icon' => 'briefcase', 'description' => 'Rack and tower servers configured for business workloads.'],
    ['name' => 'Desktops', 'slug' => 'desktops', 'icon' => 'monitor', 'description' => 'Business desktop computers for offices of any size.'],
    ['name' => 'Laptops', 'slug' => 'laptops', 'icon' => 'monitor', 'description' => 'Laptops for office, hybrid and mobile workforces.'],
    ['name' => 'Networking Equipment', 'slug' => 'networking-equipment', 'icon' => 'network', 'description' => 'Switches, routers and access points for reliable connectivity.'],
    ['name' => 'Accessories', 'slug' => 'accessories', 'icon' => 'layers', 'description' => 'Peripherals and accessories to complete your setup.'],
    ['name' => 'Security Equipment', 'slug' => 'security-equipment', 'icon' => 'shield', 'description' => 'CCTV cameras, access control hardware and related equipment.'],
    ['name' => 'Storage', 'slug' => 'storage', 'icon' => 'cloud', 'description' => 'Storage devices and solutions for business data.'],
    ['name' => 'IT Infrastructure', 'slug' => 'it-infrastructure', 'icon' => 'life-buoy', 'description' => 'Core infrastructure hardware for your IT environment.'],
];

// Insert-only by slug, so re-running this after an admin has edited or
// renamed a category (slug unchanged) never overwrites their edit.
$check = $pdo->prepare('SELECT COUNT(*) FROM product_categories WHERE slug = :slug');
$insert = $pdo->prepare(
    'INSERT INTO product_categories (name, slug, icon, description, sort_order)
     VALUES (:name, :slug, :icon, :description, :sort_order)'
);

$count = 0;
foreach ($categories as $i => $cat) {
    $check->execute(['slug' => $cat['slug']]);
    if ((int) $check->fetchColumn() > 0) {
        continue;
    }
    $insert->execute([
        'name' => $cat['name'],
        'slug' => $cat['slug'],
        'icon' => $cat['icon'],
        'description' => $cat['description'],
        'sort_order' => $i + 1,
    ]);
    $count++;
}

echo "Product categories seeded ({$count} inserted).\n";
