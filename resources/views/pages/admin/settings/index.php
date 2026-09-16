<?php

use App\Core\Csrf;
use App\Core\View;

$settings = $settings ?? [];
$get = fn (string $key) => View::e($settings[$key] ?? '');
?>
<form action="/admin/settings" method="POST" class="max-w-2xl space-y-6">
    <?= Csrf::field() ?>

    <div class="card p-6 space-y-4">
        <h3 class="font-semibold text-navy-950">General</h3>
        <div>
            <label for="site_name" class="form-label">Site Name</label>
            <input type="text" id="site_name" name="site_name" value="<?= $get('site_name') ?>" class="form-input">
        </div>
        <div>
            <label for="footer_text" class="form-label">Footer Text</label>
            <input type="text" id="footer_text" name="footer_text" value="<?= $get('footer_text') ?>" class="form-input">
        </div>
    </div>

    <div class="card p-6 space-y-4">
        <h3 class="font-semibold text-navy-950">Contact</h3>
        <div>
            <label for="site_phone" class="form-label">Phone</label>
            <input type="text" id="site_phone" name="site_phone" value="<?= $get('site_phone') ?>" class="form-input">
        </div>
        <div>
            <label for="site_email" class="form-label">Email</label>
            <input type="email" id="site_email" name="site_email" value="<?= $get('site_email') ?>" class="form-input">
        </div>
        <div>
            <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
            <input type="text" id="whatsapp_number" name="whatsapp_number" value="<?= $get('whatsapp_number') ?>" class="form-input" placeholder="e.g. 971501234567 (numbers only)">
            <p class="form-hint">Leave blank to hide WhatsApp links. Only enter a number that is confirmed to support WhatsApp.</p>
        </div>
    </div>

    <div class="card p-6 space-y-4">
        <h3 class="font-semibold text-navy-950">SEO Defaults</h3>
        <div>
            <label for="default_seo_title" class="form-label">Default SEO Title</label>
            <input type="text" id="default_seo_title" name="default_seo_title" value="<?= $get('default_seo_title') ?>" class="form-input">
        </div>
        <div>
            <label for="default_seo_description" class="form-label">Default SEO Description</label>
            <textarea id="default_seo_description" name="default_seo_description" rows="2" class="form-textarea"><?= $get('default_seo_description') ?></textarea>
        </div>
    </div>

    <div class="card p-6 space-y-4">
        <h3 class="font-semibold text-navy-950">Analytics</h3>
        <div>
            <label for="ga_id" class="form-label">Google Analytics ID</label>
            <input type="text" id="ga_id" name="ga_id" value="<?= $get('ga_id') ?>" class="form-input" placeholder="G-XXXXXXXXXX">
        </div>
        <div>
            <label for="gsc_verification" class="form-label">Google Search Console Verification</label>
            <input type="text" id="gsc_verification" name="gsc_verification" value="<?= $get('gsc_verification') ?>" class="form-input">
        </div>
    </div>

    <button type="submit" class="btn-primary">Save Settings</button>
</form>

<form action="/admin/settings/password" method="POST" class="max-w-2xl mt-6">
    <?= Csrf::field() ?>
    <div class="card p-6 space-y-4">
        <h3 class="font-semibold text-navy-950">Change Password</h3>
        <div>
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" id="current_password" name="current_password" required class="form-input" autocomplete="current-password">
        </div>
        <div>
            <label for="new_password" class="form-label">New Password</label>
            <input type="password" id="new_password" name="new_password" required minlength="10" class="form-input" autocomplete="new-password">
            <p class="form-hint">At least 10 characters.</p>
        </div>
        <div>
            <label for="confirm_password" class="form-label">Confirm New Password</label>
            <input type="password" id="confirm_password" name="confirm_password" required minlength="10" class="form-input" autocomplete="new-password">
        </div>
        <button type="submit" class="btn-primary">Update Password</button>
    </div>
</form>
