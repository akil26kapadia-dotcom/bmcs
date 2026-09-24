<?php

use App\Core\View;
use App\Helpers\Html;
use App\Helpers\Icon;

$project = $project ?? [];
$related = $related ?? [];
$gallery = $project['gallery'] ?? [];
$technologies = array_filter(array_map('trim', explode(',', $project['technologies'] ?? '')));
?>
<?= View::capture('components/breadcrumbs', [
    'items' => array_filter([
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Portfolio', 'href' => '/portfolio'],
        !empty($project['category_name']) ? ['label' => $project['category_name'], 'href' => '/solutions/' . $project['category_slug']] : null,
        ['label' => $project['title'], 'href' => null],
    ]),
]) ?>

<!-- HERO -->
<section class="relative bg-navy-950 overflow-hidden">
    <div class="absolute inset-0">
        <img src="<?= View::e($project['featured_image']) ?>" alt="<?= View::e($project['title']) ?>"
             width="1000" height="750" decoding="async" fetchpriority="high"
             class="w-full h-full object-cover opacity-30">
        <div class="absolute inset-0 bg-gradient-to-b from-navy-950/90 via-navy-950/85 to-navy-950"></div>
    </div>
    <div class="relative container-custom py-16 md:py-20">
        <?php if (!empty($project['is_demo'])): ?>
            <span class="inline-block bg-gold-500/15 text-gold-400 text-xs font-semibold uppercase tracking-wide px-3 py-1.5 rounded">
                Sample Project &mdash; shown for illustration
            </span>
        <?php endif; ?>
        <?php if (!empty($project['industry'])): ?>
            <p class="mt-5 eyebrow-on-dark"><?= View::e($project['industry']) ?></p>
        <?php endif; ?>
        <h1 class="mt-3 text-3xl md:text-5xl font-semibold text-white max-w-3xl"><?= View::e($project['title']) ?></h1>
        <p class="mt-4 text-white/80 max-w-2xl text-lg"><?= View::e($project['summary']) ?></p>
    </div>
</section>

<!-- GALLERY -->
<?php if (!empty($gallery)): ?>
<section class="bg-white py-10 border-b border-ink-900/[0.06]">
    <div class="container-custom grid grid-cols-2 md:grid-cols-3 gap-4">
        <?php foreach ($gallery as $i => $image): ?>
            <button type="button" data-lightbox-src="<?= View::e($image) ?>" data-lightbox-alt="<?= View::e($project['title']) ?> &mdash; image <?= $i + 1 ?>"
                    class="relative rounded-xl overflow-hidden h-48 md:h-56 group">
                <img src="<?= View::e($image) ?>" alt="<?= View::e($project['title']) ?> &mdash; image <?= $i + 1 ?>"
                     width="1000" height="750" loading="lazy" decoding="async"
                     class="w-full h-full object-cover transition-transform duration-500 ease-premium group-hover:scale-105">
                <span class="absolute inset-0 bg-navy-950/0 group-hover:bg-navy-950/20 transition-colors"></span>
            </button>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- DETAILS -->
<section class="section-py bg-white">
    <div class="container-custom grid lg:grid-cols-3 gap-12">
        <div class="lg:col-span-2 space-y-12">
            <?php if (!empty($project['challenge'])): ?>
                <div>
                    <h2 class="text-2xl font-semibold text-navy-950">The Challenge</h2>
                    <p class="mt-4 text-ink-500 leading-relaxed"><?= View::e($project['challenge']) ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($project['solution'])): ?>
                <div>
                    <h2 class="text-2xl font-semibold text-navy-950">The Solution</h2>
                    <p class="mt-4 text-ink-500 leading-relaxed"><?= View::e($project['solution']) ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($project['outcome'])): ?>
                <div>
                    <h2 class="text-2xl font-semibold text-navy-950">The Outcome</h2>
                    <p class="mt-4 text-ink-500 leading-relaxed"><?= View::e($project['outcome']) ?></p>
                </div>
            <?php endif; ?>
        </div>

        <aside class="lg:col-span-1 space-y-6">
            <div class="card p-6">
                <h3 class="font-semibold text-navy-950">Project Details</h3>
                <dl class="mt-4 space-y-4 text-sm">
                    <?php if (!empty($project['industry'])): ?>
                        <div>
                            <dt class="text-ink-500">Industry</dt>
                            <dd class="mt-0.5 font-medium text-navy-950"><?= View::e($project['industry']) ?></dd>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($project['category_name'])): ?>
                        <div>
                            <dt class="text-ink-500">Service Area</dt>
                            <dd class="mt-0.5 font-medium text-navy-950">
                                <a href="/solutions/<?= View::e($project['category_slug']) ?>" class="hover:text-gold-600"><?= View::e($project['category_name']) ?></a>
                            </dd>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($technologies)): ?>
                        <div>
                            <dt class="text-ink-500">Technologies</dt>
                            <dd class="mt-2 flex flex-wrap gap-2">
                                <?php foreach ($technologies as $tech): ?>
                                    <span class="inline-block bg-ink-100 text-ink-700 text-xs font-medium px-2.5 py-1 rounded-full"><?= View::e($tech) ?></span>
                                <?php endforeach; ?>
                            </dd>
                        </div>
                    <?php endif; ?>
                </dl>
            </div>

            <div class="card p-6 bg-navy-950 border-none">
                <h3 class="font-semibold text-white">Planning something similar?</h3>
                <p class="mt-2 text-sm text-white/80">Tell us about your project and we'll help you scope it out.</p>
                <div class="mt-4">
                    <?= Html::button(['href' => '/contact', 'label' => 'Talk to BMCS', 'variant' => 'primary', 'icon' => true, 'class' => 'w-full']) ?>
                </div>
            </div>
        </aside>
    </div>
</section>

<!-- RELATED PROJECTS -->
<?php if (!empty($related)): ?>
<section class="section-py bg-ink-100/50">
    <div class="container-custom">
        <?= View::capture('components/section-heading', [
            'eyebrow' => 'More Work',
            'title' => 'Related Projects',
        ]) ?>
        <div class="mt-10 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($related as $i => $relatedProject): ?>
                <?= View::capture('components/portfolio-card', ['project' => $relatedProject, 'delay' => $i * 80]) ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?= View::capture('components/lightbox') ?>
