<?php

use App\Core\Csrf;
use App\Core\View;

$tags = $tags ?? [];
?>
<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 card overflow-hidden">
        <?php if (empty($tags)): ?>
            <p class="p-6 text-sm text-ink-500">No tags yet.</p>
        <?php else: ?>
            <table class="admin-table">
                <thead><tr><th>Name</th><th>Slug</th><th></th></tr></thead>
                <tbody>
                    <?php foreach ($tags as $tag): ?>
                        <tr>
                            <td class="font-medium text-navy-950"><?= View::e($tag['name']) ?></td>
                            <td class="text-ink-500"><?= View::e($tag['slug']) ?></td>
                            <td class="text-right">
                                <form action="/admin/tags/delete/<?= (int) $tag['id'] ?>" method="POST" data-confirm="Delete this tag?">
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
        <h3 class="font-semibold text-navy-950 mb-4">Add Tag</h3>
        <form action="/admin/tags" method="POST" class="space-y-4">
            <?= Csrf::field() ?>
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" required class="form-input">
            </div>
            <button type="submit" class="btn-primary w-full justify-center">Add Tag</button>
        </form>
    </div>
</div>
