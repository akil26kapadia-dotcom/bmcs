<?php

namespace App\Middleware;

use App\Core\Csrf;
use App\Core\MiddlewareInterface;
use App\Core\Request;
use App\Core\Session;
use App\Core\View;

class CsrfMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, \Closure $next): mixed
    {
        Session::start();

        if ($request->isPost() && !Csrf::verify($request->input('_csrf'))) {
            http_response_code(403);
            View::render('pages/403', ['title' => 'Forbidden']);
            return null;
        }

        return $next($request);
    }
}
