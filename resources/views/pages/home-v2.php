<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;
use App\Helpers\SiteConfig;

$serviceCategories = $serviceCategories ?? [];
$tallyServices = $tallyServices ?? [];
$allServices = $allServices ?? [];
$latestPosts = $latestPosts ?? [];
$get = fn (string $key, string $default) => SiteConfig::get($key, $default);
$icon = fn (string $name, string $class = 'w-6 h-6') => Icon::svg($name, $class);

// Highlight the first "TallyPrime" in the (admin-editable) headline.
$heading = View::e($get('home_hero_heading', 'TallyPrime Solutions & Complete IT Services in Dubai, UAE'));
$heading = preg_replace('/TallyPrime/', '<span class="text-shimmer">TallyPrime</span>', $heading, 1);

$itCategories = array_values(array_filter($serviceCategories, fn ($c) => $c['slug'] !== 'tally-solutions'));

// Labels for the glowing hub nodes in the hero network (live from the database).
$networkLabels = ['TallyPrime'];
foreach ($itCategories as $c) {
    $networkLabels[] = trim(explode(' & ', $c['name'])[0]);
}
$networkLabels = array_slice($networkLabels, 0, 6);

// Hero glass cards: the three flagship Tally services, if they exist.
$bySlug = [];
foreach ($tallyServices as $s) {
    $bySlug[$s['slug']] = $s;
}
$heroCards = [];
foreach (['tallyprime-sales', 'tally-on-cloud', 'tallyprime-server'] as $slug) {
    if (isset($bySlug[$slug])) {
        $heroCards[] = $bySlug[$slug];
    }
}
$heroCards = $heroCards ?: array_slice($tallyServices, 0, 3);

// Stats are shown only when real numbers are entered in Admin > Page Content.
$stats = [];
for ($i = 1; $i <= 4; $i++) {
    $value = trim($get("home_stat_{$i}_value", ''));
    if ($value !== '') {
        $stats[] = ['value' => $value, 'suffix' => $get("home_stat_{$i}_suffix", ''), 'label' => $get("home_stat_{$i}_label", '')];
    }
}

$steps = [
    [$get('home_step_1_title', 'Understand'), $get('home_step_1_text', 'We listen to how your business works — how many people use your systems, where the pain points are and what you want to achieve.')],
    [$get('home_step_2_title', 'Recommend'), $get('home_step_2_text', 'You get a clear written recommendation and quotation: the right edition, hardware or service for your size, not simply the biggest one.')],
    [$get('home_step_3_title', 'Implement'), $get('home_step_3_text', 'Our team installs, configures, migrates your data and trains your staff, planned to keep disruption to your business as low as possible.')],
    [$get('home_step_4_title', 'Support'), $get('home_step_4_text', 'Remote and on-site help, updates, renewals and annual maintenance, so your systems keep running long after go-live.')],
];

// TallyPrime Advisor: a short quiz that points visitors to the right page.
$serviceMap = [];
foreach ($tallyServices as $s) {
    $serviceMap[$s['slug']] = ['name' => $s['name'], 'url' => '/services/' . $s['slug']];
}
$advisor = [
    'whatsapp' => Html::whatsappUrl(),
    'services' => $serviceMap,
    'questions' => [
        ['id' => 'need', 'title' => 'What do you need right now?', 'options' => [
            ['v' => 'new', 'label' => 'A new TallyPrime licence'],
            ['v' => 'renew', 'label' => 'Renew my TSS / TallyPrime licence'],
            ['v' => 'custom', 'label' => 'Custom invoices, reports or workflows'],
            ['v' => 'migrate', 'label' => 'Move data or connect other software'],
            ['v' => 'support', 'label' => 'Help or a support contract (AMC)'],
        ]],
        ['id' => 'users', 'title' => 'How many people will use Tally?', 'showIf' => ['need' => ['new']], 'options' => [
            ['v' => '1', 'label' => 'Just one person'],
            ['v' => 'few', 'label' => '2 to 9 people'],
            ['v' => 'many', 'label' => '10 or more people'],
        ]],
        ['id' => 'remote', 'title' => 'Do you need to work remotely or from several locations?', 'showIf' => ['need' => ['new'], 'users' => ['1', 'few']], 'options' => [
            ['v' => 'yes', 'label' => 'Yes, remote or multi-location'],
            ['v' => 'no', 'label' => 'No, one office'],
        ]],
    ],
    'rules' => [
        ['when' => ['need' => 'new', 'users' => 'many'], 'service' => 'tallyprime-server', 'why' => 'With ten or more people posting at the same time, TallyPrime Server (on a Gold licence) gives better concurrency, central control and secure data access.', 'note' => 'Team size: 10 or more.'],
        ['when' => ['need' => 'new', 'remote' => 'yes'], 'service' => 'tally-on-cloud', 'why' => 'Tally on Cloud lets you and your team open the same TallyPrime data securely from any location, on your own devices.', 'note' => 'I need remote / multi-location access.'],
        ['when' => ['need' => 'new', 'users' => 'few'], 'service' => 'tallyprime-sales', 'why' => 'A multi-user (Gold) licence lets several people work in the same company at once. We confirm the right edition and quote it for you.', 'note' => 'Team size: 2 to 9.'],
        ['when' => ['need' => 'new', 'users' => '1'], 'service' => 'tallyprime-sales', 'why' => 'TallyPrime Silver is the single-user edition, ideal for one accountant or an owner-managed business. We handle activation and VAT set-up.', 'note' => 'Team size: 1.'],
        ['when' => ['need' => 'renew'], 'service' => 'tally-renewal', 'why' => 'We check your licence status, quote the renewal and complete it on time — including licences that have already lapsed.'],
        ['when' => ['need' => 'custom'], 'service' => 'tally-customization', 'why' => 'Custom invoice formats, vouchers, reports and workflows built to match exactly how your business works.'],
        ['when' => ['need' => 'migrate'], 'service' => 'tally-integration', 'why' => 'We migrate your data without losing history and connect TallyPrime to your other systems so data is entered once.'],
        ['when' => ['need' => 'support'], 'service' => 'tally-support', 'why' => 'Fast remote and on-site help, plus an annual maintenance contract with agreed response times.'],
    ],
    'fallback' => ['service' => 'tallyprime-sales', 'why' => 'Tell us what you need and we will recommend the right TallyPrime edition and set-up.'],
];

$heroVideo = $get('home_hero_video', '');
$featureImage = $get('home_tally_feature_image', '');
?>

<div class="scroll-progress" data-scroll-progress aria-hidden="true"></div>

<!-- ============================== HERO ============================== -->
<section class="relative isolate overflow-hidden text-white lg:min-h-[680px] flex items-center">
    <div class="aurora" aria-hidden="true">
        <span class="aurora-blob aurora-blob--sky"></span>
        <span class="aurora-blob aurora-blob--deep"></span>
        <span class="aurora-blob aurora-blob--yellow"></span>
        <span class="aurora-blob aurora-blob--glow"></span>
    </div>
    <?php if ($heroVideo !== ''): ?>
        <video data-hero-video data-src="<?= View::e($heroVideo) ?>" class="absolute inset-0 w-full h-full object-cover opacity-0 transition-opacity duration-1000 mix-blend-soft-light" muted loop playsinline preload="none" aria-hidden="true"></video>
    <?php endif; ?>
    <canvas data-network data-labels="<?= View::e(json_encode($networkLabels, JSON_UNESCAPED_UNICODE)) ?>" class="absolute inset-0 w-full h-full" aria-hidden="true"></canvas>

    <div class="relative container-custom w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center pt-16 pb-28 md:pt-24 md:pb-36">
        <div class="lg:col-span-7 min-w-0">
            <span class="inline-flex items-center gap-2.5 rounded-full glass px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide" data-animate="fade-up">
                <span class="pulse-dot w-2 h-2 rounded-full bg-gold-500 text-gold-500"></span>
                <?= View::e($get('home_hero_eyebrow', 'Bright Mind Computer Solutions LLC')) ?>
            </span>
            <h1 class="mt-6 text-4xl sm:text-5xl lg:text-[3.5rem] xl:text-6xl font-semibold tracking-tight leading-[1.08] text-white" data-animate="fade-up" data-delay="80">
                <?= $heading ?>
            </h1>
            <p class="mt-6 text-lg text-white/85 max-w-2xl leading-relaxed" data-animate="fade-up" data-delay="160">
                <?= View::e($get('home_hero_subtext', 'TallyPrime sales, TSS renewal, Tally on Cloud, TallyPrime Server, customization and support — together with IT hardware, servers, networking, cybersecurity, CCTV and AMC for businesses across the UAE.')) ?>
            </p>
            <div class="mt-9 flex flex-wrap items-center gap-4" data-animate="fade-up" data-delay="240">
                <?= Html::button(['href' => '/contact', 'label' => 'Request a Quotation', 'variant' => 'primary', 'icon' => true, 'class' => 'glow-pulse']) ?>
                <?= Html::whatsappButton('WhatsApp Us', 'Hello BMCS, I would like to know more about TallyPrime.') ?>
                <a href="#advisor" class="inline-flex items-center gap-2 text-sm font-semibold text-white/90 hover:text-gold-400 transition-colors px-2 py-3">
                    Find the right TallyPrime
                    <?= $icon('arrow-right', 'w-4 h-4') ?>
                </a>
            </div>
            <div class="mt-8 flex flex-wrap gap-2.5" data-animate="fade-up" data-delay="320">
                <?php foreach (['Local Dubai team', 'Remote & on-site support', 'Clear written quotations'] as $chip): ?>
                    <span class="chip-glass"><span class="text-gold-400"><?= $icon('check', 'w-4 h-4') ?></span><?= View::e($chip) ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="lg:col-span-5 relative min-w-0">
            <div class="space-y-4 max-w-md lg:ml-auto">
                <?php foreach ($heroCards as $i => $card): ?>
                    <a href="/services/<?= View::e($card['slug']) ?>" data-depth="<?= 10 + $i * 7 ?>"
                       class="glass float-y delay-<?= $i ?> flex items-center gap-4 rounded-2xl p-4 pr-5 hover:bg-white/20 transition-colors group"
                       data-animate="fade-left" data-delay="<?= 200 + $i * 120 ?>">
                        <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-gold-500 text-ink-900 shrink-0">
                            <?= $icon($card['icon'] ?: 'coin', 'w-6 h-6') ?>
                        </span>
                        <span class="flex-1 min-w-0">
                            <span class="block font-semibold leading-snug"><?= View::e($card['name']) ?></span>
                            <span class="block text-sm text-white/75 truncate"><?= View::e($card['short_description'] ?? '') ?></span>
                        </span>
                        <span class="text-white/70 group-hover:text-gold-400 group-hover:translate-x-1 transition"><?= $icon('arrow-right', 'w-5 h-5') ?></span>
                    </a>
                <?php endforeach; ?>
                <a href="/services" data-depth="24" class="glass float-y flex items-center gap-4 rounded-2xl p-4 pr-5 hover:bg-white/20 transition-colors group" data-animate="fade-left" data-delay="560">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-white/20 shrink-0"><?= $icon('server', 'w-6 h-6') ?></span>
                    <span class="flex-1">
                        <span class="block font-semibold">Complete IT Services</span>
                        <span class="block text-sm text-white/75">Servers, networking, CCTV, cloud &amp; AMC</span>
                    </span>
                    <span class="text-white/70 group-hover:text-gold-400 group-hover:translate-x-1 transition"><?= $icon('arrow-right', 'w-5 h-5') ?></span>
                </a>
            </div>
        </div>
    </div>

    <svg class="hero-wave absolute bottom-0 inset-x-0 text-white" viewBox="0 0 1440 60" preserveAspectRatio="none" aria-hidden="true"><path fill="currentColor" d="M0 60V28C240 4 480 0 720 14s480 26 720 4v42z"/></svg>
</section>

<!-- ============================== KEYWORD MARQUEE ============================== -->
<?php if (!empty($allServices)): ?>
<section class="bg-white py-10 border-b border-ink-900/[0.06]" aria-label="What we do">
    <div class="marquee">
        <div class="marquee-track">
            <?php for ($loop = 0; $loop < 2; $loop++): ?>
                <?php foreach ($allServices as $s): ?>
                    <a href="/services/<?= View::e($s['slug']) ?>" class="inline-flex items-center gap-4 text-xl md:text-2xl font-semibold tracking-tight text-navy-950/85 hover:text-navy-950 whitespace-nowrap" <?= $loop ? 'tabindex="-1" aria-hidden="true"' : '' ?>>
                        <span class="w-3 h-3 rotate-45 bg-gold-500 shrink-0"></span>
                        <?= View::e($s['name']) ?>
                    </a>
                <?php endforeach; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- ============================== TALLY BENTO ============================== -->
<section class="relative section-py bg-white overflow-hidden">
    <div class="relative container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => $get('home_tally_eyebrow', 'TallyPrime Solutions'),
            'title' => $get('home_tally_heading', 'TallyPrime Dubai: Sales, Renewal, Cloud, Server and Support'),
            'subtitle' => $get('home_tally_subtitle', 'From licensing and TSS renewal to Tally on Cloud, TallyPrime Server, customization and AMC — everything you need to run TallyPrime with confidence in the UAE.'),
            'align' => 'center',
        ]) ?>

        <?php
        // Bento layout: first service is the featured tile, the rest fill the grid.
        $bento = [
            0 => 'lg:col-span-2 lg:row-span-2',
            5 => 'lg:col-span-2',
            6 => 'lg:col-span-2',
        ];
        ?>
        <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-5 auto-rows-fr">
            <?php foreach ($tallyServices as $i => $service): ?>
                <?php $featured = $i === 0; ?>
                <a href="/services/<?= View::e($service['slug']) ?>"
                   class="spotlight group rounded-3xl p-7 flex flex-col transition-all duration-300 hover:-translate-y-1 <?= $bento[$i] ?? '' ?> <?= $featured ? 'bg-navy-950 text-white shadow-premium' : 'bg-white border border-ink-900/[0.08] shadow-card hover:shadow-card-hover' ?>"
                   data-animate="fade-up" data-delay="<?= ($i % 4) * 70 ?>">
                    <?php if ($featured): ?>
                        <span class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full pointer-events-none" style="z-index:-1;background:radial-gradient(closest-side,rgba(255,198,50,.6),rgba(255,198,50,0))" aria-hidden="true"></span>
                        <span class="absolute -left-16 -top-24 w-72 h-72 rounded-full pointer-events-none" style="z-index:-1;background:radial-gradient(closest-side,rgba(126,190,255,.45),rgba(126,190,255,0))" aria-hidden="true"></span>
                    <?php endif; ?>
                    <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl shrink-0 <?= $featured ? 'bg-gold-500 text-ink-900' : 'bg-navy-950 text-gold-400' ?>">
                        <?= $icon($service['icon'] ?: 'coin', 'w-7 h-7') ?>
                    </span>
                    <h3 class="mt-6 font-semibold <?= $featured ? 'text-2xl lg:text-3xl text-white' : 'text-lg text-navy-950' ?>"><?= View::e($service['name']) ?></h3>
                    <p class="mt-3 leading-relaxed <?= $featured ? 'text-white/85 text-base lg:text-lg' : 'flex-1 text-sm text-ink-500' ?>"><?= View::e($service['short_description'] ?? '') ?></p>
                    <?php if ($featured): ?>
                        <div class="tile-media relative mt-6 flex-1 min-h-[210px] rounded-2xl overflow-hidden">
                            <?php if ($featureImage !== ''): ?>
                                <img src="<?= View::e($featureImage) ?>" alt="" class="tile-photo" loading="lazy" decoding="async">
                                <span class="absolute inset-0" style="background:linear-gradient(180deg,rgba(42,103,178,.15),rgba(42,103,178,.65))" aria-hidden="true"></span>
                            <?php else: ?>
                                <div class="tile-mock" aria-hidden="true">
                                    <svg viewBox="0 0 400 220" class="w-full h-full" preserveAspectRatio="xMidYMid meet" fill="none">
                                        <rect x="8" y="8" width="384" height="204" rx="18" fill="rgba(255,255,255,.12)" stroke="rgba(255,255,255,.4)"/>
                                        <circle cx="30" cy="28" r="4.5" fill="#FFC632"/><circle cx="46" cy="28" r="4.5" fill="rgba(255,255,255,.55)"/><circle cx="62" cy="28" r="4.5" fill="rgba(255,255,255,.35)"/>
                                        <rect x="90" y="23" width="120" height="10" rx="5" fill="rgba(255,255,255,.3)"/>
                                        <g>
                                            <rect class="mock-bar" x="28" y="90" width="22" height="90" rx="5" fill="rgba(255,255,255,.55)"/>
                                            <rect class="mock-bar" x="60" y="70" width="22" height="110" rx="5" fill="#FFC632"/>
                                            <rect class="mock-bar" x="92" y="105" width="22" height="75" rx="5" fill="rgba(255,255,255,.55)"/>
                                            <rect class="mock-bar" x="124" y="60" width="22" height="120" rx="5" fill="#FFC632"/>
                                            <rect class="mock-bar" x="156" y="85" width="22" height="95" rx="5" fill="rgba(255,255,255,.55)"/>
                                            <rect class="mock-bar" x="188" y="50" width="22" height="130" rx="5" fill="#FFC632"/>
                                        </g>
                                        <path d="M232 150 C 262 140, 272 100, 300 108 S 340 60, 372 52" class="mock-line" stroke="#FFC632" stroke-width="3.5" stroke-linecap="round"/>
                                        <circle cx="372" cy="52" r="5" fill="#fff"/>
                                        <circle cx="300" cy="108" r="4" fill="rgba(255,255,255,.8)"/>
                                        <circle cx="336" cy="172" r="19" stroke="rgba(255,255,255,.25)" stroke-width="7"/>
                                        <circle cx="336" cy="172" r="19" class="mock-donut" stroke="#FFC632" stroke-width="7" stroke-linecap="round" transform="rotate(-90 336 172)"/>
                                        <g fill="rgba(255,255,255,.55)">
                                            <rect class="mock-skel" x="232" y="168" width="70" height="7" rx="3.5"/>
                                            <rect class="mock-skel" x="232" y="182" width="52" height="7" rx="3.5"/>
                                            <rect class="mock-skel" x="232" y="196" width="62" height="7" rx="3.5"/>
                                        </g>
                                    </svg>
                                </div>
                            <?php endif; ?>
                            <span class="mock-chip mock-chip--1"><i></i>Invoices</span>
                            <span class="mock-chip mock-chip--2"><i></i>VAT ready</span>
                            <span class="mock-chip mock-chip--3"><i></i>Multi-user</span>
                        </div>
                    <?php endif; ?>

                    <?php if ($featured): ?>
                        <span class="mt-6 flex flex-wrap gap-2">
                            <?php foreach (['Silver · single user', 'Gold · multi-user', 'TallyPrime Server'] as $chip): ?>
                                <span class="rounded-full bg-white/15 border border-white/25 px-3 py-1.5 text-xs font-semibold"><?= View::e($chip) ?></span>
                            <?php endforeach; ?>
                        </span>
                    <?php endif; ?>
                    <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold <?= $featured ? 'text-gold-400' : 'text-gold-600' ?> group-hover:gap-3 transition-all">
                        Learn more <?= $icon('arrow-right', 'w-4 h-4') ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="mt-12 flex flex-wrap items-center justify-center gap-4">
            <?= Html::button(['href' => '/solutions/tally-solutions', 'label' => 'View All Tally Solutions', 'variant' => 'secondary', 'icon' => true]) ?>
            <?= Html::whatsappButton('WhatsApp Us', 'Hello BMCS, I need help with TallyPrime.', 'outline-dark') ?>
        </div>
    </div>
</section>

<!-- ============================== STATS (only when real numbers are set) ============================== -->
<?php if (!empty($stats)): ?>
<section class="relative isolate overflow-hidden text-white py-16">
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <div class="relative container-custom grid grid-cols-2 <?= [1 => 'lg:grid-cols-1', 2 => 'lg:grid-cols-2', 3 => 'lg:grid-cols-3', 4 => 'lg:grid-cols-4'][count($stats)] ?? 'lg:grid-cols-4' ?> gap-8 text-center">
        <?php foreach ($stats as $stat): ?>
            <div>
                <p class="text-5xl md:text-6xl font-semibold tabular-nums">
                    <span data-count="<?= View::e($stat['value']) ?>">0</span><span class="text-gold-400"><?= View::e($stat['suffix']) ?></span>
                </p>
                <p class="mt-2 text-white/85"><?= View::e($stat['label']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- ============================== HOW WE WORK ============================== -->
<section class="section-py bg-[#F4F8FD]">
    <div class="container-custom grid grid-cols-1 lg:grid-cols-12 gap-12">
        <div class="lg:col-span-5">
            <div class="lg:sticky lg:top-32">
                <?= View::capture('components/section-heading', [
                    'eyebrow' => $get('home_process_eyebrow', 'How We Work'),
                    'title' => $get('home_process_heading', 'A Simple Process, From First Call to Ongoing Support'),
                    'subtitle' => $get('home_process_subtitle', 'No jargon and no oversized quotes — just a clear path to the right solution for your business.'),
                ]) ?>
                <div class="mt-8"><?= Html::button(['href' => '/contact', 'label' => 'Book a Consultation', 'variant' => 'primary', 'icon' => true]) ?></div>
            </div>
        </div>
        <div class="lg:col-span-7 min-w-0">
            <ol class="steps space-y-6 pl-0" data-steps>
                <?php foreach ($steps as $i => [$stepTitle, $stepText]): ?>
                    <li class="step relative flex gap-5" data-animate="fade-up">
                        <span class="step-num relative z-10 inline-flex items-center justify-center w-12 h-12 rounded-full bg-white border-2 border-navy-950 text-navy-950 font-semibold shrink-0"><?= $i + 1 ?></span>
                        <div class="flex-1 rounded-2xl bg-white border border-ink-900/[0.06] shadow-card p-6">
                            <h3 class="font-semibold text-lg text-navy-950"><?= View::e($stepTitle) ?></h3>
                            <p class="mt-2 text-ink-500 leading-relaxed"><?= View::e($stepText) ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</section>

<!-- ============================== TALLYPRIME ADVISOR ============================== -->
<section id="advisor" class="relative isolate section-py overflow-hidden">
    <div class="aurora-light" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <div class="relative container-custom grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div>
            <?= View::capture('components/section-heading', [
                'eyebrow' => $get('home_advisor_eyebrow', 'TallyPrime Advisor'),
                'title' => $get('home_advisor_heading', 'Not Sure Which TallyPrime You Need?'),
                'subtitle' => $get('home_advisor_subtitle', 'Answer two or three quick questions and we will point you to the right edition or service. No sign-up needed.'),
            ]) ?>
            <ul class="mt-8 space-y-3 text-ink-700">
                <li class="flex items-center gap-3"><span class="text-gold-600"><?= $icon('check', 'w-5 h-5') ?></span> Takes less than a minute</li>
                <li class="flex items-center gap-3"><span class="text-gold-600"><?= $icon('check', 'w-5 h-5') ?></span> Straight to the right service page</li>
                <li class="flex items-center gap-3"><span class="text-gold-600"><?= $icon('check', 'w-5 h-5') ?></span> Ask us on WhatsApp with your answers pre-filled</li>
            </ul>
        </div>

        <div data-advisor class="rounded-3xl bg-white shadow-premium border border-ink-900/[0.06] p-7 md:p-9" data-animate="fade-left">
            <div class="h-1.5 rounded-full bg-ink-100 overflow-hidden"><div data-advisor-progress class="h-full w-0 rounded-full bg-gold-500 transition-all duration-500"></div></div>
            <div data-advisor-stage class="mt-7 min-h-[22rem]" aria-live="polite">
                <noscript><p class="text-ink-500">Please enable JavaScript to use the advisor, or <a class="underline" href="/contact">contact us</a> and we will help you choose.</p></noscript>
            </div>
            <button type="button" hidden data-advisor-back class="mt-2 text-sm font-semibold text-ink-500 hover:text-navy-950">&larr; Back</button>
        </div>
    </div>
    <script type="application/json" data-advisor-config><?= json_encode($advisor, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?></script>
</section>

<!-- ============================== IT SERVICES ============================== -->
<section class="relative isolate section-py overflow-hidden text-white">
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <div class="relative container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => $get('home_services_eyebrow', 'Complete IT Services'),
            'title' => $get('home_services_heading', 'Beyond Tally: A Complete Range of IT Services'),
            'subtitle' => $get('home_services_subtitle', 'From infrastructure to digital experiences, BMCS covers the full technology stack your business relies on.'),
            'align' => 'center',
            'onDark' => true,
        ]) ?>
        <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php foreach ($itCategories as $i => $category): ?>
                <a href="/solutions/<?= View::e($category['slug']) ?>" class="glass-card spotlight group rounded-3xl p-7 block" data-animate="fade-up" data-delay="<?= ($i % 4) * 70 ?>">
                    <span class="glass-icon inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white/20 text-gold-400"><?= $icon($category['icon'] ?: 'network', 'w-7 h-7') ?></span>
                    <h3 class="mt-5 font-semibold text-lg text-white"><?= View::e($category['name']) ?></h3>
                    <p class="mt-2 text-sm text-white/85 leading-relaxed line-clamp-3"><?= View::e($category['description'] ?? '') ?></p>
                    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-semibold text-gold-400 group-hover:gap-3 transition-all">Explore <?= $icon('arrow-right', 'w-4 h-4') ?></span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================== ABOUT ============================== -->
<section class="relative section-py bg-[#F4F8FD] overflow-hidden">
    <div class="relative container-custom grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
        <div class="about-media relative" data-animate="fade-right">
            <span class="about-orbit" aria-hidden="true"><i></i></span>
            <span class="about-dot" aria-hidden="true"></span>
            <div class="about-tilt" data-tilt>
                <div class="about-ring">
                    <div class="about-frame h-[420px] md:h-[520px]" data-reveal-mask>
                        <img data-parallax-y src="<?= View::e($get('about_photo_image', '/assets/images/about/about-technician.webp')) ?>"
                             alt="BMCS technician working on server and network equipment"
                             width="1200" height="1400" loading="lazy" decoding="async" class="about-photo">
                        <span class="about-shine" aria-hidden="true"></span>
                        <span class="absolute inset-0 pointer-events-none" style="background:linear-gradient(180deg,rgba(42,103,178,0) 55%,rgba(42,103,178,.35))" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
            <?php $aboutChips = array_values(array_filter([$itCategories[0]['name'] ?? null, $itCategories[2]['name'] ?? null])); ?>
            <?php foreach ($aboutChips as $ci => $chipName): ?>
                <span class="mock-chip" style="<?= $ci === 0 ? 'top:12%;left:-18px;' : 'top:40%;right:-20px;animation-delay:-3s;' ?>z-index:3"><i></i><?= View::e(trim(explode(' & ', $chipName)[0])) ?></span>
            <?php endforeach; ?>
            <div class="float-y absolute -bottom-6 -right-4 md:-right-6 bg-navy-950 text-white rounded-2xl px-6 py-5 shadow-premium max-w-[230px]" style="z-index:3">
                <p class="text-sm font-semibold"><?= View::e($get('home_about_badge_title', 'Empowering Effective Solutions')) ?></p>
                <p class="mt-1 text-xs text-white/85"><?= View::e($get('home_about_badge_text', 'Since our founding, our focus has stayed the same.')) ?></p>
            </div>
        </div>
        <div data-animate="fade-left">
            <?= View::capture('components/section-heading', [
                'eyebrow' => $get('home_about_eyebrow', 'About BMCS'),
                'title' => $get('home_about_heading', 'A Technology Partner Built Around Your Business'),
                'subtitle' => null,
            ]) ?>
            <p class="mt-6 text-ink-500 leading-relaxed"><?= View::e($get('home_about_paragraph_1', 'Bright Mind Computer Solutions (BMCS) is a Dubai-based IT and technology solutions provider, delivering enterprise computing, data networking, security, voice and telephony, Microsoft solutions, business continuity and digital services to businesses across the UAE.')) ?></p>
            <p class="mt-4 text-ink-500 leading-relaxed"><?= View::e($get('home_about_paragraph_2', 'From structured cabling and cloud infrastructure to CCTV surveillance and web development, we bring together the technical disciplines a modern business needs under one roof — so you can work with a single, accountable technology partner instead of a patchwork of vendors.')) ?></p>
            <div class="mt-8"><?= Html::button(['href' => '/about', 'label' => 'Discover BMCS', 'variant' => 'secondary', 'icon' => true]) ?></div>
        </div>
    </div>
</section>

<!-- ============================== WHY BMCS ============================== -->
<section class="section-py bg-white">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => $get('home_why_eyebrow', 'Why BMCS'),
            'title' => $get('home_why_heading', 'A Partner Businesses Choose to Rely On'),
            'align' => 'center',
        ]) ?>
        <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php foreach ([
                ['icon' => $get('home_why_1_icon', 'coin'), 'title' => $get('home_why_1_title', 'Value for Money'), 'text' => $get('home_why_1_text', 'Solutions sized and quoted to match real business needs, not oversold.')],
                ['icon' => $get('home_why_2_icon', 'badge'), 'title' => $get('home_why_2_title', 'High Quality Work'), 'text' => $get('home_why_2_text', 'Careful design and installation across every service we deliver.')],
                ['icon' => $get('home_why_3_icon', 'heart'), 'title' => $get('home_why_3_title', 'Excellent Service'), 'text' => $get('home_why_3_text', 'Responsive support before, during and after every project.')],
                ['icon' => $get('home_why_4_icon', 'layers'), 'title' => $get('home_why_4_title', 'Complete Solutions'), 'text' => $get('home_why_4_text', 'One partner across infrastructure, security, cloud and digital.')],
            ] as $i => $item): ?>
                <div class="spotlight rounded-3xl border border-ink-900/[0.07] p-7 text-left hover:shadow-card-hover transition-shadow" data-animate="fade-up" data-delay="<?= $i * 80 ?>">
                    <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gold-500/15 text-gold-600"><?= $icon($item['icon'], 'w-7 h-7') ?></span>
                    <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($item['title']) ?></h3>
                    <p class="mt-2 text-sm text-ink-500 leading-relaxed"><?= View::e($item['text']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================== BLOG ============================== -->
<section class="section-py bg-[#F4F8FD]">
    <div class="container-custom">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <?= View::capture('components/section-heading', [
                'eyebrow' => $get('home_blog_eyebrow', 'Insights'),
                'title' => $get('home_blog_heading', 'From the BMCS Blog'),
            ]) ?>
            <?= Html::button(['href' => '/blog', 'label' => 'Visit the Blog', 'variant' => 'outline-dark', 'icon' => true]) ?>
        </div>
        <?php if (empty($latestPosts)): ?>
            <div class="mt-12 rounded-3xl bg-white p-12 text-center" data-animate="fade-up"><p class="text-ink-500">Our technology insights and articles are on their way. Check back soon.</p></div>
        <?php else: ?>
            <div class="mt-12 grid md:grid-cols-3 gap-6">
                <?php foreach ($latestPosts as $i => $post): ?>
                    <a href="/blog/<?= View::e($post['slug']) ?>" class="group rounded-3xl bg-white overflow-hidden shadow-card hover:shadow-card-hover hover:-translate-y-1 transition-all duration-300 block" data-animate="fade-up" data-delay="<?= $i * 100 ?>">
                        <?php if (!empty($post['featured_image'])): ?>
                            <div class="h-48 overflow-hidden"><img src="<?= View::e($post['featured_image']) ?>" alt="<?= View::e($post['title']) ?>" width="600" height="400" loading="lazy" decoding="async" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"></div>
                        <?php endif; ?>
                        <div class="p-6">
                            <h3 class="font-semibold text-navy-950 leading-snug"><?= View::e($post['title']) ?></h3>
                            <p class="mt-2 text-sm text-ink-500 leading-relaxed"><?= View::e($post['excerpt'] ?? '') ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- ============================== CTA ============================== -->
<section class="cta-section relative isolate overflow-hidden text-white" data-spot>
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <span class="cta-spot" aria-hidden="true"></span>
    <div class="relative container-custom py-20 md:py-28 text-center">
        <h2 class="text-3xl md:text-5xl font-semibold text-white max-w-3xl mx-auto leading-tight" data-animate="fade-up"><?php
            foreach (preg_split('/\s+/', trim($get('home_cta_heading', "Let's Build a Smarter Technology Infrastructure"))) as $w) {
                echo '<span class="cta-word">' . View::e($w) . '</span> ';
            }
        ?></h2>
        <p class="mt-5 text-white/85 max-w-xl mx-auto text-lg" data-animate="fade-up" data-delay="80"><?= View::e($get('home_cta_subtext', "Tell us about your business and we'll help you find the right technology solution.")) ?></p>
        <div class="cta-btns mt-9 flex flex-wrap items-center justify-center gap-4" data-animate="fade-up" data-delay="160">
            <?= Html::button(['href' => '/contact', 'label' => 'Book a Consultation', 'variant' => 'primary', 'icon' => true]) ?>
            <?= Html::whatsappButton('WhatsApp Us') ?>
            <?= Html::callButton('Call BMCS') ?>
        </div>
    </div>
</section>

<!-- ============================== CONTACT ============================== -->
<?= View::capture('components/contact-section') ?>
