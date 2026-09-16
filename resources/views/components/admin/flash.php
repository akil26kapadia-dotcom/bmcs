<?php

use App\Core\Session;
use App\Core\View;

$success = Session::flash('admin_success');
$error = Session::flash('admin_error');
?>
<?php if ($success): ?>
    <div class="mb-6 rounded-lg bg-green-50 border border-green-200 text-green-800 px-5 py-3.5 text-sm">
        <?= View::e($success) ?>
    </div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 text-red-800 px-5 py-3.5 text-sm">
        <?= View::e($error) ?>
    </div>
<?php endif; ?>
