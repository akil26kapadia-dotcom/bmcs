<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

// --- Default settings -------------------------------------------------
$settings = [
    'site_name' => 'Bright Mind Computer Solutions',
    'site_phone' => '+971 4 227 1773',
    'site_email' => 'info@bmcs.ae',
    'whatsapp_number' => '',
    'default_seo_title' => 'Bright Mind Computer Solutions | IT Infrastructure & Technology Solutions in Dubai',
    'default_seo_description' => 'BMCS delivers enterprise IT infrastructure, networking, security, cloud, telecommunication and digital solutions for businesses across Dubai and the UAE.',
    'footer_text' => 'Empowering Effective Solutions.',
    'ga_id' => '',
    'gsc_verification' => '',
];

$stmt = $pdo->prepare(
    'INSERT INTO settings (setting_key, setting_value) VALUES (:key, :value)
     ON DUPLICATE KEY UPDATE setting_key = setting_key'
);
foreach ($settings as $key => $value) {
    $stmt->execute(['key' => $key, 'value' => $value]);
}
echo 'Settings seeded (' . count($settings) . " keys).\n";

// --- Demo admin user ----------------------------------------------------
$adminEmail = 'admin@bmcs.ae';
$adminPassword = 'ChangeMe123!';

$check = $pdo->prepare('SELECT id FROM users WHERE email = :email');
$check->execute(['email' => $adminEmail]);

if (!$check->fetch()) {
    $insert = $pdo->prepare(
        'INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :hash, :role)'
    );
    $insert->execute([
        'name' => 'BMCS Admin',
        'email' => $adminEmail,
        'hash' => password_hash($adminPassword, PASSWORD_DEFAULT),
        'role' => 'admin',
    ]);
    echo "Demo admin user created: {$adminEmail} / {$adminPassword} (CHANGE THIS PASSWORD IMMEDIATELY).\n";
} else {
    echo "Admin user already exists, skipped.\n";
}

// --- Service categories (real BMCS service areas from company profile) --
$categories = [
    ['name' => 'Network & Infrastructure', 'slug' => 'network-infrastructure', 'icon' => 'network', 'sort_order' => 1],
    ['name' => 'Cloud & Data', 'slug' => 'cloud-data', 'icon' => 'cloud', 'sort_order' => 2],
    ['name' => 'Security & Surveillance', 'slug' => 'security-surveillance', 'icon' => 'shield', 'sort_order' => 3],
    ['name' => 'Telecommunication', 'slug' => 'telecommunication', 'icon' => 'phone', 'sort_order' => 4],
    ['name' => 'Microsoft & Business Solutions', 'slug' => 'microsoft-business-solutions', 'icon' => 'briefcase', 'sort_order' => 5],
    ['name' => 'IT Support & Distribution', 'slug' => 'it-support-distribution', 'icon' => 'life-buoy', 'sort_order' => 6],
    ['name' => 'Web & Digital', 'slug' => 'web-digital', 'icon' => 'monitor', 'sort_order' => 7],
    ['name' => 'Audio Visual', 'slug' => 'audio-visual', 'icon' => 'projector', 'sort_order' => 8],
];

$catStmt = $pdo->prepare(
    'INSERT INTO service_categories (name, slug, icon, sort_order) VALUES (:name, :slug, :icon, :sort_order)
     ON DUPLICATE KEY UPDATE name = VALUES(name), icon = VALUES(icon), sort_order = VALUES(sort_order)'
);
$categoryIds = [];
foreach ($categories as $cat) {
    $catStmt->execute($cat);
    $idStmt = $pdo->prepare('SELECT id FROM service_categories WHERE slug = :slug');
    $idStmt->execute(['slug' => $cat['slug']]);
    $categoryIds[$cat['slug']] = (int) $idStmt->fetchColumn();
}
echo 'Service categories seeded (' . count($categories) . ").\n";

// --- Services (real service names from the company profile / brief) -----
$services = [
    ['category' => 'network-infrastructure', 'name' => 'Structured Cabling', 'slug' => 'structured-cabling'],
    ['category' => 'network-infrastructure', 'name' => 'Wireless Infrastructure', 'slug' => 'wireless-infrastructure'],
    ['category' => 'network-infrastructure', 'name' => 'VPN Installation', 'slug' => 'vpn-installation'],
    ['category' => 'network-infrastructure', 'name' => 'Network Services', 'slug' => 'network-services'],
    ['category' => 'cloud-data', 'name' => 'Cloud Solutions', 'slug' => 'cloud-solutions'],
    ['category' => 'cloud-data', 'name' => 'Data Recovery & Backup', 'slug' => 'data-recovery-backup'],
    ['category' => 'cloud-data', 'name' => 'Business Continuity & Disaster Recovery', 'slug' => 'business-continuity-disaster-recovery'],
    ['category' => 'security-surveillance', 'name' => 'CCTV Surveillance', 'slug' => 'cctv-surveillance'],
    ['category' => 'security-surveillance', 'name' => 'Access Control', 'slug' => 'access-control'],
    ['category' => 'security-surveillance', 'name' => 'Firewall Solutions', 'slug' => 'firewall-solutions'],
    ['category' => 'security-surveillance', 'name' => 'Antivirus Scanning', 'slug' => 'antivirus-scanning'],
    ['category' => 'telecommunication', 'name' => 'PABX & IP Telephony', 'slug' => 'pabx-ip-telephony'],
    ['category' => 'telecommunication', 'name' => 'Telephone Recording System', 'slug' => 'telephone-recording-system'],
    ['category' => 'microsoft-business-solutions', 'name' => 'Microsoft 365 / Office 365', 'slug' => 'microsoft-365'],
    ['category' => 'microsoft-business-solutions', 'name' => 'Microsoft Licensing', 'slug' => 'microsoft-licensing'],
    ['category' => 'microsoft-business-solutions', 'name' => 'Tally on Cloud', 'slug' => 'tally-on-cloud'],
    ['category' => 'it-support-distribution', 'name' => 'IT Consultancy', 'slug' => 'it-consultancy'],
    ['category' => 'it-support-distribution', 'name' => 'IT Helpdesk', 'slug' => 'it-helpdesk'],
    ['category' => 'it-support-distribution', 'name' => 'Supplies of Server, Desktop etc.', 'slug' => 'computer-hardware-supplies'],
    ['category' => 'web-digital', 'name' => 'Website Design & Development', 'slug' => 'web-design-development'],
    ['category' => 'web-digital', 'name' => 'Mobile App Development', 'slug' => 'mobile-app-development'],
    ['category' => 'web-digital', 'name' => 'SEO & SEM', 'slug' => 'seo-sem'],
    ['category' => 'web-digital', 'name' => 'Graphic Design & Branding', 'slug' => 'graphic-design-branding'],
    ['category' => 'audio-visual', 'name' => 'Video Conferencing', 'slug' => 'video-conferencing'],
    ['category' => 'audio-visual', 'name' => 'Projectors', 'slug' => 'projectors'],
];

$svcStmt = $pdo->prepare(
    'INSERT INTO services (category_id, name, slug, sort_order) VALUES (:category_id, :name, :slug, :sort_order)
     ON DUPLICATE KEY UPDATE name = VALUES(name), category_id = VALUES(category_id)'
);
foreach ($services as $i => $svc) {
    $svcStmt->execute([
        'category_id' => $categoryIds[$svc['category']],
        'name' => $svc['name'],
        'slug' => $svc['slug'],
        'sort_order' => $i,
    ]);
}
echo 'Services seeded (' . count($services) . ").\n";

// --- Portfolio: clearly-marked sample projects (no real client data) ----
$portfolioProjects = [
    [
        'title' => 'Enterprise Network Infrastructure Upgrade (Sample Project)',
        'slug' => 'enterprise-network-infrastructure-upgrade-sample',
        'category' => 'network-infrastructure',
        'industry' => 'Corporate Office',
        'summary' => 'A representative example of a structured cabling and wireless infrastructure rollout for a multi-floor office environment.',
        'challenge' => 'An outdated cabling setup was causing intermittent connectivity and could not support planned growth in connected devices.',
        'solution' => 'Design and installation of structured cabling, core network switching, and enterprise-grade wireless access points across all floors.',
        'outcome' => 'A stable, scalable network foundation ready to support future expansion.',
        'technologies' => 'Structured Cabling, Enterprise Wi-Fi, Network Switching',
        'featured_image' => '/assets/images/portfolio/portfolio-network.webp',
        'gallery' => [
            '/assets/images/portfolio/portfolio-network.webp',
            '/assets/images/portfolio/portfolio-network-2.webp',
            '/assets/images/portfolio/portfolio-network-3.webp',
        ],
    ],
    [
        'title' => 'CCTV Surveillance Deployment (Sample Project)',
        'slug' => 'cctv-surveillance-deployment-sample',
        'category' => 'security-surveillance',
        'industry' => 'Retail / Commercial',
        'summary' => 'An illustrative CCTV and access control deployment for a commercial premises requiring round-the-clock monitoring.',
        'challenge' => 'Limited visibility across entry points and storage areas created gaps in on-site security.',
        'solution' => 'Installation of networked CCTV cameras with centralized recording, plus access control at key entry points.',
        'outcome' => 'Full site coverage with centralized, remotely accessible monitoring.',
        'technologies' => 'CCTV Surveillance, Access Control',
        'featured_image' => '/assets/images/portfolio/portfolio-security.webp',
        'gallery' => [
            '/assets/images/portfolio/portfolio-security.webp',
            '/assets/images/portfolio/portfolio-security-2.webp',
            '/assets/images/portfolio/portfolio-security-3.webp',
        ],
    ],
    [
        'title' => 'Cloud & Backup Migration (Sample Project)',
        'slug' => 'cloud-backup-migration-sample',
        'category' => 'cloud-data',
        'industry' => 'Professional Services',
        'summary' => 'A sample migration of on-premises file storage and backup workflows to a managed cloud environment.',
        'challenge' => 'Manual, on-site backups left data vulnerable to hardware failure and site-specific incidents.',
        'solution' => 'Migration to cloud-based storage with automated, scheduled backup and disaster-recovery planning.',
        'outcome' => 'Reduced data-loss risk with automated, verifiable backups.',
        'technologies' => 'Cloud Solutions, Backup & Disaster Recovery',
        'featured_image' => '/assets/images/portfolio/portfolio-cloud.webp',
        'gallery' => [
            '/assets/images/portfolio/portfolio-cloud.webp',
            '/assets/images/portfolio/portfolio-cloud-2.webp',
            '/assets/images/portfolio/portfolio-cloud-3.webp',
        ],
    ],
];

$portStmt = $pdo->prepare(
    'INSERT INTO portfolio_projects
        (title, slug, category_id, industry, summary, challenge, solution, outcome, technologies, featured_image, gallery, status, is_demo, sort_order)
     VALUES
        (:title, :slug, :category_id, :industry, :summary, :challenge, :solution, :outcome, :technologies, :featured_image, :gallery, "published", 1, :sort_order)
     ON DUPLICATE KEY UPDATE title = VALUES(title), summary = VALUES(summary), gallery = VALUES(gallery)'
);
foreach ($portfolioProjects as $i => $project) {
    $portStmt->execute([
        'title' => $project['title'],
        'slug' => $project['slug'],
        'category_id' => $categoryIds[$project['category']],
        'industry' => $project['industry'],
        'summary' => $project['summary'],
        'challenge' => $project['challenge'],
        'solution' => $project['solution'],
        'outcome' => $project['outcome'],
        'technologies' => $project['technologies'],
        'featured_image' => $project['featured_image'],
        'gallery' => json_encode($project['gallery']),
        'sort_order' => $i,
    ]);
}
echo 'Portfolio sample projects seeded (' . count($portfolioProjects) . ").\n";
