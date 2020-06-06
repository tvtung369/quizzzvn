<?php

namespace Phplite\Bootstrap;

use Phplite\Exceptions\Whoops;
use Phplite\Session\Session;
use Phplite\Cookie\Cookie;
use Phplite\Http\Server;
use Phplite\Http\Request;
use Phplite\Http\Response;
use Phplite\Router\Route;

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

        include './../routes/web.php';

        // Handle the route
        $data = Route::handle();

        Response::output($data);
    }
}