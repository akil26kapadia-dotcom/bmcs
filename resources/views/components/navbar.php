<?php

use App\Helpers\Html;
use App\Helpers\SiteConfig;
use App\Core\View;

$currentPath = $currentPath ?? '';

$navItems = [
    ['label' => 'Home', 'href' => '/'],
    ['label' => 'Tally Solutions', 'href' => '/solutions/tally-solutions'],
    ['label' => 'About', 'href' => '/about'],
    ['label' => 'Services', 'href' => '/services', 'dropdown' => 'services-menu'],
    ['label' => 'Solutions', 'href' => '/solutions'],
    ['label' => 'Products', 'href' => '/products'],
    ['label' => 'Portfolio', 'href' => '/portfolio'],
    ['label' => 'Blog', 'href' => '/blog'],
    ['label' => 'Contact', 'href' => '/contact'],
];

$serviceCategories = [
    ['name' => 'Network & Infrastructure', 'slug' => 'network-infrastructure'],
    ['name' => 'Cloud & Data', 'slug' => 'cloud-data'],
    ['name' => 'Security & Surveillance', 'slug' => 'security-surveillance'],
    ['name' => 'Telecommunication', 'slug' => 'telecommunication'],
    ['name' => 'Microsoft & Business Solutions', 'slug' => 'microsoft-business-solutions'],
    ['name' => 'IT Support & Distribution', 'slug' => 'it-support-distribution'],
    ['name' => 'Web & Digital', 'slug' => 'web-digital'],
    ['name' => 'Audio Visual', 'slug' => 'audio-visual'],
];

$isActive = function (string $href) use ($currentPath): bool {
    $target = trim($href, '/');
    if ($target === '') {
        return $currentPath === '';
    }
    return $currentPath === $target || str_starts_with($currentPath, $target . '/');
};

$phone = SiteConfig::get('site_phone');
$email = SiteConfig::get('site_email');
$whatsapp = SiteConfig::get('whatsapp_number');
?>
<!-- Top announcement bar -->
<div class="hidden md:block bg-navy-950 text-white/80 text-sm">
    <div class="container-custom flex items-center justify-between py-2.5">
        <div class="flex items-center gap-6">
            <a href="tel:<?= View::e(preg_replace('/\s+/', '', $phone)) ?>" class="flex items-center gap-2 hover:text-gold-400">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M3.5 3A1.5 1.5 0 002 4.5v.5c0 7.732 6.268 14 14 14h.5a1.5 1.5 0 001.5-1.5v-2.086a1.5 1.5 0 00-1.048-1.43l-3.176-1.058a1.5 1.5 0 00-1.638.44l-.72.84a11.04 11.04 0 01-5.124-5.124l.84-.72a1.5 1.5 0 00.44-1.638L6.516 3.048A1.5 1.5 0 005.086 2H3.5z"/></svg>
                <?= View::e($phone) ?>
            </a>
            <a href="mailto:<?= View::e($email) ?>" class="flex items-center gap-2 hover:text-gold-400">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M2.94 4.94A2 2 0 014.5 4h11a2 2 0 011.56.94L10 10.06 2.94 4.94zM2 6.34V14a2 2 0 002 2h12a2 2 0 002-2V6.34l-7.4 5.28a1 1 0 01-1.2 0L2 6.34z"/></svg>
                <?= View::e($email) ?>
            </a>
            <?php if ($whatsapp): ?>
                <a href="https://wa.me/<?= View::e(preg_replace('/[^0-9]/', '', $whatsapp)) ?>" target="_blank" rel="noopener" class="flex items-center gap-2 hover:text-gold-400">
                    <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 2a8 8 0 00-6.9 12.02L2 18l4.1-1.07A8 8 0 1010 2zm0 14.4a6.4 6.4 0 01-3.26-.9l-.23-.14-2.43.64.65-2.37-.15-.24A6.4 6.4 0 1116.4 10 6.41 6.41 0 0110 16.4z"/></svg>
                    <?= View::e($whatsapp) ?>
                </a>
            <?php endif; ?>
        </div>
        <a href="/contact" class="text-gold-400 hover:text-gold-300 font-medium">Request a Quotation &rarr;</a>
    </div>
</div>

<header data-site-header class="site-header">
    <div class="container-custom">
        <div class="nav-inner flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 shrink-0">
                <img src="/assets/images/logo-mark.png" alt="Bright Mind Computer Solutions logo" width="38" height="48" class="h-12 w-auto logo-glow">
                <span class="leading-tight">
                    <span class="block text-base font-bold text-navy-950 tracking-tight">BRIGHT MIND</span>
                    <span class="block text-[11px] font-medium text-ink-500 tracking-wide uppercase">Computer Solutions</span>
                </span>
            </a>

            <nav class="hidden lg:flex items-center gap-1" aria-label="Primary">
                <?php foreach ($navItems as $item): ?>
                    <?php if (!empty($item['dropdown'])): ?>
                        <div class="relative">
                            <button type="button"
                                    data-dropdown-toggle
                                    aria-expanded="false"
                                    aria-controls="<?= View::e($item['dropdown']) ?>"
                                    class="nav-link flex items-center gap-1 px-4 py-2 rounded-md text-sm font-medium transition-colors
                                           <?= $isActive($item['href']) ? 'text-navy-950 is-active' : 'text-ink-700 hover:text-navy-950' ?>">
                                <?= View::e($item['label']) ?>
                                <svg class="w-3.5 h-3.5 transition-transform duration-300 ease-premium" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd"/></svg>
                            </button>
                            <div id="<?= View::e($item['dropdown']) ?>" data-dropdown-menu
                                 class="absolute left-1/2 -translate-x-1/2 mt-2 w-[36rem] bg-white rounded-xl shadow-card-hover border border-ink-900/[0.06] p-6 grid grid-cols-2 gap-x-8 gap-y-1">
                                <?php foreach ($serviceCategories as $cat): ?>
                                    <a href="/solutions/<?= View::e($cat['slug']) ?>"
                                       class="block px-3 py-2.5 rounded-lg text-sm text-ink-700 hover:bg-navy-950/[0.04] hover:text-navy-950">
                                        <?= View::e($cat['name']) ?>
                                    </a>
                                <?php endforeach; ?>
                                <a href="/services" class="col-span-2 mt-2 pt-3 border-t border-ink-900/[0.06] px-3 text-sm font-semibold text-gold-600 hover:text-gold-500">
                                    View All Services &rarr;
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= View::e($item['href']) ?>"
                           class="nav-link px-4 py-2 rounded-md text-sm font-medium transition-colors
                                  <?= $isActive($item['href']) ? 'text-navy-950 is-active' : 'text-ink-700 hover:text-navy-950' ?>">
                            <?= View::e($item['label']) ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </nav>

            <div class="hidden lg:flex items-center gap-3">
                <div class="relative">
                    <button type="button" data-search-toggle aria-label="Search the site" aria-expanded="false" aria-controls="nav-search-panel" class="inline-flex items-center justify-center w-10 h-10 rounded-md text-ink-700 hover:bg-navy-950/5 hover:text-navy-950">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="none"><circle cx="9" cy="9" r="6.5" stroke="currentColor" stroke-width="1.5"/><path d="M18 18l-4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                    </button>
                    <div id="nav-search-panel" data-search-panel class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-card-hover border border-ink-900/[0.06] p-3">
                        <form action="/search" method="GET" class="relative">
                            <label for="nav-search-input" class="sr-only">Search the site</label>
                            <input type="search" id="nav-search-input" name="q" data-search-input placeholder="Search services, portfolio, articles&hellip;"
                                   class="w-full rounded-lg border border-ink-300 pl-9 pr-3 py-2.5 text-sm text-navy-950 focus:outline-none focus:ring-2 focus:ring-gold-500 focus:border-transparent">
                            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-ink-500" viewBox="0 0 20 20" fill="none"><circle cx="9" cy="9" r="6.5" stroke="currentColor" stroke-width="1.5"/><path d="M18 18l-4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                        </form>
                    </div>
                </div>
                <?= Html::button(['href' => '/contact', 'label' => 'Talk to an Expert', 'variant' => 'primary', 'icon' => true]) ?>
            </div>

            <button type="button" data-menu-toggle aria-expanded="false" aria-controls="mobile-nav-panel"
                    class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-md text-navy-950 hover:bg-navy-950/5">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>
        </div>
    </div>
</header>

<!-- Mobile slide-in menu -->
<div id="mobile-nav-panel" data-mobile-menu
     class="fixed inset-0 z-[60] lg:hidden bg-navy-950 text-white overflow-y-auto">
    <div class="container-custom py-6">
        <div class="flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <img src="/assets/images/logo-mark.png" alt="Bright Mind Computer Solutions logo" width="35" height="44" class="h-11 w-auto logo-glow">
                <span class="text-base font-bold tracking-tight">BRIGHT MIND</span>
            </a>
            <button type="button" data-menu-close class="inline-flex items-center justify-center w-10 h-10 rounded-md hover:bg-white/10">
                <span class="sr-only">Close menu</span>
                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="mt-10 flex flex-col divide-y divide-white/10" aria-label="Mobile">
            <?php foreach ($navItems as $item): ?>
                <a href="<?= View::e($item['href']) ?>" class="py-4 text-lg font-medium <?= $isActive($item['href']) ? 'text-gold-400' : 'text-white' ?>">
                    <?= View::e($item['label']) ?>
                </a>
            <?php endforeach; ?>
            <a href="/search" class="py-4 text-lg font-medium <?= $isActive('/search') ? 'text-gold-400' : 'text-white' ?>">
                Search
            </a>
        </nav>

        <div class="mt-8">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to an Expert', 'variant' => 'primary', 'icon' => true, 'class' => 'w-full']) ?>
        </div>

        <div class="mt-8 pt-6 border-t border-white/10 space-y-3 text-white/70 text-sm">
            <a href="tel:<?= View::e(preg_replace('/\s+/', '', $phone)) ?>" class="block hover:text-gold-400"><?= View::e($phone) ?></a>
            <a href="mailto:<?= View::e($email) ?>" class="block hover:text-gold-400"><?= View::e($email) ?></a>
        </div>
    </div>
</div>
