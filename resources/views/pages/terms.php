<?php

use App\Core\View;
use App\Helpers\SiteConfig;

$siteEmail = $siteEmail ?? 'info@bmcs.ae';

// Editable in Admin > Page Content > Legal Pages.
$defaultContent = <<<HTML
            <p>These terms and conditions govern your use of the Bright Mind Computer Solutions ("BMCS", "we", "us") website. By using this website, you agree to these terms.</p>

            <h2>Use of This Website</h2>
            <p>This website is provided for general information about BMCS and its services. You agree to use it only for lawful purposes and not to attempt to disrupt or compromise its security or functionality.</p>

            <h2>Information Accuracy</h2>
            <p>We aim to keep the information on this website accurate and up to date, but we make no warranty that all content is complete, current or error-free. Service descriptions are general in nature; specific project scope, pricing and timelines are confirmed separately with each client.</p>

            <h2>Intellectual Property</h2>
            <p>The content, design and branding of this website are the property of BMCS unless otherwise stated, and may not be reproduced without permission.</p>

            <h2>Third-Party Links</h2>
            <p>This website may contain links to third-party websites. We are not responsible for the content or practices of any linked third-party site.</p>

            <h2>Limitation of Liability</h2>
            <p>BMCS shall not be liable for any indirect, incidental or consequential damages arising from your use of this website, to the fullest extent permitted by law.</p>

            <h2>Governing Law</h2>
            <p>These terms are governed by the laws of the United Arab Emirates.</p>

            <h2>Changes to These Terms</h2>
            <p>We may update these terms from time to time. Continued use of the website after changes are posted constitutes acceptance of the revised terms.</p>
HTML;
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Terms & Conditions', 'href' => null]],
]) ?>

<section class="section-py bg-white">
    <div class="container-custom max-w-3xl">
        <h1 class="text-3xl md:text-4xl font-semibold text-navy-950">Terms &amp; Conditions</h1>
        <p class="mt-3 text-sm text-ink-500">Last updated: <?= date('F Y') ?></p>

        <div class="mt-10 prose-blog max-w-none">
            <?= SiteConfig::get('terms_content') ?: $defaultContent ?>

            <h2>Contact Us</h2>
            <p>Questions about these Terms &amp; Conditions can be sent to <a href="mailto:<?= View::e($siteEmail) ?>"><?= View::e($siteEmail) ?></a>.</p>
        </div>
    </div>
</section>
