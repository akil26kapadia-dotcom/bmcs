<?php

use App\Core\View;
use App\Helpers\SiteConfig;

/**
 * The background photo used on every page-header hero across the site
 * (home, about, contact, products, solutions, services, portfolio, blog,
 * search). One upload in Admin > Page Content > Site Images changes it
 * everywhere this component is used.
 */
$alt = $alt ?? 'Dubai skyline at sunset with the Burj Khalifa';
$class = $class ?? 'w-full h-full object-cover';
$src = SiteConfig::get('site_hero_image', '/assets/images/hero/dubai-skyline-1920.jpg');
?>
<img src="<?= View::e($src) ?>"
     alt="<?= View::e($alt) ?>"
     width="1920" height="776" decoding="async" fetchpriority="high"
     class="<?= View::e($class) ?>">
