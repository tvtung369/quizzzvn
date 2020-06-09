<?php

/**
 * View render
 * 
 * @param string $path
 * @param array $data
 * @return miexed
 */
if(! function_exists('view')) {
    function view($path, $data = []) {
        return \Phplite\View\View::render($path, $data);
    }
}

/**
 * Redirect
 * 
 * @param string $path
 * @return mixed
 */
if(! function_exists('redirect')) {
    function redirect($path) {
        return \Phplite\Url\Url::redirect($path);
    }
}

/**
 * Url path
 * 
 * @param string $path
 * @return mixed
 */
if(! function_exists('url')) {
    function url($path) {
        return \Phplite\Url\Url::path($path);
    }
}

/**
 * Asset path
 *
 * @param string $path
 * @return mixed
 */
if (! function_exists('asset')) {
    function asset($path) {
        return \Phplite\Url\Url::path($path);
    }
}

/**
 * Get session data
 * 
 * @param string $key
 * @return string $data
 */
if(! function_exists('session')) {
    function session($key) {
        return \Phplite\Session\Session::get($key);
    }
}

/**
 * Get session flash data
 * 
 * @param string $key
 * @return string $data
 */
if(! function_exists('flash')) {
    function flash($key) {
        return \Phplite\Session\Session::flash($key);
    }
}

/**
 * Table auth
 *
 * @param string $table
 * @return string
 */
if (! function_exists('auth')) {
    function auth($table) {
        $auth = Phplite\Session\Session::get($table) ?: Phplite\Cookie\Cookie::get($table);
        return \Phplite\Database\Database::table($table)->where('id', '=', $auth)->first();
    }
}