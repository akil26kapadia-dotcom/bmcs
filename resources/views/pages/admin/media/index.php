<?php

use App\Core\Csrf;
use App\Core\View;

$media = $media ?? [];
?>
<div class="grid lg:grid-cols-4 gap-6">
    <div class="lg:col-span-1 card p-6 h-fit">
        <h3 class="font-semibold text-navy-950 mb-4">Upload File</h3>
        <form action="/admin/media/upload" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?= Csrf::field() ?>
            <div>
                <label for="file" class="form-label">File</label>
                <input type="file" id="file" name="file" required accept="image/jpeg,image/png,image/webp,image/gif" class="form-input text-xs">
                <p class="form-hint">JPG, PNG, WebP or GIF, up to 5MB.</p>
            </div>
            <div>
                <label for="alt_text" class="form-label">Alt Text</label>
                <input type="text" id="alt_text" name="alt_text" class="form-input" placeholder="Describe the image">
            </div>
            <button type="submit" class="btn-primary w-full justify-center">Upload</button>
        </form>
    </div>

    <div class="lg:col-span-3">
        <?php if (empty($media)): ?>
            <div class="card p-12 text-center text-sm text-ink-500">No media uploaded yet.</div>
        <?php else: ?>
            <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
                <?php foreach ($media as $item): ?>
                    <div class="card overflow-hidden">
                        <img src="<?= View::e($item['file_path']) ?>" alt="<?= View::e($item['alt_text'] ?? '') ?>" class="w-full h-36 object-cover">
                        <div class="p-3">
                            <p class="text-xs text-ink-500 truncate" title="<?= View::e($item['file_path']) ?>"><?= View::e($item['file_path']) ?></p>
                            <div class="mt-2 flex items-center justify-between">
                                <button type="button" data-copy-path="<?= View::e($item['file_path']) ?>" class="text-xs font-semibold text-gold-600 hover:text-gold-500">Copy path</button>
                                <form action="/admin/media/delete/<?= (int) $item['id'] ?>" method="POST" data-confirm="Delete this file?">
                                    <?= Csrf::field() ?>
                                    <button type="submit" class="text-xs font-semibold text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
