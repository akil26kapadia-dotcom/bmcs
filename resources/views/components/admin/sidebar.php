<?php

use App\Core\Csrf;
use App\Core\Session;
use App\Core\View;

$currentPath = $currentPath ?? '';

$navItems = [
    ['label' => 'Dashboard', 'href' => '/admin/dashboard', 'icon' => 'layers'],
    ['label' => 'Posts', 'href' => '/admin/posts', 'icon' => 'monitor'],
    ['label' => 'Categories', 'href' => '/admin/categories', 'icon' => 'briefcase'],
    ['label' => 'Tags', 'href' => '/admin/tags', 'icon' => 'badge'],
    ['label' => 'Media', 'href' => '/admin/media', 'icon' => 'cloud'],
    ['label' => 'Contacts', 'href' => '/admin/contacts', 'icon' => 'phone'],
    ['label' => 'Settings', 'href' => '/admin/settings', 'icon' => 'life-buoy'],
];
?>
<div data-admin-sidebar-backdrop class="fixed inset-0 bg-navy-950/60 z-30 hidden lg:hidden"></div>

<aside data-admin-sidebar class="admin-sidebar">
    <div class="px-5 py-6 flex items-center gap-3 border-b border-white/10">
        <img src="/assets/images/logo-mark.png" alt="BMCS" width="26" height="32" class="h-8 w-auto">
        <span class="font-bold text-white tracking-tight">BMCS Admin</span>
    </div>

    <nav class="p-4 space-y-1">
        <?php foreach ($navItems as $item): ?>
            <a href="<?= View::e($item['href']) ?>"
               class="admin-nav-link <?= str_starts_with($currentPath, ltrim($item['href'], '/')) ? 'is-active' : '' ?>">
                <?= \App\Helpers\Icon::svg($item['icon'], 'w-5 h-5') ?>
                <?= View::e($item['label']) ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="mt-auto p-4 border-t border-white/10">
        <p class="px-4 text-xs text-white/40">Signed in as</p>
        <p class="px-4 text-sm font-medium text-white"><?= View::e(Session::get('admin_name', 'Admin')) ?></p>
        <form action="/admin/logout" method="POST" class="mt-3 px-4">
            <?= Csrf::field() ?>
            <button type="submit" class="text-sm text-white/60 hover:text-gold-400">Log out</button>
        </form>
    </div>
</aside>
