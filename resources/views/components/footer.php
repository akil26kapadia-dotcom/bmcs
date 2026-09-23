<?php

use App\Helpers\SiteConfig;
use App\Core\View;

$phone = SiteConfig::get('site_phone');
$email = SiteConfig::get('site_email');
$whatsapp = SiteConfig::get('whatsapp_number');
$footerText = SiteConfig::get('footer_text');

$serviceLinks = [
    ['name' => 'Network & Infrastructure', 'slug' => 'network-infrastructure'],
    ['name' => 'Cloud & Data', 'slug' => 'cloud-data'],
    ['name' => 'Security & Surveillance', 'slug' => 'security-surveillance'],
    ['name' => 'Telecommunication', 'slug' => 'telecommunication'],
    ['name' => 'Microsoft & Business Solutions', 'slug' => 'microsoft-business-solutions'],
    ['name' => 'Web & Digital', 'slug' => 'web-digital'],
];

$quickLinks = [
    ['label' => 'About Us', 'href' => '/about'],
    ['label' => 'Services', 'href' => '/services'],
    ['label' => 'Portfolio', 'href' => '/portfolio'],
    ['label' => 'Blog', 'href' => '/blog'],
    ['label' => 'Products', 'href' => '/products'],
    ['label' => 'Contact', 'href' => '/contact'],
];
?>
<footer class="relative bg-navy-950 text-white/70 overflow-hidden">
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-gold-500/70 to-transparent" aria-hidden="true"></div>
    <div class="absolute inset-0 hero-grid opacity-20 pointer-events-none" aria-hidden="true"></div>
    <div class="section-blob w-96 h-96 -top-40 -left-20" aria-hidden="true"></div>
    <div class="section-blob w-96 h-96 -bottom-48 -right-24" aria-hidden="true"></div>

    <div class="relative z-10 container-custom section-py !py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-4">
            <a href="/" class="flex items-center gap-3">
                <img src="/assets/images/logo-mark.png" alt="Bright Mind Computer Solutions logo" width="38" height="48" class="h-12 w-auto logo-glow">
                <span class="leading-tight">
                    <span class="block text-base font-bold text-white tracking-tight">BRIGHT MIND</span>
                    <span class="block text-[11px] font-medium text-white/50 tracking-wide uppercase">Computer Solutions</span>
                </span>
            </a>
            <p class="mt-5 text-sm leading-relaxed max-w-sm">
                <?= View::e($footerText) ?> BMCS delivers enterprise IT infrastructure, networking,
                security, cloud and digital solutions for businesses across Dubai and the UAE.
            </p>
            <p class="mt-4 text-sm text-white/50">Dubai, United Arab Emirates</p>
        </div>

        <div class="lg:col-span-3">
            <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Services</h3>
            <ul class="mt-5 space-y-3 text-sm">
                <?php foreach ($serviceLinks as $link): ?>
                    <li><a href="/solutions/<?= View::e($link['slug']) ?>" class="hover:text-gold-400"><?= View::e($link['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="lg:col-span-2">
            <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Quick Links</h3>
            <ul class="mt-5 space-y-3 text-sm">
                <?php foreach ($quickLinks as $link): ?>
                    <li><a href="<?= View::e($link['href']) ?>" class="hover:text-gold-400"><?= View::e($link['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="lg:col-span-3">
            <h3 class="text-sm font-semibold text-white uppercase tracking-wide">Contact</h3>
            <ul class="mt-5 space-y-3 text-sm">
                <li><a href="tel:<?= View::e(preg_replace('/\s+/', '', $phone)) ?>" class="hover:text-gold-400"><?= View::e($phone) ?></a></li>
                <li><a href="mailto:<?= View::e($email) ?>" class="hover:text-gold-400"><?= View::e($email) ?></a></li>
                <?php if ($whatsapp): ?>
                    <li><a href="https://wa.me/<?= View::e(preg_replace('/[^0-9]/', '', $whatsapp)) ?>" target="_blank" rel="noopener" class="hover:text-gold-400">WhatsApp: <?= View::e($whatsapp) ?></a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="relative z-10 border-t border-white/10">
        <div class="container-custom py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/50">
            <p>&copy; <?= date('Y') ?> Bright Mind Computer Solutions. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="/privacy-policy" class="hover:text-gold-400">Privacy Policy</a>
                <a href="/terms-and-conditions" class="hover:text-gold-400">Terms &amp; Conditions</a>
                <a href="/sitemap" class="hover:text-gold-400">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
