<?php

namespace Phplite\Bootstrap;

use Phplite\Exceptions\Whoops;
use Phplite\Session\Session;
use Phplite\Cookie\Cookie;
use Phplite\Http\Server;
use Phplite\Http\Request;

class App {
    /**
     * App constructor
     * 
     */
    private function __construct() {

    }

    /**
     * Run the application
     *
     * @return void
     */
    public static function run() {
        // Register whoops
        Whoops::handle();

        // Start session
        Session::start();

        // Handle the request
        Request::handle();

        // echo Server::get('HTTP_REFERER'); die();

        echo "<pre>";
        print_r(Request::all());
        echo "</pre>";
    }
}