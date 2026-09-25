<?php

declare(strict_types=1);

/**
 * Default header/footer links. The Tally and IT Services dropdown anchors in
 * the header are not here — they are structural (their submenus are wired to
 * live Category/Service data) and stay fixed in navbar.php. Their sort_order
 * slots (20 and 40) are reserved so admin-added items can be positioned
 * before, between or after them.
 */

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

$items = [
    ['location' => 'header', 'label' => 'Home', 'url' => '/', 'sort_order' => 10],
    ['location' => 'header', 'label' => 'About', 'url' => '/about', 'sort_order' => 30],
    ['location' => 'header', 'label' => 'Products', 'url' => '/products', 'sort_order' => 50],
    ['location' => 'header', 'label' => 'Blog', 'url' => '/blog', 'sort_order' => 60],
    ['location' => 'header', 'label' => 'Contact', 'url' => '/contact', 'sort_order' => 70],

    ['location' => 'footer', 'label' => 'About Us', 'url' => '/about', 'sort_order' => 10],
    ['location' => 'footer', 'label' => 'Services', 'url' => '/services', 'sort_order' => 20],
    ['location' => 'footer', 'label' => 'Solutions We Deliver', 'url' => '/solutions', 'sort_order' => 30],
    ['location' => 'footer', 'label' => 'Blog', 'url' => '/blog', 'sort_order' => 40],
    ['location' => 'footer', 'label' => 'Products', 'url' => '/products', 'sort_order' => 50],
    ['location' => 'footer', 'label' => 'Contact', 'url' => '/contact', 'sort_order' => 60],
];

// Insert-only: running this again after an admin has edited/reordered the
// menu should not reset their work. Uniqueness is on (location, label).
$check = $pdo->prepare('SELECT COUNT(*) FROM menu_items WHERE location = :location AND label = :label');
$insert = $pdo->prepare(
    'INSERT INTO menu_items (location, label, url, sort_order) VALUES (:location, :label, :url, :sort_order)'
);

$count = 0;
foreach ($items as $item) {
    $check->execute(['location' => $item['location'], 'label' => $item['label']]);
    if ((int) $check->fetchColumn() > 0) {
        continue;
    }
    $insert->execute($item);
    $count++;
}

echo "Menu items seeded ({$count} inserted).\n";
