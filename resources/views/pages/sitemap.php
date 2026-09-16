<?php

use App\Core\View;

$categories = $categories ?? [];
$services = $services ?? [];
$blogCategories = $blogCategories ?? [];
$recentPosts = $recentPosts ?? [];

$staticPages = [
    ['label' => 'Home', 'href' => '/'],
    ['label' => 'About', 'href' => '/about'],
    ['label' => 'Services', 'href' => '/services'],
    ['label' => 'Solutions', 'href' => '/solutions'],
    ['label' => 'Products', 'href' => '/products'],
    ['label' => 'Portfolio', 'href' => '/portfolio'],
    ['label' => 'Blog', 'href' => '/blog'],
    ['label' => 'Contact', 'href' => '/contact'],
    ['label' => 'Privacy Policy', 'href' => '/privacy-policy'],
    ['label' => 'Terms & Conditions', 'href' => '/terms-and-conditions'],
];
?>
<?= View::capture('components/breadcrumbs', [
    'items' => [['label' => 'Home', 'href' => '/'], ['label' => 'Sitemap', 'href' => null]],
]) ?>

<section class="section-py bg-white">
    <div class="container-custom">
        <h1 class="text-3xl md:text-4xl font-semibold text-navy-950 mb-12">Sitemap</h1>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
        <div>
            <h2 class="font-semibold text-navy-950 mb-4">Pages</h2>
            <ul class="space-y-2 text-sm">
                <?php foreach ($staticPages as $page): ?>
                    <li><a href="<?= View::e($page['href']) ?>" class="text-ink-500 hover:text-gold-600"><?= View::e($page['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold text-navy-950 mb-4">Solutions</h2>
            <ul class="space-y-2 text-sm">
                <?php foreach ($categories as $category): ?>
                    <li><a href="/solutions/<?= View::e($category['slug']) ?>" class="text-ink-500 hover:text-gold-600"><?= View::e($category['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold text-navy-950 mb-4">Services</h2>
            <ul class="space-y-2 text-sm max-h-96 overflow-y-auto">
                <?php foreach ($services as $service): ?>
                    <li><a href="/services/<?= View::e($service['slug']) ?>" class="text-ink-500 hover:text-gold-600"><?= View::e($service['name']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div>
            <h2 class="font-semibold text-navy-950 mb-4">Blog</h2>
            <?php if (!empty($blogCategories)): ?>
                <p class="text-xs font-semibold uppercase tracking-wide text-ink-500 mb-2">Categories</p>
                <ul class="space-y-2 text-sm mb-6">
                    <?php foreach ($blogCategories as $cat): ?>
                        <li><a href="/blog/category/<?= View::e($cat['slug']) ?>" class="text-ink-500 hover:text-gold-600"><?= View::e($cat['name']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <?php if (!empty($recentPosts)): ?>
                <p class="text-xs font-semibold uppercase tracking-wide text-ink-500 mb-2">Recent Articles</p>
                <ul class="space-y-2 text-sm">
                    <?php foreach ($recentPosts as $post): ?>
                        <li><a href="/blog/<?= View::e($post['slug']) ?>" class="text-ink-500 hover:text-gold-600"><?= View::e($post['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        </div>
    </div>
</section>
