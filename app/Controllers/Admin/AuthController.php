<?php

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller
{
    private const MAX_ATTEMPTS = 5;
    private const LOCK_MINUTES = 15;

    public function showLogin(Request $request): void
    {
        if (Session::has('admin_id')) {
            $this->redirect('/admin/dashboard');
            return;
        }

        $this->view('pages/admin/login', [
            'title' => 'Admin Login',
            'error' => Session::flash('login_error'),
        ], 'layouts/auth');
    }

    public function login(Request $request): void
    {
        $email = trim((string) $request->input('email', ''));
        $password = (string) $request->input('password', '');

        $user = User::findByEmail($email);

        if ($user === null) {
            Session::flash('login_error', 'Invalid email or password.');
            $this->redirect('/admin/login');
            return;
        }

        if (!empty($user['locked_until']) && strtotime($user['locked_until']) > time()) {
            Session::flash('login_error', 'This account is temporarily locked. Try again later.');
            $this->redirect('/admin/login');
            return;
        }

        if (!password_verify($password, $user['password_hash'])) {
            $attempts = (int) $user['failed_attempts'] + 1;
            $lockedUntil = $attempts >= self::MAX_ATTEMPTS
                ? date('Y-m-d H:i:s', time() + self::LOCK_MINUTES * 60)
                : null;

            User::recordFailedAttempt((int) $user['id'], $attempts, $lockedUntil);

            Session::flash('login_error', 'Invalid email or password.');
            $this->redirect('/admin/login');
            return;
        }

        User::recordSuccessfulLogin((int) $user['id']);

        Session::regenerate();
        Session::set('admin_id', $user['id']);
        Session::set('admin_name', $user['name']);
        Session::set('admin_role', $user['role']);

        $this->redirect('/admin/dashboard');
    }

    public function logout(Request $request): void
    {
        Session::destroy();
        $this->redirect('/admin/login');
    }
}
