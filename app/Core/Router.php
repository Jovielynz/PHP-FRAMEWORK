<?php
namespace App\Core;

/**
 * Router - maps a URL + HTTP method to a Controller@action.
 *
 * Example:  $router->get('/products/{id}', 'ProductController@show');
 * The {id} part is captured and passed to the action as an argument.
 */
class Router
{
    private array $routes = [];       // [ ['GET', '/products/{id}', 'ProductController@show', [middlewares]] ]
    private array $middlewares = [];  // global middlewares run on every request

    public function get(string $path, string $handler, array $middleware = []): void
    {
        $this->add('GET', $path, $handler, $middleware);
    }

    public function post(string $path, string $handler, array $middleware = []): void
    {
        $this->add('POST', $path, $handler, $middleware);
    }

    private function add(string $method, string $path, string $handler, array $middleware): void
    {
        $this->routes[] = [$method, $path, $handler, $middleware];
    }

    /** Register a middleware that runs for every request. */
    public function use(string $middlewareClass): void
    {
        $this->middlewares[] = $middlewareClass;
    }

    public function dispatch(Request $request): void
    {
        $method = $request->method();
        $path   = $request->path();

        // 1. Run global middlewares
        foreach ($this->middlewares as $mw) {
            (new $mw())->handle($request);
        }

        // 2. Find a matching route
        foreach ($this->routes as [$routeMethod, $routePath, $handler, $routeMiddleware]) {
            if ($routeMethod !== $method) {
                continue;
            }

            // Turn "/products/{id}" into a regex "#^/products/([^/]+)$#"
            $pattern = '#^' . preg_replace('#\{[a-zA-Z_]+\}#', '([^/]+)', $routePath) . '$#';

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches); // remove full match, keep captured params

                // 3. Run route-specific middlewares (e.g. AuthMiddleware)
                foreach ($routeMiddleware as $mw) {
                    (new $mw())->handle($request);
                }

                // 4. Call Controller@action
                [$controller, $action] = explode('@', $handler);
                $class = 'App\\Controllers\\' . $controller;
                $instance = new $class($request);
                $instance->$action(...$matches);
                return;
            }
        }

        Response::notFound();
    }
}
