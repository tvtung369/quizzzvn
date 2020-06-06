<?php

namespace Phplite\Router;

use Phplite\Http\Request;

class Route {
    /**
     * Route container
     *
     * @var array $routes
     */
    private static $routes = [];

    /**
     * Middleware
     *
     * @var string $middleware
     */
    private static $middleware;

    /**
     * Prefix
     *
     * @var string $prefix
     */
    private static $prefix;

    /**
     * Route constructor
     */
    private function __construct() {}

    /**
     * Add route
     *
     * @param string $method
     * @param string $uri
     * @param object|callback $callback
     * @return void
     */
    private static function add($method, $uri, $callback) {
        $uri = rtrim(static::$prefix. '/' .trim($uri, '/'), '/');
        $uri = $uri ? : '/';
        foreach (explode('|', $method) as $method) {
            static::$routes[] = [
                'uri' => $uri,
                'callback' => $callback,
                'method' => $method,
                'middleware' => static::$middleware,
            ];
        }
    }

    /**
     * Add new get route
     *
     * @param string $uri
     * @param object|callback $callback
     * @return void
     */
    public static function get($uri, $callback) {
        static::add('GET', $uri, $callback);

    }

    /**
     * Add new post route
     *
     * @param strkng $uri
     * @param object|callback $callback
     * @return void
     */
    public static function post($uri, $callback) {
        static::add('POST', $uri, $callback);
    }

    /**
     * Add any get route
     *
     * @param string $uri
     * @param object|callback $callback
     * @return void
     */
    public static function any($uri, $callback) {
        static::add('GET|POST', $uri, $callback);
    }

    /**
     * Set prefix for routing
     *
     * @param string $prefix
     * @param callback $callback
     */
    public static function prefix($prefix, $callback) {
        $parent_prefix = static::$prefix;
        static::$prefix .= '/'.trim($prefix, '/');
        if(is_callable($callback)) {
            call_user_func($callback);
        } else {
            throw new \Exception("Please provide valid callback function");
        }

        static::$prefix = $parent_prefix;
    }

    /**
     * Set middleware for routing
     *
     * @param string $middleware
     * @param callback $callback
     */
    public static function middleware($middleware, $callback) {
        $parent_middleware = static::$middleware;
        static::$middleware .= '|'.trim($middleware, '|');
        if(is_callable($callback)) {
            call_user_func($callback);
        } else {
            throw new \BadFunctionCallException("Please provide valid callback function");
        }

        static::$middleware = $parent_middleware;
    }

    public static function handle() {
        $uri = Request::url();

        foreach(static::$routes as $route) {
            $matched = true;
            $route['uri'] = preg_replace('/\/{(.*?)}/', '/(.*?)', $route['uri']);
            $route['uri'] = '#^'. $route['uri'] . '$#';
            if(preg_match($route['uri'], $uri, $matches)) {
                array_shift($matches);
                $params = array_values($matches);

                foreach ($params as $param) {
                    if(strpos($param, '/')) {
                        $matched = false;
                    }
                }
                if ($route['method'] != Request::method()) {
                    $matched = false;
                }
                if ($matched == true) {
                    return static::invoke($route, $params);
                }
            }
        }

        die('Not found page');
    }

    /**
     * Invoke the route
     *
     * @param array $route
     * @param array $params
     * @return void
     */
    public static function invoke($route, $params = []) {
        static::excuteMiddleware($route);
        $callback = $route['callback'];
        if(is_callable($callback)) {
            call_user_func_array($callback, $params);
        } else if (strpos($callback, '@') !== false) {
            list($controller, $method) = explode('@', $callback);
            $controller = 'App\Controllers\\' . $controller;
            if(class_exists($controller)) {
                $object = new $controller;
                if(method_exists($object, $method)) {
                    return call_user_func_array([$object, $method], $params);
                }
                else {
                    throw new \BadFunctionCallException("The method ".$method." is not exists at " . $controller);
                }
            }
            else {
                throw new \ReflectionException("Class ". $controller ." is not found");
            }
        } else {
            throw new \InvalidArgumentException("Please provide valid callback function");
        }
    }

    /**
     * Excute middleware
     *
     * @param array route
     * @return void
     */
    public static function excuteMiddleware($route) {
        foreach(explode('|', $route['middleware']) as $middleware) {
            if($middleware != '') {
                $middleware = 'App\Middleware\\'. $middleware;
                if(class_exists($middleware)) {
                    $object = new $middleware;
                    call_user_func_array([$object, 'handle'], []);
                } else {
                    throw new \ReflectionException("Class ". $middleware ." is not found");
                }
            }
        }
    }

    public static function allRoutes() {
        return static::$routes;
    }
}