<?php

namespace App\Core;

interface MiddlewareInterface
{
    public function handle(Request $request, \Closure $next): mixed;
}
