<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;

$serviceCategories = $serviceCategories ?? [];
$portfolioProjects = $portfolioProjects ?? [];
$latestPosts = $latestPosts ?? [];
$icon = fn (string $name, string $class = 'w-6 h-6') => Icon::svg($name, $class);
?>

<!-- ============================== HERO ============================== -->
<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <img src="/assets/images/hero/hero-datacenter-1920.webp"
             srcset="/assets/images/hero/hero-datacenter-960.webp 960w, /assets/images/hero/hero-datacenter-1920.webp 1920w"
             sizes="100vw"
             alt="Data center server hardware with glowing cooling fans, representing BMCS IT infrastructure services"
             width="1920" height="1080"
             class="w-full h-full object-cover opacity-40"
             fetchpriority="high" decoding="async">
        <div class="absolute inset-0 bg-gradient-to-b from-navy-950/95 via-navy-950/85 to-navy-950"></div>
    </div>

    <?= View::capture('components/hero-network-bg') ?>

    <div class="relative container-custom pt-20 pb-28 md:pt-28 md:pb-40 lg:pt-36 lg:pb-48 text-center">
        <span class="eyebrow-on-dark" data-animate="fade-up">Empowering Effective Solutions</span>
        <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-semibold tracking-tight text-white max-w-4xl mx-auto leading-[1.1]" data-animate="fade-up" data-delay="80">
            Technology That Moves Your Business Forward
        </h1>
        <p class="mt-6 text-lg text-white/70 max-w-2xl mx-auto leading-relaxed" data-animate="fade-up" data-delay="160">
            Reliable IT infrastructure, security, networking and digital solutions designed to help
            businesses in Dubai and across the UAE operate smarter, safer and more efficiently.
        </p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-4" data-animate="fade-up" data-delay="240">
            <?= Html::button(['href' => '/solutions', 'label' => 'Explore Our Solutions', 'variant' => 'primary', 'icon' => true]) ?>
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to an Expert', 'variant' => 'outline-light']) ?>
        </div>
    </div>
</section>

<!-- ============================== TRUST STRIP ============================== -->
<section class="bg-white border-b border-ink-900/[0.06]">
    <div class="container-custom py-10">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
            <?php foreach ([
                ['icon' => 'network', 'label' => 'IT Infrastructure'],
                ['icon' => 'network', 'label' => 'Networking'],
                ['icon' => 'shield', 'label' => 'Security'],
                ['icon' => 'cloud', 'label' => 'Cloud'],
                ['icon' => 'phone', 'label' => 'Telecommunication'],
                ['icon' => 'monitor', 'label' => 'Digital Solutions'],
            ] as $i => $item): ?>
                <div class="flex flex-col items-center text-center gap-2" data-animate="fade-up" data-delay="<?= $i * 60 ?>">
                    <span class="text-gold-600"><?= $icon($item['icon'], 'w-7 h-7') ?></span>
                    <span class="text-xs font-medium text-ink-700"><?= View::e($item['label']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================== ABOUT ============================== -->
<section class="relative section-py bg-white overflow-hidden">
    <div class="section-blob w-[28rem] h-[28rem] -top-32 -right-32" aria-hidden="true"></div>
    <div class="relative container-custom grid lg:grid-cols-2 gap-14 items-center">
        <div class="relative" data-animate="fade-right">
            <img src="/assets/images/about/about-technician.webp"
                 alt="BMCS technician working on server and network equipment"
                 width="1200" height="1400" loading="lazy" decoding="async"
                 class="rounded-2xl shadow-premium w-full h-[420px] md:h-[520px] object-cover">
            <div class="absolute -bottom-6 -right-6 hidden md:block bg-navy-950 text-white rounded-xl px-6 py-5 shadow-premium max-w-[220px]">
                <p class="text-sm font-semibold">Empowering Effective Solutions</p>
                <p class="mt-1 text-xs text-white/60">Since our founding, our focus has stayed the same.</p>
            </div>
        </div>
        <div data-animate="fade-left">
            <?= View::capture('components/section-heading', [
                'eyebrow' => 'About BMCS',
                'title' => 'A Technology Partner Built Around Your Business',
                'subtitle' => null,
            ]) ?>
            <p class="mt-6 text-ink-500 leading-relaxed">
                Bright Mind Computer Solutions (BMCS) is a Dubai-based IT and technology solutions provider,
                delivering enterprise computing, data networking, security, voice and telephony, Microsoft
                solutions, business continuity and digital services to businesses across the UAE.
            </p>
            <p class="mt-4 text-ink-500 leading-relaxed">
                From structured cabling and cloud infrastructure to CCTV surveillance and web development,
                we bring together the technical disciplines a modern business needs under one roof —
                so you can work with a single, accountable technology partner instead of a patchwork of vendors.
            </p>
            <div class="mt-8">
                <?= Html::button(['href' => '/about', 'label' => 'Discover BMCS', 'variant' => 'secondary', 'icon' => true]) ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================== SERVICES ============================== -->
<section class="relative section-py bg-ink-100/50 bg-dot-grid overflow-hidden">
    <div class="section-blob w-[26rem] h-[26rem] -bottom-40 -left-40" aria-hidden="true"></div>
    <div class="relative container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'What We Do',
            'title' => 'A Complete Range of IT & Technology Services',
            'subtitle' => 'From infrastructure to digital experiences, BMCS covers the full technology stack your business relies on.',
            'align' => 'center',
        ]) ?>

        <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($serviceCategories as $i => $category): ?>
                <?= View::capture('components/category-card', ['category' => $category, 'delay' => ($i % 4) * 80]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================== TECHNOLOGY SOLUTIONS (BENTO) ============================== -->
<section class="section-py bg-navy-950">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'Technology Solutions',
            'title' => 'Infrastructure Built for Reliability and Growth',
            'subtitle' => 'A closer look at the technology areas where BMCS delivers the most impact.',
            'align' => 'center',
            'onDark' => true,
        ]) ?>

        <div class="mt-14 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ([
                ['title' => 'Network & Infrastructure', 'slug' => 'network-infrastructure', 'image' => 'solution-network.webp', 'span' => 'lg:col-span-2 lg:row-span-2', 'h' => 'h-[280px] lg:h-full'],
                ['title' => 'Security & Surveillance', 'slug' => 'security-surveillance', 'image' => 'solution-security.webp', 'span' => '', 'h' => 'h-[280px]'],
                ['title' => 'Cloud & Data', 'slug' => 'cloud-data', 'image' => 'solution-cloud.webp', 'span' => '', 'h' => 'h-[280px]'],
                ['title' => 'Telecommunication', 'slug' => 'telecommunication', 'image' => 'solution-telecom.webp', 'span' => '', 'h' => 'h-[280px]'],
                ['title' => 'IT Support & Distribution', 'slug' => 'it-support-distribution', 'image' => 'solution-itsupport.webp', 'span' => '', 'h' => 'h-[280px]'],
                ['title' => 'Web & Digital', 'slug' => 'web-digital', 'image' => 'solution-webdigital.webp', 'span' => 'lg:col-span-1', 'h' => 'h-[280px]'],
            ] as $i => $tile): ?>
                <a href="/solutions/<?= View::e($tile['slug']) ?>"
                   class="group relative <?= $tile['span'] ?> <?= $tile['h'] ?> rounded-2xl overflow-hidden block"
                   data-animate="fade-up" data-delay="<?= $i * 70 ?>">
                    <img src="/assets/images/services/<?= View::e($tile['image']) ?>"
                         alt="<?= View::e($tile['title']) ?> technology solution"
                         width="900" height="700" loading="lazy" decoding="async"
                         class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 ease-premium group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/90 via-navy-950/20 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-6 flex items-center justify-between">
                        <h3 class="text-white font-semibold text-lg"><?= View::e($tile['title']) ?></h3>
                        <svg class="w-5 h-5 text-white/80 transition-transform duration-300 group-hover:translate-x-1" viewBox="0 0 20 20" fill="none"><path d="M4 10h12M11 5l5 5-5 5" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================== WHY BMCS ============================== -->
<section class="section-py bg-white">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'Why BMCS',
            'title' => 'A Partner Businesses Choose to Rely On',
            'align' => 'center',
        ]) ?>

        <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ([
                ['icon' => 'coin', 'title' => 'Value for Money', 'text' => 'Solutions sized and priced to match real business needs, not oversold.'],
                ['icon' => 'badge', 'title' => 'High Quality Work', 'text' => 'Careful design and installation across every service we deliver.'],
                ['icon' => 'heart', 'title' => 'Excellent Service', 'text' => 'Responsive support before, during and after every project.'],
                ['icon' => 'layers', 'title' => 'Complete Solutions', 'text' => 'One partner across infrastructure, security, cloud and digital.'],
            ] as $i => $item): ?>
                <div class="text-center p-6" data-animate="fade-up" data-delay="<?= $i * 80 ?>">
                    <span class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gold-500/10 text-gold-600">
                        <?= $icon($item['icon'], 'w-7 h-7') ?>
                    </span>
                    <h3 class="mt-5 font-semibold text-navy-950"><?= View::e($item['title']) ?></h3>
                    <p class="mt-2 text-sm text-ink-500 leading-relaxed"><?= View::e($item['text']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================== PARTNERS ============================== -->
<?= View::capture('components/partners-strip') ?>

<!-- ============================== PORTFOLIO ============================== -->
<section class="section-py bg-white">
    <div class="container-custom">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <?= View::capture('components/section-heading', [
                'eyebrow' => 'Our Work',
                'title' => 'A Look at Our Project Capabilities',
                'subtitle' => 'Representative examples of the type of work BMCS delivers across infrastructure, security and cloud.',
            ]) ?>
            <?= Html::button(['href' => '/portfolio', 'label' => 'View Portfolio', 'variant' => 'outline-dark', 'icon' => true]) ?>
        </div>

        <div class="mt-12 grid md:grid-cols-3 gap-6">
            <?php foreach ($portfolioProjects as $i => $project): ?>
                <?= View::capture('components/portfolio-card', ['project' => $project, 'delay' => $i * 100]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================== BLOG PREVIEW ============================== -->
<section class="section-py bg-ink-100/50">
    <div class="container-custom">
        <div class="flex flex-wrap items-end justify-between gap-6">
            <?= View::capture('components/section-heading', [
                'eyebrow' => 'Insights',
                'title' => 'From the BMCS Blog',
            ]) ?>
            <?= Html::button(['href' => '/blog', 'label' => 'Visit the Blog', 'variant' => 'outline-dark', 'icon' => true]) ?>
        </div>

        <?php if (empty($latestPosts)): ?>
            <div class="mt-12 card p-12 text-center" data-animate="fade-up">
                <p class="text-ink-500">Our technology insights and articles are on their way. Check back soon.</p>
            </div>
        <?php else: ?>
            <div class="mt-12 grid md:grid-cols-3 gap-6">
                <?php foreach ($latestPosts as $i => $post): ?>
                    <a href="/blog/<?= View::e($post['slug']) ?>" class="group card card-hover overflow-hidden block" data-animate="fade-up" data-delay="<?= $i * 100 ?>">
                        <?php if (!empty($post['featured_image'])): ?>
                            <div class="h-48 overflow-hidden">
                                <img src="<?= View::e($post['featured_image']) ?>" alt="<?= View::e($post['title']) ?>"
                                     width="600" height="400" loading="lazy" decoding="async"
                                     class="w-full h-full object-cover transition-transform duration-500 ease-premium group-hover:scale-105">
                            </div>
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
<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0 hero-grid opacity-40 pointer-events-none" aria-hidden="true"></div>
    <div class="relative container-custom py-20 text-center">
        <h2 class="text-3xl md:text-4xl font-semibold text-white max-w-2xl mx-auto" data-animate="fade-up">
            Let's Build a Smarter Technology Infrastructure
        </h2>
        <p class="mt-4 text-white/70 max-w-xl mx-auto" data-animate="fade-up" data-delay="80">
            Tell us about your business and we'll help you find the right technology solution.
        </p>
        <div class="mt-8" data-animate="fade-up" data-delay="160">
            <?= Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true]) ?>
        </div>
    </div>
</section>

<!-- ============================== CONTACT ============================== -->
<?= View::capture('components/contact-section') ?>
