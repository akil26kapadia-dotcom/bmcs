<?php

use App\Core\Csrf;
use App\Core\View;

$locations = $locations ?? [];
$items = $items ?? [];
$byLocation = [];
foreach ($locations as $key => $label) {
    $byLocation[$key] = [];
}
foreach ($items as $item) {
    $byLocation[$item['location']][] = $item;
}
?>
<p class="text-sm text-ink-500 max-w-2xl mb-6">
    Controls the plain links in the header and the footer's "Quick Links" column. Lower sort order shows first.
    The Tally and IT Services dropdown menus in the header are not listed here — their contents come
    straight from Admin &gt; Categories and Services, so there is nothing to duplicate.
</p>

<div class="grid lg:grid-cols-2 gap-6">
    <?php foreach ($locations as $locationKey => $locationLabel): ?>
        <div class="card overflow-hidden self-start">
            <h3 class="px-6 py-4 font-semibold text-navy-950 border-b border-ink-900/[0.06]"><?= View::e($locationLabel) ?></h3>
            <?php if (empty($byLocation[$locationKey])): ?>
                <p class="p-6 text-sm text-ink-500">No items yet.</p>
            <?php else: ?>
                <table class="admin-table">
                    <thead><tr><th>Order</th><th>Label</th><th>URL</th><th></th></tr></thead>
                    <tbody>
                        <?php foreach ($byLocation[$locationKey] as $item): ?>
                            <tr>
                                <td class="text-ink-500"><?= (int) $item['sort_order'] ?></td>
                                <td class="font-medium text-navy-950"><?= View::e($item['label']) ?><?= $item['open_new_tab'] ? ' <span class="text-xs text-ink-500">(new tab)</span>' : '' ?></td>
                                <td class="text-ink-500 text-sm"><?= View::e($item['url']) ?></td>
                                <td class="text-right">
                                    <form action="/admin/menus/delete/<?= (int) $item['id'] ?>" method="POST" data-confirm="Remove this menu item?">
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
    <?php endforeach; ?>

    <div class="card p-6 lg:col-span-2">
        <h3 class="font-semibold text-navy-950 mb-4">Add Menu Item</h3>
        <form action="/admin/menus" method="POST" class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            <?= Csrf::field() ?>
            <div>
                <label class="form-label">Location</label>
                <select name="location" required class="form-input">
                    <?php foreach ($locations as $key => $label): ?>
                        <option value="<?= View::e($key) ?>"><?= View::e($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="form-label">Label</label>
                <input type="text" name="label" required class="form-input" placeholder="e.g. FAQs">
            </div>
            <div>
                <label class="form-label">URL</label>
                <input type="text" name="url" required class="form-input" placeholder="/faqs or https://...">
            </div>
            <div>
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" value="100" class="form-input">
            </div>
            <div class="flex items-center gap-2 pb-2.5">
                <input type="checkbox" id="open_new_tab" name="open_new_tab" value="1" class="form-checkbox">
                <label for="open_new_tab" class="text-sm text-ink-700">Open in new tab</label>
            </div>
            <div class="lg:col-span-5">
                <button type="submit" class="btn-primary">Add Item</button>
            </div>
        </form>
    </div>
</div>
