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
        <h3 class="font-semibold text-navy-950">Address</h3>
        <p class="text-sm text-ink-500">Shown in the footer and used in the site's Organization/LocalBusiness structured data for search engines.</p>
        <div>
            <label for="site_address" class="form-label">Street Address</label>
            <input type="text" id="site_address" name="site_address" value="<?= $get('site_address') ?>" class="form-input" placeholder="e.g. Office 000, Building Name, Street, Area">
            <p class="form-hint">Leave blank to show just the city and country.</p>
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
            <div>
                <label for="site_city" class="form-label">City</label>
                <input type="text" id="site_city" name="site_city" value="<?= $get('site_city') ?: 'Dubai' ?>" class="form-input">
            </div>
            <div>
                <label for="site_country_code" class="form-label">Country Code</label>
                <input type="text" id="site_country_code" name="site_country_code" value="<?= $get('site_country_code') ?: 'AE' ?>" class="form-input" maxlength="2" placeholder="AE">
                <p class="form-hint">Two-letter ISO code, e.g. AE for United Arab Emirates.</p>
            </div>
        </div>
    </div>

    <div class="card p-6 space-y-4">
        <h3 class="font-semibold text-navy-950">Social Links</h3>
        <p class="text-sm text-ink-500">Optional. Shown as icons in the footer and included in structured data. Leave any blank to hide it.</p>
        <div>
            <label for="facebook_url" class="form-label">Facebook URL</label>
            <input type="url" id="facebook_url" name="facebook_url" value="<?= $get('facebook_url') ?>" class="form-input" placeholder="https://facebook.com/...">
        </div>
        <div>
            <label for="instagram_url" class="form-label">Instagram URL</label>
            <input type="url" id="instagram_url" name="instagram_url" value="<?= $get('instagram_url') ?>" class="form-input" placeholder="https://instagram.com/...">
        </div>
        <div>
            <label for="linkedin_url" class="form-label">LinkedIn URL</label>
            <input type="url" id="linkedin_url" name="linkedin_url" value="<?= $get('linkedin_url') ?>" class="form-input" placeholder="https://linkedin.com/company/...">
        </div>
        <div>
            <label for="twitter_url" class="form-label">X / Twitter URL</label>
            <input type="url" id="twitter_url" name="twitter_url" value="<?= $get('twitter_url') ?>" class="form-input" placeholder="https://x.com/...">
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
