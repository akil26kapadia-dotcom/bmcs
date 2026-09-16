<?php

use App\Core\Csrf;
use App\Core\View;

$submissions = $submissions ?? [];
?>
<div class="card overflow-hidden">
    <?php if (empty($submissions)): ?>
        <p class="p-6 text-sm text-ink-500">No contact submissions yet.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th><th>Email</th><th>Service</th><th>Message</th><th>Status</th><th>Received</th><th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $item): ?>
                        <tr>
                            <td class="font-medium text-navy-950"><?= View::e($item['name']) ?></td>
                            <td class="text-ink-500"><a href="mailto:<?= View::e($item['email']) ?>" class="hover:text-gold-600"><?= View::e($item['email']) ?></a></td>
                            <td class="text-ink-500"><?= View::e($item['service'] ?? '—') ?></td>
                            <td class="text-ink-500 max-w-xs truncate" title="<?= View::e($item['message']) ?>"><?= View::e($item['message']) ?></td>
                            <td><span class="badge <?= $item['status'] === 'new' ? 'badge-scheduled' : 'badge-published' ?>"><?= View::e(ucfirst($item['status'])) ?></span></td>
                            <td class="text-ink-500 whitespace-nowrap"><?= View::e(date('M j, Y', strtotime($item['created_at']))) ?></td>
                            <td class="text-right">
                                <?php if ($item['status'] === 'new'): ?>
                                    <form action="/admin/contacts/read/<?= (int) $item['id'] ?>" method="POST">
                                        <?= Csrf::field() ?>
                                        <button type="submit" class="text-sm font-semibold text-gold-600 hover:text-gold-500">Mark Read</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
