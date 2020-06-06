<?php

namespace Phplite\Url;

use Phplite\Http\Request;
use Phplite\Http\Server;

class Url {
    /**
     * Url constructor
     *
     * @return void
     */
    private function __construt() {}

    /**
     * Get path
     *
     * @param string $path
     * @return string
     */
    public static function path($path) {
        return Request::baseUrl(). '/' . trim($path, '/');
    }

    /**
     * Previous url
     *
     * @return string
     */
    public static function previous() {
        return Server::get('HTTP_REFERER');
    }

    /**
     * Redirect to page
     *
     * @param string $path
     * @return void
     */
    public static function redirect($path) {
        header('location: ' . $path);
        exit();
    }
}