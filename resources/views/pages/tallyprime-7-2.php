<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\SEO;
use App\Helpers\SiteConfig;

$whatsapp = SiteConfig::get('whatsapp_number');
$waMessage = 'Hello BMCS, I would like to know more about upgrading to TallyPrime 7.2.';

$faqs = [
    [
        'q' => 'What is new in TallyPrime 7.2?',
        'a' => 'The UAE release includes enhancements for e-Invoicing registration, invoice exchange, transaction review, status tracking, advance receipt VAT details and master data configuration.',
    ],
    [
        'q' => 'Can Corporate Tax-only companies register for UAE e-Invoicing?',
        'a' => 'Yes. TallyPrime 7.2 supports e-Invoicing registration for companies registered only for Corporate Tax. However, e-Invoice generation for companies not registered for VAT is identified by Tally as a capability planned for a future release.',
    ],
    [
        'q' => 'Can I exchange multiple e-Invoices together?',
        'a' => 'Yes. TallyPrime supports individual and bulk e-Invoice exchange for eligible configured transactions.',
    ],
    [
        'q' => 'Do I need to back up my Tally data before upgrading?',
        'a' => 'We recommend taking and verifying a complete backup before upgrading, especially where customized modules or integrations are installed.',
    ],
    [
        'q' => 'Can Bright Mind assist with TallyPrime 7.2 upgrades in Dubai?',
        'a' => 'Yes. Bright Mind Computer Solutions LLC provides TallyPrime upgrade, configuration, customization and support services for businesses in Dubai and across the UAE.',
    ],
];

$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(fn ($f) => [
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $faqs),
];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'TallyPrime 7.2', 'href' => null]],
]) ?>

<?= View::capture('components/page-hero', [
    'eyebrow' => 'Product Update — Released 12 October 2026',
    'title' => 'TallyPrime 7.2 UAE: New e-Invoicing Features, Upgrade & Support in Dubai',
    'subtitle' => "TallyPrime 7.2 brings new UAE e-Invoicing registration, bulk exchange, status tracking and VAT details. Here's what's new — and how Bright Mind can help you upgrade.",
    'cta' => Html::button(['href' => '/contact', 'label' => 'Talk to Our Tally Team', 'variant' => 'primary', 'icon' => true])
        . Html::whatsappButton('WhatsApp Us', $waMessage),
]) ?>

<section class="section-py bg-white">
    <div class="container-custom grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 prose-blog max-w-none">

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
            <?php foreach ($faqs as $faq): ?>
                <h3><?= View::e($faq['q']) ?></h3>
                <p><?= View::e($faq['a']) ?></p>
            <?php endforeach; ?>

            <p class="mt-8 text-sm text-ink-500"><strong>Official reference:</strong> <a href="https://help.tallysolutions.com/uae-release-notes/" target="_blank" rel="noopener">help.tallysolutions.com/uae-release-notes</a></p>
        </div>

        <aside class="lg:col-span-1">
            <div class="card spotlight p-6 bg-navy-950 border-none sticky top-24">
                <h3 class="font-semibold text-white">Planning Your TallyPrime Upgrade?</h3>
                <p class="mt-2 text-sm text-white/80">Contact Bright Mind Computer Solutions LLC to discuss your current TallyPrime setup and technical requirements.</p>
                <div class="mt-4 space-y-3">
                    <?= Html::button(['href' => '/contact', 'label' => 'Request a Quotation', 'variant' => 'primary', 'icon' => true, 'class' => 'w-full']) ?>
                    <?php if ($whatsapp): ?>
                        <?= Html::whatsappButton('WhatsApp Us', $waMessage, 'outline-light', 'w-full') ?>
                    <?php endif; ?>
                    <?= Html::callButton('Call BMCS', 'outline-light', 'w-full') ?>
                </div>
                <p class="mt-5 pt-5 border-t border-white/10 text-xs text-white/60"><em>Empowering Business with Smart IT Solutions.</em></p>
            </div>
        </aside>
    </div>
</section>

<!-- CTA -->
<section class="cta-section relative isolate overflow-hidden text-white" data-spot>
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <span class="cta-spot" aria-hidden="true"></span>
    <div class="relative container-custom py-16 text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-white">Ready to Upgrade to TallyPrime 7.2?</h2>
        <div class="cta-btns mt-6 flex flex-wrap items-center justify-center gap-4">
            <?= Html::button(['href' => '/contact', 'label' => 'Book a Consultation', 'variant' => 'primary', 'icon' => true]) ?>
            <?= Html::whatsappButton('WhatsApp Us', $waMessage) ?>
        </div>
    </div>
</section>

<?= SEO::schema($schema) ?>
