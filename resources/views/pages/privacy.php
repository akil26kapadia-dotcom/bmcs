<?php

use App\Core\View;
use App\Helpers\SiteConfig;

$siteEmail = $siteEmail ?? 'info@bmcs.ae';

// Editable in Admin > Page Content > Legal Pages. Falls back to this
// default (trusted, admin-authored HTML — same trust model as blog posts).
$defaultContent = <<<HTML
            <p>Bright Mind Computer Solutions ("BMCS", "we", "us") respects your privacy. This policy explains what information we collect through this website, how we use it, and the choices you have.</p>

            <h2>Information We Collect</h2>
            <p>When you submit our contact form, we collect the details you provide — such as your name, email address, phone number, company and message. We do not require you to create an account or provide payment information through this website.</p>

            <h2>How We Use Your Information</h2>
            <ul>
                <li>To respond to enquiries submitted through our contact form.</li>
                <li>To provide information about our services when requested.</li>
                <li>To improve this website and the services we offer.</li>
            </ul>
            <p>We do not sell or rent your personal information to third parties.</p>

            <h2>Cookies</h2>
            <p>This website may use strictly necessary cookies (such as session cookies) required for core functionality. If analytics tools are enabled, they may use cookies to help us understand how visitors use the site.</p>

            <h2>Data Security</h2>
            <p>We take reasonable technical and organizational measures to protect the information you share with us. However, no method of transmission over the internet is completely secure, and we cannot guarantee absolute security.</p>

            <h2>Third-Party Services</h2>
            <p>This website may link to third-party websites or use third-party services (for example, analytics providers). We are not responsible for the privacy practices of those third parties.</p>

            <h2>Your Rights</h2>
            <p>You may contact us at any time to ask what information we hold about you, to request a correction, or to request deletion of your information, subject to any legal or legitimate business requirements to retain it.</p>

            <h2>Changes to This Policy</h2>
            <p>We may update this policy from time to time. Changes will be posted on this page with an updated revision date.</p>
HTML;
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Privacy Policy', 'href' => null]],
]) ?>

<section class="section-py bg-white">
    <div class="container-custom max-w-3xl">
        <h1 class="text-3xl md:text-4xl font-semibold text-navy-950">Privacy Policy</h1>
        <p class="mt-3 text-sm text-ink-500">Last updated: <?= date('F Y') ?></p>

        <div class="mt-10 prose-blog max-w-none">
            <?= SiteConfig::get('privacy_content') ?: $defaultContent ?>

            <h2>Contact Us</h2>
            <p>If you have questions about this Privacy Policy, please contact us at <a href="mailto:<?= View::e($siteEmail) ?>"><?= View::e($siteEmail) ?></a>.</p>
        </div>
    </div>
</section>
