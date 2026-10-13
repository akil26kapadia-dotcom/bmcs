<?php

declare(strict_types=1);

use App\Core\Database;
use App\Core\Env;

require __DIR__ . '/../../vendor/autoload.php';

Env::load(__DIR__ . '/../../.env');

$pdo = Database::connection();

$adminId = (int) $pdo->query("SELECT id FROM users WHERE email = 'admin@bmcs.ae' LIMIT 1")->fetchColumn();
if ($adminId === 0) {
    $adminId = (int) $pdo->query('SELECT id FROM users ORDER BY id ASC LIMIT 1')->fetchColumn();
}

// --- Category ---------------------------------------------------------
$pdo->prepare(
    'INSERT INTO categories (name, slug) VALUES (:name, :slug) ON DUPLICATE KEY UPDATE name = VALUES(name)'
)->execute(['name' => 'TallyPrime', 'slug' => 'tallyprime']);
$categoryId = (int) $pdo->query("SELECT id FROM categories WHERE slug = 'tallyprime'")->fetchColumn();

// --- Tags ---------------------------------------------------------------
$tags = [
    ['name' => 'TallyPrime', 'slug' => 'tallyprime'],
    ['name' => 'e-Invoicing', 'slug' => 'e-invoicing'],
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

// --- Post -----------------------------------------------------------------
$content = <<<'HTML'
<p><strong>Bright Mind Computer Solutions LLC | Your TallyPrime Solutions Partner in UAE</strong></p>

<h2>Introducing TallyPrime Release 7.2</h2>
<p>TallyPrime 7.2, released on 12 October 2026, brings important enhancements to UAE e-Invoicing, transaction management, VAT reporting details and business workflows.</p>
<p>At Bright Mind Computer Solutions LLC, we help businesses across Dubai and the UAE upgrade, configure and prepare their TallyPrime systems for evolving business and regulatory requirements.</p>
<p>Whether you are using TallyPrime Silver, Gold or a customized TallyPrime environment, our team can assist with installation, migration, configuration and technical support.</p>

<h2>What's New in TallyPrime 7.2 for UAE?</h2>

<h3>1. e-Invoicing Registration for Corporate Tax Companies</h3>
<p>TallyPrime 7.2 supports e-Invoicing registration for businesses registered only for UAE Corporate Tax. This enhancement expands registration support for companies that are not VAT-registered.</p>

<h3>2. Individual and Bulk e-Invoice Exchange</h3>
<p>Businesses can exchange e-Invoices with the e-Invoice System directly through TallyPrime, individually or in batches. This provides greater flexibility when processing different transaction volumes.</p>

<h3>3. Review Transactions Before e-Invoicing</h3>
<p>The <strong>Send for e-Invoicing</strong> report allows users to review pending transactions, identify missing information and correct errors before exchanging e-Invoices.</p>

<h3>4. Improved e-Invoice Status Tracking</h3>
<p>Monitor the progress of e-Invoices using additional status categories:</p>
<ul>
<li>e-Invoice Generation in Progress</li>
<li>e-Invoice Generated</li>
<li>Voucher Information Modified after Exchange</li>
<li>Rejected by e-Invoice System</li>
</ul>
<p>These categories help accounting teams identify transactions requiring follow-up.</p>

<h3>5. Enhanced Advance Receipt VAT Details</h3>
<p>TallyPrime 7.2 provides additional VAT information fields for advance receipts, including:</p>
<ul>
<li>Nature of Transaction</li>
<li>VAT Rate</li>
<li>Taxable Amount</li>
<li>VAT Amount</li>
<li>Reason for Exempt</li>
</ul>
<p>Users can also record multiple line entries in an advance receipt.</p>

<h3>6. Additional Information in Masters and Transactions</h3>
<p>Businesses can maintain agency identification details and record reasons for allowances on applicable non-vatable stock items. These enhancements support more complete transaction information for UAE e-Invoicing.</p>

<h2>UAE e-Invoicing Readiness with Bright Mind</h2>
<p>Preparing for e-Invoicing involves more than upgrading your software. Bright Mind Computer Solutions LLC can assist your business with:</p>
<ul>
<li>TallyPrime 7.2 installation and upgrades</li>
<li>TSS subscription renewal assistance</li>
<li>Company and statutory configuration</li>
<li>Customer and supplier master data review</li>
<li>VAT and e-Invoicing configuration</li>
<li>Invoice and voucher setup</li>
<li>Transaction validation and testing</li>
<li>TallyPrime customization and integration review</li>
<li>User training and technical support</li>
</ul>
<p>Our goal is to help businesses transition smoothly while minimizing disruption to their existing accounting operations.</p>

<h2>Why Choose Bright Mind Computer Solutions LLC?</h2>
<p>We provide TallyPrime software and technical services to businesses throughout Dubai and the UAE.</p>
<p>Our solutions include TallyPrime sales, upgrades, annual subscription renewals, cloud hosting, customization, integration and ongoing technical support.</p>
<p>We focus on understanding your existing accounting setup before recommending changes.</p>

<h2>Frequently Asked Questions</h2>

<h3>What is new in TallyPrime 7.2?</h3>
<p>The UAE release includes enhancements for e-Invoicing registration, invoice exchange, transaction review, status tracking, advance receipt VAT details and master data configuration.</p>

<h3>Can Corporate Tax-only companies register for UAE e-Invoicing?</h3>
<p>Yes. TallyPrime 7.2 supports e-Invoicing registration for companies registered only for Corporate Tax. However, e-Invoice generation for companies not registered for VAT is identified by Tally as a capability planned for a future release.</p>

<h3>Can I exchange multiple e-Invoices together?</h3>
<p>Yes. TallyPrime supports individual and bulk e-Invoice exchange for eligible configured transactions.</p>

<h3>Do I need to back up my Tally data before upgrading?</h3>
<p>We recommend taking and verifying a complete backup before upgrading, especially where customized modules or integrations are installed.</p>

<h3>Can Bright Mind assist with TallyPrime 7.2 upgrades in Dubai?</h3>
<p>Yes. Bright Mind Computer Solutions LLC provides TallyPrime upgrade, configuration, customization and support services for businesses in Dubai and across the UAE.</p>

<h2>Upgrade to TallyPrime 7.2 with Bright Mind</h2>
<p><strong>Planning your TallyPrime upgrade or preparing for UAE e-Invoicing?</strong></p>
<p>Contact Bright Mind Computer Solutions LLC to discuss your current TallyPrime setup and technical requirements.</p>
<p>
<strong>Call / WhatsApp:</strong> +971 50 840 2607<br>
<strong>Email:</strong> info@bmcs.ae<br>
<strong>Website:</strong> www.bmcs.ae
</p>
<p><em>Empowering Business with Smart IT Solutions.</em></p>
<p><strong>Official reference:</strong> <a href="https://help.tallysolutions.com/uae-release-notes/" target="_blank" rel="noopener">help.tallysolutions.com/uae-release-notes</a></p>
HTML;

$postStmt = $pdo->prepare(
    'INSERT INTO posts (title, slug, excerpt, content, featured_image, author_id, category_id, status, is_featured, published_at, meta_title, meta_description)
     VALUES (:title, :slug, :excerpt, :content, :featured_image, :author_id, :category_id, :status, :is_featured, :published_at, :meta_title, :meta_description)
     ON DUPLICATE KEY UPDATE title = VALUES(title), content = VALUES(content), status = VALUES(status), excerpt = VALUES(excerpt), meta_title = VALUES(meta_title), meta_description = VALUES(meta_description)'
);

$postStmt->execute([
    'title' => 'TallyPrime 7.2 UAE – New e-Invoicing Features, Upgrade & Support in Dubai',
    'slug' => 'tallyprime-7-2-uae-e-invoicing-upgrade-support',
    'excerpt' => "TallyPrime 7.2 brings new UAE e-Invoicing registration, bulk exchange, status tracking and VAT details. Here's what's new — and how Bright Mind can help you upgrade.",
    'content' => $content,
    'featured_image' => '/assets/images/services/solution-itsupport.webp',
    'author_id' => $adminId,
    'category_id' => $categoryId,
    'status' => 'published',
    'is_featured' => 1,
    'published_at' => '2026-10-12 10:00:00',
    'meta_title' => 'TallyPrime 7.2 UAE – e-Invoicing Features, Upgrade & Support | BMCS',
    'meta_description' => 'TallyPrime 7.2 adds UAE e-Invoicing registration for Corporate Tax companies, bulk exchange, status tracking and VAT details. Bright Mind helps you upgrade in Dubai.',
]);

$idStmt = $pdo->prepare('SELECT id FROM posts WHERE slug = :slug');
$idStmt->execute(['slug' => 'tallyprime-7-2-uae-e-invoicing-upgrade-support']);
$postId = (int) $idStmt->fetchColumn();

$pdo->prepare('DELETE FROM post_tags WHERE post_id = :id')->execute(['id' => $postId]);
$tagInsert = $pdo->prepare('INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)');
foreach ($tagIds as $tagId) {
    $tagInsert->execute(['post_id' => $postId, 'tag_id' => $tagId]);
}

echo "Post created/updated: id={$postId}, slug=tallyprime-7-2-uae-e-invoicing-upgrade-support\n";
echo "URL: /blog/tallyprime-7-2-uae-e-invoicing-upgrade-support\n";
