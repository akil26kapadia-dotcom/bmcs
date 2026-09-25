<?php

use App\Core\Csrf;
use App\Core\View;

$rows = $rows ?? [];
?>
<p class="text-sm text-ink-500 max-w-2xl mb-6">
    Meta title and description for the site's main pages. Leave a field blank to use the site's default
    (Settings &gt; SEO Defaults) or the page's built-in fallback. Individual services, blog posts and
    portfolio projects have their own SEO fields on their own edit screens.
</p>

<div class="space-y-4 max-w-3xl">
    <?php foreach ($rows as $row): ?>
        <details class="card overflow-hidden" <?= !empty($row['meta_title']) ? 'open' : '' ?>>
            <summary class="cursor-pointer select-none px-6 py-4 font-semibold text-navy-950 flex items-center justify-between gap-4">
                <span><?= View::e($row['label']) ?></span>
                <?php if (!empty($row['meta_title'])): ?>
                    <span class="text-xs font-medium text-gold-600 uppercase tracking-wide">Customized</span>
                <?php endif; ?>
            </summary>
            <div class="px-6 pb-6 space-y-4 border-t border-ink-900/[0.06] pt-5">
                <form action="/admin/seo" method="POST" id="seo-form-<?= View::e(str_replace('/', '-', $row['route_key'])) ?>" class="space-y-4">
                    <?= Csrf::field() ?>
                    <input type="hidden" name="route_key" value="<?= View::e($row['route_key']) ?>">
                    <div>
                        <label class="form-label">Meta Title</label>
                        <input type="text" name="meta_title" value="<?= View::e($row['meta_title'] ?? '') ?>" class="form-input" maxlength="200">
                    </div>
                    <div>
                        <label class="form-label">Meta Description</label>
                        <textarea name="meta_description" rows="2" class="form-textarea" maxlength="300"><?= View::e($row['meta_description'] ?? '') ?></textarea>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Social Share Title (optional)</label>
                            <input type="text" name="og_title" value="<?= View::e($row['og_title'] ?? '') ?>" class="form-input" maxlength="200">
                        </div>
                        <div>
                            <label class="form-label">Social Share Image (optional)</label>
                            <input type="text" name="og_image" value="<?= View::e($row['og_image'] ?? '') ?>" class="form-input" placeholder="/assets/images/...">
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Social Share Description (optional)</label>
                        <textarea name="og_description" rows="2" class="form-textarea" maxlength="300"><?= View::e($row['og_description'] ?? '') ?></textarea>
                    </div>
                    <div>
                        <label class="form-label">Canonical URL Override (optional)</label>
                        <input type="text" name="canonical_url" value="<?= View::e($row['canonical_url'] ?? '') ?>" class="form-input" placeholder="Leave blank to use the page's own URL">
                    </div>
                </form>
                <div class="flex items-center justify-between gap-4 pt-2">
                    <button type="submit" form="seo-form-<?= View::e(str_replace('/', '-', $row['route_key'])) ?>" class="btn-primary">Save</button>
                    <?php if (!empty($row['id'])): ?>
                        <form action="/admin/seo/delete/<?= (int) $row['id'] ?>" method="POST" data-confirm="Remove this override? The page will fall back to its default title and description.">
                            <?= Csrf::field() ?>
                            <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Remove override</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </details>
    <?php endforeach; ?>
</div>

<div class="card p-6 mt-8 max-w-3xl">
    <h3 class="font-semibold text-navy-950 mb-1">Add a Custom Route</h3>
    <p class="text-sm text-ink-500 mb-4">For any other page path not listed above, e.g. <code>blog/category/networking</code>.</p>
    <form action="/admin/seo" method="POST" class="grid sm:grid-cols-3 gap-4 items-end">
        <?= Csrf::field() ?>
        <div class="sm:col-span-1">
            <label class="form-label">Route (path, no leading slash)</label>
            <input type="text" name="route_key" required class="form-input" placeholder="e.g. blog/category/networking">
        </div>
        <div class="sm:col-span-2">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-input">
        </div>
        <div class="sm:col-span-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" rows="2" class="form-textarea"></textarea>
        </div>
        <div class="sm:col-span-3">
            <button type="submit" class="btn-primary">Add Route</button>
        </div>
    </form>
</div>
