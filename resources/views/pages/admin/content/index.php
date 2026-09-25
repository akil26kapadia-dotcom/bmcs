<?php

use App\Core\Csrf;
use App\Core\View;

$groups = $groups ?? [];
?>
<p class="text-sm text-ink-500 max-w-2xl mb-6">
    Every headline, subheading and paragraph on the site's main pages. Leave any field as-is to keep
    the current text. Services, blog posts, portfolio projects, categories and menus each have their
    own screens elsewhere in this sidebar.
</p>

<div class="space-y-4 max-w-4xl">
    <?php foreach ($groups as $groupKey => $group): ?>
        <details class="card overflow-hidden">
            <summary class="cursor-pointer select-none px-6 py-4 font-semibold text-navy-950"><?= View::e($group['label']) ?></summary>
            <form action="/admin/content/<?= View::e($groupKey) ?>" method="POST" enctype="multipart/form-data" class="px-6 pb-6 space-y-4 border-t border-ink-900/[0.06] pt-5">
                <?= Csrf::field() ?>
                <?php foreach ($group['fields'] as $key => $field): ?>
                    <div>
                        <label for="<?= View::e($key) ?>" class="form-label"><?= View::e($field['label']) ?></label>
                        <?php if (($field['type'] ?? 'text') === 'textarea'): ?>
                            <textarea id="<?= View::e($key) ?>" name="<?= View::e($key) ?>" rows="2" class="form-textarea"><?= View::e($field['value']) ?></textarea>
                        <?php elseif (($field['type'] ?? 'text') === 'html'): ?>
                            <textarea id="<?= View::e($key) ?>" name="<?= View::e($key) ?>" rows="16" class="form-textarea font-mono text-xs leading-relaxed"><?= View::e($field['value']) ?></textarea>
                            <p class="form-hint">HTML content, rendered as-is on the page.</p>
                        <?php elseif (($field['type'] ?? 'text') === 'image'): ?>
                            <div class="flex items-start gap-4">
                                <img src="<?= View::e($field['value']) ?>" alt="" class="w-28 h-20 object-cover rounded-lg border border-ink-900/[0.08] shrink-0 bg-ink-100">
                                <div class="flex-1 space-y-2">
                                    <input type="file" id="<?= View::e($key) ?>" name="<?= View::e($key) ?>" accept="image/jpeg,image/png,image/webp,image/gif" class="form-input text-xs">
                                    <label class="flex items-center gap-2 text-sm text-ink-700">
                                        <input type="checkbox" name="<?= View::e($key) ?>_reset" value="1" class="form-checkbox">
                                        Reset to default image
                                    </label>
                                </div>
                            </div>
                            <?php if (!empty($field['hint'])): ?>
                                <p class="form-hint"><?= View::e($field['hint']) ?></p>
                            <?php endif; ?>
                        <?php else: ?>
                            <input type="text" id="<?= View::e($key) ?>" name="<?= View::e($key) ?>" value="<?= View::e($field['value']) ?>" class="form-input">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="btn-primary">Save <?= View::e($group['label']) ?></button>
            </form>
        </details>
    <?php endforeach; ?>
</div>
