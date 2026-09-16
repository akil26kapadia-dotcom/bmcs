<?php

namespace App\Core;

class Router
{
    /** @var array<string, array<int, array{pattern: string, params: string[], handler: mixed, middleware: string[]}>> */
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    private string $groupPrefix = '';
    /** @var string[] */
    private array $groupMiddleware = [];
    private ?\Closure $notFoundHandler = null;

    /**
     * Lets the app layer plug in extra "no route matched" handling (e.g.
     * checking a DB-backed redirect map) without Router depending on
     * App\Models directly. Called with the request path (no leading slash);
     * return true if it fully handled the response (e.g. sent a redirect).
     */
    public function setNotFoundHandler(\Closure $handler): void
    {
        $this->notFoundHandler = $handler;
    }

    public function get(string $path, mixed $handler, array $middleware = []): void
    {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(string $path, mixed $handler, array $middleware = []): void
    {
        $this->add('POST', $path, $handler, $middleware);
    }

    /**
     * Groups routes under a shared path prefix and middleware stack,
     * e.g. $router->group('/admin', [AuthMiddleware::class], function ($router) { ... }).
     */
    public function group(string $prefix, array $middleware, \Closure $callback): void
    {
        $previousPrefix = $this->groupPrefix;
        $previousMiddleware = $this->groupMiddleware;

        $this->groupPrefix = $previousPrefix . $prefix;
        $this->groupMiddleware = array_merge($previousMiddleware, $middleware);

        $callback($this);

        $this->groupPrefix = $previousPrefix;
        $this->groupMiddleware = $previousMiddleware;
    }

    private function add(string $method, string $path, mixed $handler, array $middleware): void
    {
        $fullPath = rtrim($this->groupPrefix, '/') . '/' . ltrim($path, '/');

        $paramNames = [];
        $pattern = preg_replace_callback('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', function ($matches) use (&$paramNames) {
            $paramNames[] = $matches[1];
            return '([^/]+)';
        }, trim($fullPath, '/'));

        $this->routes[$method][] = [
            'pattern' => '#^' . $pattern . '$#',
            'params' => $paramNames,
            'handler' => $handler,
            'middleware' => array_merge($this->groupMiddleware, $middleware),
        ];
    }

    public function dispatch(string $method, string $uri): void
    {
        $path = trim(parse_url($uri, PHP_URL_PATH) ?? '/', '/');

        foreach ($this->routes[$method] ?? [] as $route) {
            if (preg_match($route['pattern'], $path, $matches)) {
                array_shift($matches);
                $params = array_combine($route['params'], $matches);
                $request = new Request($params);

                $pipeline = $this->buildPipeline($route['middleware'], $route['handler'], $params);
                $pipeline($request);
                return;
            }
        }

        if ($this->notFoundHandler !== null && ($this->notFoundHandler)($path)) {
            return;
        }

        http_response_code(404);
        View::render('pages/404', ['title' => 'Page Not Found']);
    }

    private function buildPipeline(array $middleware, mixed $handler, array $params): \Closure
    {
        $destination = function (Request $request) use ($handler, $params) {
            if (is_array($handler)) {
                [$controllerClass, $action] = $handler;
                $controller = new $controllerClass();
                return $controller->$action($request, $params);
            }

            return $handler($params, $request);
        };

        foreach (array_reverse($middleware) as $middlewareClass) {
            $next = $destination;
            $destination = function (Request $request) use ($middlewareClass, $next) {
                $instance = new $middlewareClass();
                return $instance->handle($request, $next);
            };
        }

        return $destination;
    }
}
