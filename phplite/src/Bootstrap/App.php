<?php

namespace Phplite\Bootstrap;

use Phplite\Exceptions\Whoops;
use Phplite\Session\Session;
use Phplite\Cookie\Cookie;
use Phplite\Http\Server;

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

        echo Server::get('DOCUMENT_ROOT');
        // print_r(Server::all());

    }
}