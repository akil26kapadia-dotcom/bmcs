<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;
use App\Helpers\SiteConfig;

$categories = $categories ?? [];
$get = fn (string $key, string $default) => SiteConfig::get($key, $default);
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => null],
    ],
]) ?>

<!-- HERO -->
<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <?= View::capture('components/hero-image', ['alt' => "Dubai skyline at sunset with the Burj Khalifa"]) ?>
        <div class="absolute inset-0 bg-navy-600 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-navy-950/25"></div>
    </div>
    <div class="absolute inset-0 hero-grid opacity-30 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-16 md:py-24 text-center">
        <span class="eyebrow-on-dark"><?= View::e($get('about_hero_eyebrow', 'About BMCS')) ?></span>
        <h1 class="mt-4 text-3xl md:text-5xl font-semibold text-white max-w-3xl mx-auto">
            <?= View::e($get('about_hero_heading', 'Empowering Effective Solutions')) ?>
        </h1>
        <p class="mt-4 text-white/80 max-w-2xl mx-auto text-lg">
            <?= View::e($get('about_hero_subtext', 'A Dubai-based IT and technology solutions provider bringing enterprise infrastructure, security, cloud and digital capabilities together for businesses across the UAE.')) ?>
        </p>
    </div>
</section>

<!-- WHO WE ARE / STORY -->
<section class="section-py bg-white overflow-hidden">
    <div class="container-custom grid lg:grid-cols-2 gap-14 items-center">
        <div data-animate="fade-right">
            <img src="<?= View::e(SiteConfig::get('about_photo_image', '/assets/images/about/about-technician.webp')) ?>"
                 alt="BMCS technician working on server and network equipment"
                 width="1200" height="1400" loading="lazy" decoding="async"
                 class="rounded-2xl shadow-premium w-full h-[420px] md:h-[520px] object-cover">
        </div>
        <div data-animate="fade-left">
            <span class="eyebrow"><?= View::e($get('about_story_eyebrow', 'Who We Are')) ?></span>
            <h2 class="mt-3 text-2xl md:text-3xl font-semibold text-navy-950"><?= View::e($get('about_story_heading', 'A Single Technology Partner, Not a Patchwork of Vendors')) ?></h2>
            <p class="mt-5 text-ink-500 leading-relaxed">
                <?= View::e($get('about_story_paragraph_1', 'Bright Mind Computer Solutions (BMCS) is a Dubai-based IT and technology solutions provider. We deliver enterprise computing, data networking and security, voice and telephony, Microsoft licensing and solutions, business continuity and disaster recovery, data center, audio visual, access control, CCTV surveillance, video conferencing, projector and PABX systems for businesses across the UAE.')) ?>
            </p>
            <p class="mt-4 text-ink-500 leading-relaxed">
                <?= View::e($get('about_story_paragraph_2', 'Alongside our core IT infrastructure services, we also deliver web design and development, mobile app development and digital branding — bringing network, ICT infrastructure and digital solutions together under one accountable partner instead of a patchwork of vendors and freelancers.')) ?>
            </p>
        </div>
    </div>
</section>

<!-- WHAT WE DO / EXPERTISE -->
<section class="section-py bg-ink-100/50">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => $get('about_expertise_eyebrow', 'What We Do'),
            'title' => $get('about_expertise_heading', 'Our Areas of Expertise'),
            'subtitle' => $get('about_expertise_subtitle', 'Eight core technology areas, covering the full range of services a modern business relies on.'),
            'align' => 'center',
        ]) ?>
        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($categories as $i => $category): ?>
                <?= View::capture('components/category-card', ['category' => $category, 'delay' => ($i % 4) * 80]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- WHY BUSINESSES CHOOSE BMCS -->
<section class="section-py bg-white">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => $get('about_why_eyebrow', 'Why BMCS'),
            'title' => $get('about_why_heading', 'Why Businesses Choose to Work With Us'),
            'align' => 'center',
        ]) ?>
        <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ([
                ['icon' => 'coin', 'title' => $get('about_why_1_title', 'Value for Money'), 'text' => $get('about_why_1_text', 'Solutions sized and priced to match real business needs, not oversold.')],
                ['icon' => 'badge', 'title' => $get('about_why_2_title', 'High Quality Work'), 'text' => $get('about_why_2_text', 'Careful design and installation across every service we deliver.')],
                ['icon' => 'heart', 'title' => $get('about_why_3_title', 'Excellent Service'), 'text' => $get('about_why_3_text', 'Responsive support before, during and after every project.')],
                ['icon' => 'layers', 'title' => $get('about_why_4_title', 'Complete Solutions'), 'text' => $get('about_why_4_text', 'One partner across infrastructure, security, cloud and digital.')],
            ] as $i => $item): ?>
                <div class="text-center p-6" data-animate="fade-up" data-delay="<?= $i * 80 ?>">
                    <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gold-500/10 text-gold-600">
                        <?= Icon::svg($item['icon'], 'w-7 h-7') ?>
                    </span>
                    <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($item['title']) ?></h3>
                    <p class="mt-2 text-sm text-ink-500 leading-relaxed"><?= View::e($item['text']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TECHNOLOGY & INNOVATION -->
<section class="section-py bg-navy-950 overflow-hidden">
    <div class="container-custom text-center max-w-3xl mx-auto">
        <span class="eyebrow-on-dark"><?= View::e($get('about_tech_eyebrow', 'Technology & Innovation')) ?></span>
        <h2 class="mt-4 text-2xl md:text-3xl font-semibold text-white"><?= View::e($get('about_tech_heading', 'Built on the Desire to Do Excellent Work')) ?></h2>
        <p class="mt-5 text-white/80 leading-relaxed">
            <?= View::e($get('about_tech_paragraph', "We approach every engagement with the same goal: deliver technology that genuinely works for the business behind it. From network cabling to cloud migration and digital design, our focus stays on solutions that are reliable, well-installed and built to last — not just the fastest thing to deploy.")) ?>
        </p>
    </div>
</section>

<!-- CTA -->
<section class="section-py bg-white">
    <div class="container-custom text-center">
        <h2 class="text-2xl md:text-3xl font-semibold text-navy-950"><?= View::e($get('about_cta_heading', "Let's Talk About Your Technology Needs")) ?></h2>
        <p class="mt-3 text-ink-500 max-w-xl mx-auto"><?= View::e($get('about_cta_subtext', "Get in touch and we'll help you find the right solution for your business.")) ?></p>
        <div class="mt-8">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'secondary', 'icon' => true]) ?>
        </div>
    </div>
</section>
