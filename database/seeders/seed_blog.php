<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

$adminId = (int) $pdo->query("SELECT id FROM users WHERE email = 'admin@bmcs.ae' LIMIT 1")->fetchColumn();

// --- Blog categories ------------------------------------------------
$categories = [
    ['name' => 'Networking', 'slug' => 'networking'],
    ['name' => 'Cloud & Backup', 'slug' => 'cloud-backup'],
    ['name' => 'Security', 'slug' => 'security'],
    ['name' => 'Microsoft & Productivity', 'slug' => 'microsoft-productivity'],
    ['name' => 'Business Tips', 'slug' => 'business-tips'],
];

$catStmt = $pdo->prepare(
    'INSERT INTO categories (name, slug) VALUES (:name, :slug) ON DUPLICATE KEY UPDATE name = VALUES(name)'
);
$categoryIds = [];
foreach ($categories as $cat) {
    $catStmt->execute($cat);
    $idStmt = $pdo->prepare('SELECT id FROM categories WHERE slug = :slug');
    $idStmt->execute(['slug' => $cat['slug']]);
    $categoryIds[$cat['slug']] = (int) $idStmt->fetchColumn();
}
echo 'Blog categories seeded (' . count($categories) . ").\n";

// --- Tags -------------------------------------------------------------
$tags = [
    ['name' => 'IT Tips', 'slug' => 'it-tips'],
    ['name' => 'Cybersecurity', 'slug' => 'cybersecurity'],
    ['name' => 'Cloud', 'slug' => 'cloud'],
    ['name' => 'SMB', 'slug' => 'smb'],
    ['name' => 'Office Setup', 'slug' => 'office-setup'],
];

$tagStmt = $pdo->prepare(
    'INSERT INTO tags (name, slug) VALUES (:name, :slug) ON DUPLICATE KEY UPDATE name = VALUES(name)'
);
$tagIds = [];
foreach ($tags as $tag) {
    $tagStmt->execute($tag);
    $idStmt = $pdo->prepare('SELECT id FROM tags WHERE slug = :slug');
    $idStmt->execute(['slug' => $tag['slug']]);
    $tagIds[$tag['slug']] = (int) $idStmt->fetchColumn();
}
echo 'Tags seeded (' . count($tags) . ").\n";

// --- Posts --------------------------------------------------------------
$posts = [
    [
        'title' => '5 Signs Your Business Network Needs an Upgrade',
        'slug' => '5-signs-your-business-network-needs-an-upgrade',
        'category' => 'networking',
        'tags' => ['it-tips', 'smb'],
        'status' => 'published',
        'published_at' => '-12 days',
        'is_featured' => 1,
        'featured_image' => '/assets/images/services/solution-network.webp',
        'excerpt' => 'Slow file transfers and dropped Wi-Fi are usually symptoms of a bigger problem. Here is how to tell when it is time to upgrade your network.',
        'content' => "<p>Most businesses do not think about their network until something goes wrong. But a few warning signs tend to show up well before a full outage.</p>
<h2>1. Wi-Fi dead zones</h2>
<p>If certain areas of your office consistently struggle to connect, it usually means your wireless access points were never properly planned for your floor layout.</p>
<h2>2. Frequent dropped connections</h2>
<p>Intermittent connectivity during video calls or file transfers often points to outdated switches or cabling that cannot keep up with modern demand.</p>
<h2>3. Slow file transfers between devices</h2>
<p>If moving files between two computers on the same network feels slower than uploading to the cloud, your internal network infrastructure is likely the bottleneck.</p>
<h2>4. You have outgrown your original setup</h2>
<p>Networks designed for 10 people rarely scale cleanly to 40. Added devices, printers and smart equipment all compete for the same limited capacity.</p>
<h2>5. No one can tell you what is actually connected</h2>
<p>If there is no up-to-date map of your network, troubleshooting becomes guesswork every time something breaks.</p>
<blockquote>A stable network is invisible when it works — and very visible when it does not.</blockquote>
<p>If any of this sounds familiar, a network assessment is usually the fastest way to find out exactly what needs attention.</p>",
        'meta_title' => '5 Signs Your Business Network Needs an Upgrade',
        'meta_description' => 'Slow Wi-Fi, dropped connections and outgrown infrastructure are common signs your business network needs an upgrade. Here is what to look for.',
    ],
    [
        'title' => 'Why Every Business Needs a Backup and Disaster Recovery Plan',
        'slug' => 'why-every-business-needs-a-backup-and-disaster-recovery-plan',
        'category' => 'cloud-backup',
        'tags' => ['cloud', 'smb'],
        'status' => 'published',
        'published_at' => '-8 days',
        'is_featured' => 0,
        'featured_image' => '/assets/images/services/solution-cloud.webp',
        'excerpt' => 'Hardware fails, files get deleted by accident, and sometimes disaster is entirely unpredictable. A backup plan turns a crisis into an inconvenience.',
        'content' => "<p>It is easy to assume data loss will not happen until it does. A single failed hard drive or accidental deletion can put weeks of work at risk.</p>
<h2>Backups are not a single copy</h2>
<p>A proper backup strategy keeps multiple recent versions of your data, stored in more than one location, so a single point of failure cannot take everything down at once.</p>
<h2>Disaster recovery is more than backups</h2>
<p>Backup and disaster recovery are related but different. Backups protect the data itself; disaster recovery is the plan for how quickly your business can get back to operating after something goes wrong.</p>
<ul>
<li>How long can your business realistically operate without access to its systems?</li>
<li>How much data could you afford to lose if you had to restore from yesterday's backup?</li>
<li>Who is responsible for actually running a recovery if it is needed?</li>
</ul>
<p>Answering these questions is usually the starting point for building a plan that matches your business, rather than a generic checklist.</p>",
        'meta_title' => 'Why Every Business Needs a Backup and Disaster Recovery Plan',
        'meta_description' => 'Backups and disaster recovery protect your business from data loss and downtime. Here is why both matter and how they differ.',
    ],
    [
        'title' => 'CCTV vs Access Control: What Does Your Business Actually Need?',
        'slug' => 'cctv-vs-access-control-what-does-your-business-need',
        'category' => 'security',
        'tags' => ['cybersecurity', 'smb'],
        'status' => 'published',
        'published_at' => '-4 days',
        'is_featured' => 0,
        'featured_image' => '/assets/images/services/solution-security.webp',
        'excerpt' => 'CCTV and access control solve different problems. Understanding the difference helps you invest in the right system first.',
        'content' => "<p>CCTV and access control are often bundled together in conversation, but they serve different purposes.</p>
<h2>CCTV: visibility after the fact</h2>
<p>Cameras record what happened. They are essential for reviewing incidents, monitoring shared spaces, and deterring opportunistic issues — but on their own, they do not stop anyone from entering.</p>
<h2>Access control: restricting entry in real time</h2>
<p>Access control — card readers, PIN pads or biometric systems — physically restricts who can open a door in the first place. This matters most for server rooms, stock areas, or any space where entry itself needs to be limited.</p>
<h2>Most businesses eventually need both</h2>
<p>A typical setup uses access control at key entry points and CCTV across shared or higher-traffic areas, giving you both prevention and a clear record if something needs reviewing later.</p>",
        'meta_title' => 'CCTV vs Access Control: What Does Your Business Need?',
        'meta_description' => 'CCTV and access control solve different security problems. Here is how they differ and which one your business should prioritize first.',
    ],
    [
        'title' => 'Moving to Microsoft 365: What to Expect',
        'slug' => 'moving-to-microsoft-365-what-to-expect',
        'category' => 'microsoft-productivity',
        'tags' => ['it-tips', 'cloud'],
        'status' => 'published',
        'published_at' => '-2 days',
        'is_featured' => 1,
        'featured_image' => '/assets/images/services/solution-itsupport.webp',
        'excerpt' => 'Migrating email and files to Microsoft 365 is more predictable than most teams expect — as long as the migration is planned properly.',
        'content' => "<p>Migrating to Microsoft 365 is one of the more common IT projects for growing businesses, and most of the disruption people worry about is avoidable with the right planning.</p>
<h2>What actually moves</h2>
<p>A typical migration covers email (moving to Exchange Online), file storage (to OneDrive and SharePoint), and setting up the productivity apps your team already knows, like Word and Excel.</p>
<h2>Planning the cutover</h2>
<p>The best migrations are scheduled outside business hours, with mail flow tested before anyone's inbox is fully switched over.</p>
<h2>Licensing matters more than people expect</h2>
<p>Microsoft 365 has several license tiers, and picking the wrong one either overpays for features you will not use or leaves out something your team needs. Getting this right up front avoids a second round of changes later.</p>",
        'meta_title' => 'Moving to Microsoft 365: What to Expect',
        'meta_description' => 'What actually happens when a business migrates to Microsoft 365 — email, file storage, licensing and how to plan the cutover.',
    ],
    [
        'title' => 'A Simple Guide to Structured Cabling for New Offices',
        'slug' => 'a-simple-guide-to-structured-cabling-for-new-offices',
        'category' => 'networking',
        'tags' => ['office-setup', 'it-tips'],
        'status' => 'draft',
        'published_at' => null,
        'is_featured' => 0,
        'featured_image' => '/assets/images/portfolio/portfolio-network-2.webp',
        'excerpt' => 'Planning cabling before a fit-out saves time, money and a lot of visible mess later. Here is what to think about early.',
        'content' => "<p>This article is still being drafted.</p><p>Topics to cover: cable types, containment planning, patch panel placement, and coordinating with electricians during a fit-out.</p>",
        'meta_title' => null,
        'meta_description' => null,
    ],
    [
        'title' => 'The Real Cost of Downtime for Small Businesses',
        'slug' => 'the-real-cost-of-downtime-for-small-businesses',
        'category' => 'business-tips',
        'tags' => ['smb', 'it-tips'],
        'status' => 'scheduled',
        'published_at' => '+5 days',
        'is_featured' => 0,
        'featured_image' => '/assets/images/services/solution-telecom.webp',
        'excerpt' => 'An hour of downtime rarely costs just an hour. Here is what actually adds up when systems go down.',
        'content' => "<p>When systems go down, the visible cost is obvious: work stops. The less visible costs are usually bigger.</p>
<h2>Lost productivity compounds</h2>
<p>Staff sitting idle during an outage is only part of it — getting back up to speed afterward, re-doing lost work, and clearing the backlog all add hidden hours.</p>
<h2>Customer-facing downtime has a longer tail</h2>
<p>If phones, email or a customer-facing system are affected, the impact does not end when systems come back — missed messages and delayed responses still need to be worked through.</p>
<h2>Prevention is usually cheaper than recovery</h2>
<p>Most downtime causes — aging hardware, unpatched systems, single points of failure — are identifiable well before they cause an outage.</p>",
        'meta_title' => 'The Real Cost of Downtime for Small Businesses',
        'meta_description' => 'Downtime costs more than the hours systems are offline. Here is what actually adds up and how to reduce the risk.',
    ],
];

$postStmt = $pdo->prepare(
    'INSERT INTO posts (title, slug, excerpt, content, featured_image, author_id, category_id, status, is_featured, published_at, meta_title, meta_description)
     VALUES (:title, :slug, :excerpt, :content, :featured_image, :author_id, :category_id, :status, :is_featured, :published_at, :meta_title, :meta_description)
     ON DUPLICATE KEY UPDATE title = VALUES(title), content = VALUES(content), status = VALUES(status)'
);

foreach ($posts as $post) {
    $publishedAt = $post['published_at'] ? date('Y-m-d H:i:s', strtotime($post['published_at'])) : null;

    $postStmt->execute([
        'title' => $post['title'],
        'slug' => $post['slug'],
        'excerpt' => $post['excerpt'],
        'content' => $post['content'],
        'featured_image' => $post['featured_image'],
        'author_id' => $adminId,
        'category_id' => $categoryIds[$post['category']],
        'status' => $post['status'],
        'is_featured' => $post['is_featured'],
        'published_at' => $publishedAt,
        'meta_title' => $post['meta_title'],
        'meta_description' => $post['meta_description'],
    ]);

    $idStmt = $pdo->prepare('SELECT id FROM posts WHERE slug = :slug');
    $idStmt->execute(['slug' => $post['slug']]);
    $postId = (int) $idStmt->fetchColumn();

    $pdo->prepare('DELETE FROM post_tags WHERE post_id = :id')->execute(['id' => $postId]);
    $tagInsert = $pdo->prepare('INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)');
    foreach ($post['tags'] as $tagSlug) {
        $tagInsert->execute(['post_id' => $postId, 'tag_id' => $tagIds[$tagSlug]]);
    }
}
echo 'Blog posts seeded (' . count($posts) . ").\n";
