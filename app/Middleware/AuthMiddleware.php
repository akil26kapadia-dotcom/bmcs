<?php

namespace App\Middleware;

use App\Core\MiddlewareInterface;
use App\Core\Request;
use App\Core\Session;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, \Closure $next): mixed
    {
        Session::start();

        if (!Session::has('admin_id')) {
            header('Location: /admin/login');
            exit;
        }

        return $next($request);
    }
}
