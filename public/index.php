<?php

declare(strict_types=1);

use App\Core\Env;
use App\Core\ErrorHandler;
use App\Core\Router;
use App\Core\Session;
use App\Models\Redirect;

// When run via `php -S host:port -t public public/index.php` (needed so the
// dev server routes extensioned paths like /sitemap.xml through the app),
// let the built-in server serve real static files directly instead of
// passing them through the app router, which has no route for them.
if (PHP_SAPI === 'cli-server') {
    $requestedFile = __DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($requestedFile !== __DIR__ . '/' && is_file($requestedFile)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

Env::load(__DIR__ . '/../.env');

$debug = Env::get('APP_DEBUG', 'false') === 'true';

error_reporting(E_ALL);
ini_set('display_errors', '0'); // errors always go through ErrorHandler, never raw to output
ErrorHandler::register($debug);

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Strict CSP: every script/style/font on this site is self-hosted (no CDNs,
// no inline scripts/styles — see the Phase-8 audit that removed the last
// remaining inline <script> and style="" usages). blob: is required for the
// admin featured-image preview (URL.createObjectURL). Update this if a
// future integration (e.g. Google Analytics) needs an external script host.
header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' blob: data:; font-src 'self'; connect-src 'self'; object-src 'none'; base-uri 'self'; form-action 'self'; frame-ancestors 'self'");

Session::start();

$router = new Router();
(require __DIR__ . '/../routes/web.php')($router);

// Preserves search visibility for old bmcs.ae URLs (see database/seeders/seed_redirects.php).
// Only ever redirects to a stored, same-site relative path — never to arbitrary
// user input — so this can't be used as an open redirect.
$router->setNotFoundHandler(function (string $path): bool {
    try {
        $redirect = Redirect::findByOldPath('/' . $path);
    } catch (\Throwable $e) {
        return false; // DB unavailable — fall through to a normal 404 rather than error
    }

    if ($redirect === null || !str_starts_with($redirect['new_path'], '/')) {
        return false;
    }

    http_response_code((int) $redirect['status_code']);
    header('Location: ' . $redirect['new_path']);
    return true;
});

$router->dispatch(
    $_SERVER['REQUEST_METHOD'] ?? 'GET',
    $_SERVER['REQUEST_URI'] ?? '/'
);
