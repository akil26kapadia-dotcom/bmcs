<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

// Two IT services the client asked to see presented explicitly alongside
// Tally: Servers, and IT AMC. Both sit in "IT Support & Distribution".
$catStmt = $pdo->prepare('SELECT id FROM service_categories WHERE slug = :slug');
$catStmt->execute(['slug' => 'it-support-distribution']);
$categoryId = (int) $catStmt->fetchColumn();
if ($categoryId === 0) {
    fwrite(STDERR, "it-support-distribution category not found - run seed.php first.\n");
    exit(1);
}

$services = [
    [
        'name' => 'Servers & Storage',
        'slug' => 'servers-storage',
        'icon' => 'server',
        'short_description' => 'Server and storage supply, installation and configuration for Dubai businesses that need reliable central systems.',
        'description' => "A server is the centre of most business networks: file sharing, applications, databases, backups and user accounts all depend on it. Bright Mind Computer Solutions specifies, supplies, installs and configures servers and storage for businesses in Dubai and across the UAE.\n\nWe size the hardware to what you actually run and how many people use it, set up the operating system, roles, users and backups, and hand over documented, supportable systems rather than a box on a shelf.",
        'technologies' => 'Rack and tower servers, Windows Server, file and application servers, NAS and storage, RAID, backup',
        'capabilities' => [
            'Server sizing based on users, applications and growth',
            'Supply of rack and tower servers and storage from established brands',
            'Windows Server installation, roles and user management',
            'File sharing, permissions and shared storage configuration',
            'RAID and storage design for resilience',
            'Backup configuration and restore testing',
            'Migration from an old server to a new one',
            'Hosting for business software such as TallyPrime Server',
        ],
        'benefits' => [
            'A server sized to your business rather than over- or under-specified',
            'Central, controlled storage for company files',
            'Data protected by RAID and tested backups',
            'Hardware supply and configuration from one team',
        ],
        'applications' => [
            'Offices moving from shared PCs to a proper file server',
            'Businesses replacing an ageing server',
            'Companies hosting accounting or ERP software on-site',
            'Branch offices that need local storage and user management',
        ],
        'faq' => [
            ['q' => 'Can you supply and set up the server?', 'a' => 'Yes. We recommend a specification, supply the hardware, install the operating system and configure users, storage and backups.'],
            ['q' => 'Can you migrate us from an old server?', 'a' => 'Yes. We plan the move, transfer files, users and shares, and cut over at a time that limits disruption.'],
            ['q' => 'Do you support servers after installation?', 'a' => 'Yes, on a one-off basis or under an IT AMC.'],
        ],
        'meta_title' => 'Servers & Storage Solutions in Dubai',
        'meta_description' => 'Server and storage supply, installation and configuration in Dubai and the UAE, including RAID, backups and migration, from Bright Mind Computer Solutions.',
    ],
    [
        'name' => 'IT AMC & Managed Support',
        'slug' => 'it-amc-support',
        'icon' => 'refresh',
        'short_description' => 'Annual maintenance contracts for your computers, servers and network, so problems are handled before they stop the business.',
        'description' => "An IT Annual Maintenance Contract (AMC) gives a business a fixed, predictable arrangement for looking after its computers, servers, network and peripherals. Bright Mind Computer Solutions provides IT AMC and managed support for businesses in Dubai and across the UAE.\n\nThe contract defines what equipment is covered, how quickly we respond and how often we check it, so you know what to expect and what it costs for the year.",
        'technologies' => 'Desktop and laptop support, server maintenance, network support, backup checks, remote and on-site support',
        'capabilities' => [
            'Asset list of covered computers, servers, network and peripherals',
            'Agreed response times for issues',
            'Scheduled preventive maintenance visits',
            'Remote support for day-to-day user problems',
            'On-site visits within Dubai when needed',
            'Server, network and backup health checks',
            'Antivirus and update management',
            'Coverage for business software such as TallyPrime, quoted separately',
        ],
        'benefits' => [
            'Predictable yearly IT cost',
            'Faster fixes because we already know your environment',
            'Problems caught early through preventive checks',
            'No need to hire a full-time IT technician for a small team',
        ],
        'applications' => [
            'Small and mid-sized offices without an in-house IT team',
            'Businesses with a server and a network that must stay up',
            'Companies that want one contact for hardware, network and software issues',
            'Organisations wanting scheduled backup and security checks',
        ],
        'faq' => [
            ['q' => 'What is an IT AMC?', 'a' => 'An Annual Maintenance Contract is a yearly agreement that covers support and preventive maintenance for your IT equipment, with defined response times.'],
            ['q' => 'What equipment can be covered?', 'a' => 'Desktops, laptops, servers, network devices and printers are typical. We list exactly what is covered in the contract.'],
            ['q' => 'Can I get support for one problem without a contract?', 'a' => 'Yes, one-off support is available. An AMC is for businesses that want ongoing cover.'],
        ],
        'meta_title' => 'IT AMC & Managed IT Support Dubai',
        'meta_description' => 'IT annual maintenance contracts in Dubai and the UAE: response-time agreements, preventive maintenance, and remote and on-site support from BMCS.',
    ],
];

$stmt = $pdo->prepare(
    'INSERT INTO services (category_id, name, slug, icon, short_description, description, technologies, capabilities, benefits, applications, faq, meta_title, meta_description, is_featured, sort_order, status)
     VALUES (:category_id, :name, :slug, :icon, :short_description, :description, :technologies, :capabilities, :benefits, :applications, :faq, :meta_title, :meta_description, 0, :sort_order, "published")
     ON DUPLICATE KEY UPDATE category_id = VALUES(category_id), name = VALUES(name), icon = VALUES(icon),
        short_description = VALUES(short_description), description = VALUES(description), technologies = VALUES(technologies),
        capabilities = VALUES(capabilities), benefits = VALUES(benefits), applications = VALUES(applications), faq = VALUES(faq),
        meta_title = VALUES(meta_title), meta_description = VALUES(meta_description)'
);

foreach ($services as $i => $svc) {
    $stmt->execute([
        'category_id' => $categoryId,
        'name' => $svc['name'],
        'slug' => $svc['slug'],
        'icon' => $svc['icon'],
        'short_description' => $svc['short_description'],
        'description' => $svc['description'],
        'technologies' => $svc['technologies'],
        'capabilities' => json_encode($svc['capabilities'], JSON_UNESCAPED_UNICODE),
        'benefits' => json_encode($svc['benefits'], JSON_UNESCAPED_UNICODE),
        'applications' => json_encode($svc['applications'], JSON_UNESCAPED_UNICODE),
        'faq' => json_encode($svc['faq'], JSON_UNESCAPED_UNICODE),
        'meta_title' => $svc['meta_title'],
        'meta_description' => $svc['meta_description'],
        'sort_order' => 10 + $i,
    ]);
}
echo 'IT services seeded (' . count($services) . ").\n";
