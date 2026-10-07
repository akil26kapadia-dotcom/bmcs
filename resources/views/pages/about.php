<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;
use App\Helpers\SiteConfig;

$categories = $categories ?? [];
$get = fn (string $key, string $default) => SiteConfig::get($key, $default);
$icon = fn (string $name, string $class = 'w-6 h-6') => Icon::svg($name, $class);
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'About', 'href' => null],
    ],
]) ?>

<?= View::capture('components/page-hero', [
    'eyebrow' => $get('about_hero_eyebrow', 'About BMCS'),
    'title' => $get('about_hero_heading', 'Empowering Effective Solutions'),
    'subtitle' => $get('about_hero_subtext', 'A Dubai-based IT and technology solutions provider bringing enterprise infrastructure, security, cloud and digital capabilities together for businesses across the UAE.'),
]) ?>

<!-- WHO WE ARE / STORY -->
<section class="section-py bg-white overflow-hidden">
    <div class="container-custom grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">
        <div class="about-media relative" data-animate="fade-right">
            <span class="about-orbit" aria-hidden="true"><i></i></span>
            <span class="about-dot" aria-hidden="true"></span>
            <div class="about-tilt" data-tilt>
                <div class="about-ring">
                    <div class="about-frame h-[380px] md:h-[480px]" data-reveal-mask>
                        <img data-parallax-y src="<?= View::e(SiteConfig::get('about_photo_image', '/assets/images/about/about-technician.webp')) ?>"
                             alt="BMCS technician working on server and network equipment"
                             width="1200" height="1400" loading="lazy" decoding="async" class="about-photo">
                        <span class="about-shine" aria-hidden="true"></span>
                        <span class="absolute inset-0 pointer-events-none" style="background:linear-gradient(180deg,rgba(42,103,178,0) 55%,rgba(42,103,178,.3))" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
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
<section class="section-py bg-[#F4F8FD]">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => $get('about_expertise_eyebrow', 'What We Do'),
            'title' => $get('about_expertise_heading', 'Our Areas of Expertise'),
            'subtitle' => $get('about_expertise_subtitle', 'Eight core technology areas, covering the full range of services a modern business relies on.'),
            'align' => 'center',
        ]) ?>
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
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
        <div class="mt-14 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php foreach ([
                ['icon' => $get('about_why_1_icon', 'coin'), 'title' => $get('about_why_1_title', 'Value for Money'), 'text' => $get('about_why_1_text', 'Solutions sized and priced to match real business needs, not oversold.')],
                ['icon' => $get('about_why_2_icon', 'badge'), 'title' => $get('about_why_2_title', 'High Quality Work'), 'text' => $get('about_why_2_text', 'Careful design and installation across every service we deliver.')],
                ['icon' => $get('about_why_3_icon', 'heart'), 'title' => $get('about_why_3_title', 'Excellent Service'), 'text' => $get('about_why_3_text', 'Responsive support before, during and after every project.')],
                ['icon' => $get('about_why_4_icon', 'layers'), 'title' => $get('about_why_4_title', 'Complete Solutions'), 'text' => $get('about_why_4_text', 'One partner across infrastructure, security, cloud and digital.')],
            ] as $i => $item): ?>
                <div class="spotlight rounded-3xl border border-ink-900/[0.07] p-7 text-center hover:shadow-card-hover transition-shadow" data-animate="fade-up" data-delay="<?= $i * 80 ?>">
                    <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gold-500/15 text-gold-600"><?= $icon($item['icon'], 'w-7 h-7') ?></span>
                    <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($item['title']) ?></h3>
                    <p class="mt-2 text-sm text-ink-500 leading-relaxed"><?= View::e($item['text']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- TECHNOLOGY & INNOVATION -->
<section class="relative isolate overflow-hidden text-white">
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <div class="relative container-custom section-py text-center max-w-3xl mx-auto">
        <span class="eyebrow-on-dark"><?= View::e($get('about_tech_eyebrow', 'Technology & Innovation')) ?></span>
        <h2 class="mt-4 text-2xl md:text-3xl font-semibold text-white"><?= View::e($get('about_tech_heading', 'Built on the Desire to Do Excellent Work')) ?></h2>
        <p class="mt-5 text-white/85 leading-relaxed">
            <?= View::e($get('about_tech_paragraph', "We approach every engagement with the same goal: deliver technology that genuinely works for the business behind it. From network cabling to cloud migration and digital design, our focus stays on solutions that are reliable, well-installed and built to last — not just the fastest thing to deploy.")) ?>
        </p>
    </div>
</section>

<!-- CTA -->
<section class="cta-section relative isolate overflow-hidden text-white" data-spot>
    <div class="aurora" aria-hidden="true"><span class="aurora-blob aurora-blob--sky"></span><span class="aurora-blob aurora-blob--deep"></span><span class="aurora-blob aurora-blob--yellow"></span></div>
    <span class="cta-spot" aria-hidden="true"></span>
    <div class="relative container-custom py-16 md:py-20 text-center">
        <h2 class="text-2xl md:text-4xl font-semibold text-white"><?php
            foreach (preg_split('/\s+/', trim($get('about_cta_heading', "Let's Talk About Your Technology Needs"))) as $w) {
                echo '<span class="cta-word">' . View::e($w) . '</span> ';
            }
        ?></h2>
        <p class="mt-3 text-white/85 max-w-xl mx-auto"><?= View::e($get('about_cta_subtext', "Get in touch and we'll help you find the right solution for your business.")) ?></p>
        <div class="cta-btns mt-8 flex flex-wrap items-center justify-center gap-4">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true]) ?>
            <?= Html::whatsappButton('WhatsApp Us') ?>
        </div>
    </div>
</section>
