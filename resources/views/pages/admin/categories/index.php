<?php

use App\Core\Csrf;
use App\Core\View;

$categories = $categories ?? [];
?>
<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 card overflow-hidden">
        <?php if (empty($categories)): ?>
            <p class="p-6 text-sm text-ink-500">No categories yet.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead><tr><th>Name</th><th>Slug</th><th></th></tr></thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td class="font-medium text-navy-950"><?= View::e($category['name']) ?></td>
                            <td class="text-ink-500"><?= View::e($category['slug']) ?></td>
                            <td class="text-right">
                                <form action="/admin/categories/delete/<?= (int) $category['id'] ?>" method="POST" data-confirm="Delete this category? Posts using it will be uncategorized.">
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
        <h3 class="font-semibold text-navy-950 mb-4">Add Category</h3>
        <form action="/admin/categories" method="POST" class="space-y-4">
            <?= Csrf::field() ?>
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" required class="form-input">
            </div>
            <div>
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" rows="2" class="form-textarea"></textarea>
            </div>
            <button type="submit" class="btn-primary w-full justify-center">Add Category</button>
        </form>
    </div>
</div>
