<?php

use App\Core\Csrf;
use App\Core\View;
use App\Helpers\Icon;

$categories = $categories ?? [];
$iconHint = 'network, cloud, shield, phone, briefcase, life-buoy, coin, badge, heart, layers, server, monitor, projector, plug, lock, camera, microphone, bulb, code, chart, palette, video, refresh, gear, search, link, cart, mobile — or upload a custom image instead, which always wins over a typed name.';
?>
<p class="text-sm text-ink-500 max-w-2xl mb-6">
    The category cards shown on the public Products page (<code>/products</code>). Click a category
    to edit its name, icon (or upload a custom image), description and order.
</p>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-3 self-start">
        <?php if (empty($categories)): ?>
            <div class="card p-6 text-sm text-ink-500">No product categories yet.</div>
        <?php else: ?>
            <?php foreach ($categories as $category): ?>
                <details class="card overflow-hidden">
                    <summary class="cursor-pointer select-none px-5 py-4 flex items-center gap-4">
                        <span class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-ink-100 text-navy-950 shrink-0">
                            <?= Icon::svg($category['icon'], 'w-5 h-5') ?>
                        </span>
                        <span class="flex-1 font-medium text-navy-950"><?= View::e($category['name']) ?></span>
                        <span class="text-xs text-ink-500">Order <?= (int) $category['sort_order'] ?></span>
                    </summary>
                    <div class="px-5 pb-5 border-t border-ink-900/[0.06] pt-4">
                        <form action="/admin/products/update/<?= (int) $category['id'] ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                            <?= Csrf::field() ?>
                            <div>
                                <label class="form-label">Name</label>
                                <input type="text" name="name" value="<?= View::e($category['name']) ?>" required class="form-input">
                            </div>
                            <div>
                                <label class="form-label">Icon</label>
                                <input type="text" name="icon" value="<?= View::e($category['icon']) ?>" class="form-input">
                                <input type="file" name="icon_file" accept="image/jpeg,image/png,image/webp,image/gif" class="form-input text-xs mt-2">
                                <p class="form-hint"><?= View::e($iconHint) ?></p>
                            </div>
                            <div>
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="2" class="form-textarea"><?= View::e($category['description']) ?></textarea>
                            </div>
                            <div>
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" value="<?= (int) $category['sort_order'] ?>" class="form-input">
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <button type="submit" class="btn-primary">Save</button>
                            </div>
                        </form>
                        <form action="/admin/products/delete/<?= (int) $category['id'] ?>" method="POST" data-confirm="Delete this product category?" class="mt-3">
                            <?= Csrf::field() ?>
                            <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Delete category</button>
                        </form>
                    </div>
                </details>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div class="card p-6">
        <h3 class="font-semibold text-navy-950 mb-4">Add Product Category</h3>
        <form action="/admin/products" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?= Csrf::field() ?>
            <div>
                <label class="form-label">Name</label>
                <input type="text" name="name" required class="form-input">
            </div>
            <div>
                <label class="form-label">Icon</label>
                <input type="text" name="icon" value="layers" class="form-input">
                <input type="file" name="icon_file" accept="image/jpeg,image/png,image/webp,image/gif" class="form-input text-xs mt-2">
                <p class="form-hint"><?= View::e($iconHint) ?></p>
            </div>
            <div>
                <label class="form-label">Description</label>
                <textarea name="description" rows="2" class="form-textarea"></textarea>
            </div>
            <div>
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="100" class="form-input">
            </div>
            <button type="submit" class="btn-primary w-full justify-center">Add Category</button>
        </form>
    </div>
</div>
