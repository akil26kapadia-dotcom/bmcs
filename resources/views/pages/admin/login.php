<?php

use App\Core\Csrf;
use App\Core\View;

$error = $error ?? null;
?>
<div class="w-full max-w-sm hero-grid relative">
    <div class="relative bg-white rounded-2xl shadow-premium p-8">
        <div class="flex items-center gap-3 justify-center mb-6">
            <img src="/assets/images/logo-placeholder.svg" alt="BMCS" width="40" height="40" class="h-10 w-10">
            <span class="font-bold text-navy-950 tracking-tight">BRIGHT MIND</span>
        </div>
        <h1 class="text-lg font-semibold text-navy-950 text-center">Admin Login</h1>
        <p class="mt-1 text-sm text-ink-500 text-center">Sign in to manage the BMCS website.</p>

        <?php if ($error): ?>
            <div class="mt-5 rounded-lg bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm">
                <?= View::e($error) ?>
            </div>
        <?php endif; ?>

        <form action="/admin/login" method="POST" class="mt-6 space-y-4">
            <?= Csrf::field() ?>
            <div>
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" required autofocus class="form-input">
            </div>
            <div>
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" required class="form-input">
            </div>
            <button type="submit" class="btn-primary w-full justify-center">Sign In</button>
        </form>
    </div>
</div>