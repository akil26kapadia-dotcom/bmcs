<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../vendor/autoload.php';

Env::load(__DIR__ . '/../.env');

$pdo = Database::connection();

$pdo->exec(
    'CREATE TABLE IF NOT EXISTS migrations (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        migration VARCHAR(180) NOT NULL,
        run_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY uq_migrations_name (migration)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
);

$applied = $pdo->query('SELECT migration FROM migrations')->fetchAll(PDO::FETCH_COLUMN);

$files = glob(__DIR__ . '/migrations/*.sql');
sort($files);

$ranCount = 0;

foreach ($files as $file) {
    $name = basename($file);

    if (in_array($name, $applied, true)) {
        echo "skip   {$name}\n";
        continue;
    }

    $sql = file_get_contents($file);

    // MySQL DDL statements auto-commit, so migrations aren't wrapped in a
    // transaction; each .sql file should be safe to re-run (IF NOT EXISTS).
    try {
        $pdo->exec($sql);
        $stmt = $pdo->prepare('INSERT INTO migrations (migration) VALUES (:migration)');
        $stmt->execute(['migration' => $name]);
        echo "applied {$name}\n";
        $ranCount++;
    } catch (Throwable $e) {
        fwrite(STDERR, "FAILED  {$name}: {$e->getMessage()}\n");
        exit(1);
    }
}

echo "\n{$ranCount} migration(s) applied.\n";
