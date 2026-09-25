<?php

use App\Helpers\SiteConfig;
use App\Core\View;
use App\Models\MenuItem;
use App\Models\Service;
use App\Models\ServiceCategory;

$phone = SiteConfig::get('site_phone');
$email = SiteConfig::get('site_email');
$whatsapp = SiteConfig::get('whatsapp_number');
$footerText = SiteConfig::get('footer_text');
$address = SiteConfig::get('site_address');
$city = SiteConfig::get('site_city', 'Dubai');
$socialLinks = array_filter([
    'facebook' => SiteConfig::get('facebook_url'),
    'instagram' => SiteConfig::get('instagram_url'),
    'linkedin' => SiteConfig::get('linkedin_url'),
    'twitter' => SiteConfig::get('twitter_url'),
]);

// Pulled live from the database (Admin > Categories/Services) — see navbar.php.
try {
    $serviceLinks = array_values(array_filter(
        ServiceCategory::allOrdered(),
        fn ($c) => $c['slug'] !== 'tally-solutions'
    ));
} catch (\Throwable $e) {
    $serviceLinks = [];
}
try {
    $tallyLinks = Service::byCategorySlug('tally-solutions');
} catch (\Throwable $e) {
    $tallyLinks = [];
}

// Managed in Admin > Menus.
try {
    $quickLinks = MenuItem::forLocation('footer');
} catch (\Throwable $e) {
    $quickLinks = [];
}
?>
<footer class="relative bg-navy-950 text-white/80 overflow-hidden">
    <div class="absolute top-0 inset-x-0 h-px bg-gradient-to-r from-transparent via-gold-500/70 to-transparent" aria-hidden="true"></div>
    <div class="absolute inset-0 hero-grid opacity-20 pointer-events-none" aria-hidden="true"></div>
    <div class="section-blob w-96 h-96 -top-40 -left-20" aria-hidden="true"></div>
    <div class="section-blob w-96 h-96 -bottom-48 -right-24" aria-hidden="true"></div>

    <div class="relative z-10 container-custom section-py !py-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-3">
            <a href="/" class="flex items-center gap-3">
                <img src="<?= View::e(\App\Helpers\SiteConfig::get('site_logo', '/assets/images/logo-mark.png')) ?>" alt="Bright Mind Computer Solutions logo" width="38" height="48" class="h-12 w-auto logo-glow">
                <span class="leading-tight">
                    <span class="block text-base font-bold text-white tracking-tight">BRIGHT MIND</span>
                    <span class="block text-[11px] font-medium text-white/80 tracking-wide uppercase">Computer Solutions</span>
                </span>
            </a>
            <p class="mt-5 text-sm leading-relaxed max-w-sm">
                <?= View::e($footerText) ?> Bright Mind Computer Solutions LLC provides TallyPrime solutions
                and complete IT services &mdash; networking, servers, security, cloud and support &mdash; for businesses across Dubai and the UAE.
            </p>
            <p class="mt-4 text-sm text-white/80"><?= View::e($address ?: $city . ', United Arab Emirates') ?></p>
            <?php if (!empty($socialLinks)): ?>
                <div class="mt-5 flex items-center gap-3">
                    <?php foreach ($socialLinks as $network => $url): ?>
                        <a href="<?= View::e($url) ?>" target="_blank" rel="noopener" aria-label="BMCS on <?= View::e(ucfirst($network)) ?>"
                           class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-white/10 text-white/80 hover:bg-gold-500 hover:text-navy-950 transition-colors">
                            <?= \App\Helpers\Icon::svg($network, 'w-4 h-4') ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="lg:col-span-3">
            <h3 class="text-sm font-semibold text-white uppercase tracking-wide"><a href="/solutions/tally-solutions" class="hover:text-gold-400">Tally Solutions</a></h3>
            <ul class="mt-5 space-y-3 text-sm">
                <?php foreach ($tallyLinks as $link): ?>
                    <li><a href="/services/<?= View::e($link['slug']) ?>" class="hover:text-gold-400"><?= View::e($link['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="lg:col-span-2">
            <h3 class="text-sm font-semibold text-white uppercase tracking-wide">IT Services</h3>
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

        <div class="lg:col-span-2">
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
        <div class="container-custom py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/80">
            <p>&copy; <?= date('Y') ?> Bright Mind Computer Solutions. All rights reserved.</p>
            <div class="flex items-center gap-6">
                <a href="/privacy-policy" class="hover:text-gold-400">Privacy Policy</a>
                <a href="/terms-and-conditions" class="hover:text-gold-400">Terms &amp; Conditions</a>
                <a href="/sitemap" class="hover:text-gold-400">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
