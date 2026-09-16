<?php

use App\Core\Csrf;
use App\Core\View;

$posts = $posts ?? [];

$statusBadge = fn (string $status) => match ($status) {
    'published' => 'badge-published',
    'scheduled' => 'badge-scheduled',
    default => 'badge-draft',
};
?>
<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-ink-500"><?= count($posts) ?> post<?= count($posts) === 1 ? '' : 's' ?></p>
    <a href="/admin/posts/create" class="btn-primary">
        <?= \App\Helpers\Icon::svg('layers', 'w-4 h-4') ?>
        New Post
    </a>
</div>

<div class="card overflow-hidden">
    <?php if (empty($posts)): ?>
        <p class="p-6 text-sm text-ink-500">No posts yet. <a href="/admin/posts/create" class="text-gold-600 font-medium">Create your first post</a>.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td class="font-medium text-navy-950">
                                <?= View::e($post['title']) ?>
                                <?php if ($post['is_featured']): ?>
                                    <span class="ml-1.5 text-gold-500" title="Featured">&#9733;</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-ink-500"><?= View::e($post['category_name'] ?? '—') ?></td>
                            <td class="text-ink-500"><?= View::e($post['author_name'] ?? '—') ?></td>
                            <td><span class="badge <?= $statusBadge($post['status']) ?>"><?= View::e(ucfirst($post['status'])) ?></span></td>
                            <td class="text-ink-500"><?= $post['published_at'] ? View::e(date('M j, Y', strtotime($post['published_at']))) : '—' ?></td>
                            <td class="text-right whitespace-nowrap">
                                <a href="/admin/posts/edit/<?= (int) $post['id'] ?>" class="text-sm font-semibold text-gold-600 hover:text-gold-500 mr-4">Edit</a>
                                <form action="/admin/posts/delete/<?= (int) $post['id'] ?>" method="POST" class="inline" data-confirm="Delete this post? This cannot be undone.">
                                    <?= Csrf::field() ?>
                                    <button type="submit" class="text-sm font-semibold text-red-600 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
