<?php

use App\Core\View;

$recent_posts = $recent_posts ?? [];

$statusBadge = fn (string $status) => match ($status) {
    'published' => 'badge-published',
    'scheduled' => 'badge-scheduled',
    default => 'badge-draft',
};
?>
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
    <?php foreach ([
        ['label' => 'Total Posts', 'value' => $total_posts],
        ['label' => 'Published', 'value' => $published_posts],
        ['label' => 'Drafts', 'value' => $draft_posts],
        ['label' => 'Categories', 'value' => $total_categories],
    ] as $stat): ?>
        <div class="card p-6">
            <p class="text-sm text-ink-500"><?= View::e($stat['label']) ?></p>
            <p class="mt-2 text-3xl font-semibold text-navy-950"><?= (int) $stat['value'] ?></p>
        </div>
    <?php endforeach; ?>
</div>

<div class="mt-8 card overflow-hidden">
    <div class="px-6 py-4 border-b border-ink-900/[0.06] flex items-center justify-between">
        <h2 class="font-semibold text-navy-950">Recent Posts</h2>
        <a href="/admin/posts" class="text-sm font-semibold text-gold-600 hover:text-gold-500">View all &rarr;</a>
    </div>
    <?php if (empty($recent_posts)): ?>
        <p class="p-6 text-sm text-ink-500">No posts yet. <a href="/admin/posts/create" class="text-gold-600 font-medium">Create your first post</a>.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Updated</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_posts as $post): ?>
                        <tr>
                            <td class="font-medium text-navy-950"><?= View::e($post['title']) ?></td>
                            <td class="text-ink-500"><?= View::e($post['category_name'] ?? '—') ?></td>
                            <td><span class="badge <?= $statusBadge($post['status']) ?>"><?= View::e(ucfirst($post['status'])) ?></span></td>
                            <td class="text-ink-500"><?= View::e(date('M j, Y', strtotime($post['updated_at']))) ?></td>
                            <td class="text-right">
                                <a href="/admin/posts/edit/<?= (int) $post['id'] ?>" class="text-sm font-semibold text-gold-600 hover:text-gold-500">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
