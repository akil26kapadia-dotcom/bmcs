<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\Setting;
use App\Models\User;

class SettingsController extends Controller
{
    /** Only these keys may be written — prevents arbitrary key injection via the form. */
    private const ALLOWED_KEYS = [
        'site_name', 'site_phone', 'site_email', 'whatsapp_number',
        'site_address', 'site_city', 'site_country_code',
        'facebook_url', 'instagram_url', 'linkedin_url', 'twitter_url',
        'default_seo_title', 'default_seo_description', 'footer_text',
        'ga_id', 'gsc_verification',
    ];

    public function index(Request $request): void
    {
        $this->view('pages/admin/settings/index', [
            'title' => 'Settings',
            'settings' => Setting::allAsMap(),
        ], 'layouts/admin');
    }

    public function update(Request $request): void
    {
        foreach (self::ALLOWED_KEYS as $key) {
            if ($request->input($key) !== null) {
                Setting::set($key, trim((string) $request->input($key)));
            }
        }

        Session::flash('admin_success', 'Settings updated.');
        $this->redirect('/admin/settings');
    }

    public function updatePassword(Request $request): void
    {
        $currentPassword = (string) $request->input('current_password', '');
        $newPassword = (string) $request->input('new_password', '');
        $confirmPassword = (string) $request->input('confirm_password', '');

        $user = User::find((int) Session::get('admin_id'));

        if ($user === null || !password_verify($currentPassword, $user['password_hash'])) {
            Session::flash('admin_error', 'Your current password is incorrect.');
            $this->redirect('/admin/settings');
            return;
        }

        if (strlen($newPassword) < 10) {
            Session::flash('admin_error', 'New password must be at least 10 characters long.');
            $this->redirect('/admin/settings');
            return;
        }

        if ($newPassword !== $confirmPassword) {
            Session::flash('admin_error', 'New password and confirmation do not match.');
            $this->redirect('/admin/settings');
            return;
        }

        User::update((int) $user['id'], [
            'password_hash' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);

        Session::flash('admin_success', 'Password updated successfully.');
        $this->redirect('/admin/settings');
    }
}
