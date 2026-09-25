<?php

use App\Core\Csrf;
use App\Core\View;

$categories = $categories ?? [];
?>
<p class="text-sm text-ink-500 max-w-2xl mb-6">
    The category cards shown on the public Products page (<code>/products</code>).
    Icon names come from the site's built-in icon set — see the list below the form.
</p>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 card overflow-hidden self-start">
        <?php if (empty($categories)): ?>
            <p class="p-6 text-sm text-ink-500">No product categories yet.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead><tr><th>Order</th><th>Name</th><th>Icon</th><th>Description</th><th></th></tr></thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td class="text-ink-500"><?= (int) $category['sort_order'] ?></td>
                            <td class="font-medium text-navy-950"><?= View::e($category['name']) ?></td>
                            <td class="text-ink-500"><?= View::e($category['icon']) ?></td>
                            <td class="text-ink-500 text-sm"><?= View::e($category['description']) ?></td>
                            <td class="text-right">
                                <form action="/admin/products/delete/<?= (int) $category['id'] ?>" method="POST" data-confirm="Delete this product category?">
                                    <?= Csrf::field() ?>
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <div class="card p-6">
        <h3 class="font-semibold text-navy-950 mb-4">Add Product Category</h3>
        <form action="/admin/products" method="POST" class="space-y-4">
            <?= Csrf::field() ?>
            <div>
                <label class="form-label">Name</label>
                <input type="text" name="name" required class="form-input">
            </div>
            <div>
                <label class="form-label">Icon</label>
                <input type="text" name="icon" value="layers" class="form-input">
                <p class="form-hint">network, cloud, shield, phone, briefcase, life-buoy, coin, badge, heart, layers, server, monitor, projector, plug, lock, camera, microphone, bulb, code, chart, palette, video, refresh, gear, search, link, cart, mobile</p>
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
