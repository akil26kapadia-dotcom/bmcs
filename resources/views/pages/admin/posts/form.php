<?php

use App\Core\Csrf;
use App\Core\View;

$post = $post ?? null;
$categories = $categories ?? [];
$tags = $tags ?? [];
$selectedTagIds = $selectedTagIds ?? [];
$isEdit = $post !== null;

$action = $isEdit ? '/admin/posts/update/' . $post['id'] : '/admin/posts';
$publishedAtValue = !empty($post['published_at']) ? date('Y-m-d\TH:i', strtotime($post['published_at'])) : '';

$field = fn (string $key, $default = '') => View::e($post[$key] ?? $default);
?>
<form action="<?= $action ?>" method="POST" enctype="multipart/form-data" class="grid lg:grid-cols-3 gap-6">
    <?= Csrf::field() ?>

    <div class="lg:col-span-2 space-y-6">
        <div class="card p-6">
            <label for="title" class="form-label">Title <span class="text-red-500">*</span></label>
            <input type="text" id="title" name="title" required value="<?= $field('title') ?>"
                   data-slug-source class="form-input text-lg font-medium">

            <label for="slug" class="form-label mt-5">Slug</label>
            <input type="text" id="slug" name="slug" value="<?= $field('slug') ?>"
                   data-slug-target class="form-input" placeholder="auto-generated-from-title">
            <p class="form-hint">Final URL: /blog/<span id="slug-preview"><?= $field('slug') ?: 'your-post-slug' ?></span></p>

            <label for="excerpt" class="form-label mt-5">Excerpt</label>
            <textarea id="excerpt" name="excerpt" rows="2" class="form-textarea" placeholder="Short summary shown on blog listings"><?= $field('excerpt') ?></textarea>
        </div>

        <div class="card p-6" data-rich-editor>
            <label class="form-label">Content</label>
            <div class="flex flex-wrap gap-1 mb-2 pb-2 border-b border-ink-900/[0.08]">
                <?php foreach ([
                    ['h2', 'H2'], ['h3', 'H3'], ['bold', 'B'], ['italic', 'I'],
                    ['quote', '"'], ['code', '&lt;/&gt;'], ['ul', '&bull; List'], ['ol', '1. List'],
                    ['link', 'Link'], ['image', 'Image'], ['table', 'Table'],
                ] as [$action_, $label]): ?>
                    <button type="button" data-editor-action="<?= $action_ ?>" class="editor-toolbar-btn" title="<?= ucfirst($action_) ?>"><?= $label ?></button>
                <?php endforeach; ?>
            </div>
            <textarea name="content" rows="18" class="form-textarea font-mono text-xs leading-relaxed"><?= $field('content') ?></textarea>
            <p class="form-hint">HTML content. Use the toolbar to wrap selected text, or write HTML directly.</p>
        </div>

        <div class="card p-6">
            <h3 class="font-semibold text-navy-950 mb-4">SEO</h3>
            <div class="space-y-4">
                <div>
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="<?= $field('meta_title') ?>" class="form-input" placeholder="Defaults to post title if left blank">
                </div>
                <div>
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="2" class="form-textarea"><?= $field('meta_description') ?></textarea>
                </div>
                <div>
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords" value="<?= $field('meta_keywords') ?>" class="form-input" placeholder="comma, separated, keywords">
                </div>
                <div>
                    <label for="canonical_url" class="form-label">Canonical URL</label>
                    <input type="url" id="canonical_url" name="canonical_url" value="<?= $field('canonical_url') ?>" class="form-input" placeholder="Leave blank to use the default canonical URL">
                </div>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="font-semibold text-navy-950 mb-4">Open Graph &amp; Twitter Card</h3>
            <div class="space-y-4">
                <div>
                    <label for="og_title" class="form-label">OG Title</label>
                    <input type="text" id="og_title" name="og_title" value="<?= $field('og_title') ?>" class="form-input" placeholder="Defaults to meta/post title if left blank">
                </div>
                <div>
                    <label for="og_description" class="form-label">OG Description</label>
                    <textarea id="og_description" name="og_description" rows="2" class="form-textarea"><?= $field('og_description') ?></textarea>
                </div>
                <div>
                    <label for="og_image" class="form-label">OG Image URL</label>
                    <input type="text" id="og_image" name="og_image" value="<?= $field('og_image') ?>" class="form-input" placeholder="Defaults to the featured image if left blank">
                </div>
            </div>
        </div>
    </div>

    <div class="lg:col-span-1 space-y-6">
        <div class="card p-6">
            <h3 class="font-semibold text-navy-950 mb-4">Publish</h3>
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select">
                <?php foreach (['draft' => 'Draft', 'published' => 'Published', 'scheduled' => 'Scheduled'] as $value => $label): ?>
                    <option value="<?= $value ?>" <?= ($post['status'] ?? 'draft') === $value ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>

            <label for="published_at" class="form-label mt-4">Publish Date</label>
            <input type="datetime-local" id="published_at" name="published_at" value="<?= View::e($publishedAtValue) ?>" class="form-input">
            <p class="form-hint">Leave blank to publish immediately, or set a future date to schedule.</p>

            <?php if ($isEdit): ?>
                <p class="form-hint mt-3">Last updated: <?= View::e(date('M j, Y g:ia', strtotime($post['updated_at']))) ?></p>
            <?php endif; ?>

            <label class="flex items-center gap-2 mt-4">
                <input type="checkbox" name="is_featured" value="1" class="form-checkbox" <?= !empty($post['is_featured']) ? 'checked' : '' ?>>
                <span class="text-sm text-ink-700">Feature this post</span>
            </label>

            <button type="submit" class="btn-primary w-full justify-center mt-5"><?= $isEdit ? 'Update Post' : 'Create Post' ?></button>
        </div>

        <div class="card p-6">
            <h3 class="font-semibold text-navy-950 mb-4">Featured Image</h3>
            <?php if (!empty($post['featured_image'])): ?>
                <img src="<?= $field('featured_image') ?>" alt="" class="w-full h-36 object-cover rounded-lg mb-3">
            <?php endif; ?>
            <img id="featured-image-preview" src="" alt="" class="w-full h-36 object-cover rounded-lg mb-3 hidden">
            <input type="file" name="featured_image" accept="image/jpeg,image/png,image/webp,image/gif"
                   data-image-preview-input="featured-image-preview" class="form-input text-xs">
            <p class="form-hint">JPG, PNG, WebP or GIF, up to 5MB.</p>
        </div>

        <div class="card p-6">
            <h3 class="font-semibold text-navy-950 mb-4">Category</h3>
            <select name="category_id" class="form-select">
                <option value="">— None —</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= (int) $category['id'] ?>" <?= (int) ($post['category_id'] ?? 0) === (int) $category['id'] ? 'selected' : '' ?>>
                        <?= View::e($category['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="form-hint">Manage categories on the <a href="/admin/categories" class="text-gold-600">Categories</a> page.</p>
        </div>

        <div class="card p-6">
            <h3 class="font-semibold text-navy-950 mb-4">Tags</h3>
            <?php if (empty($tags)): ?>
                <p class="text-sm text-ink-500">No tags yet.</p>
            <?php else: ?>
                <div class="space-y-2 max-h-48 overflow-y-auto">
                    <?php foreach ($tags as $tag): ?>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="tag_ids[]" value="<?= (int) $tag['id'] ?>" class="form-checkbox"
                                   <?= in_array($tag['id'], $selectedTagIds, true) ? 'checked' : '' ?>>
                            <span class="text-sm text-ink-700"><?= View::e($tag['name']) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <p class="form-hint">Manage tags on the <a href="/admin/tags" class="text-gold-600">Tags</a> page.</p>
        </div>
    </div>
</form>
