<?php

namespace Phplite\Bootstrap;

use Phplite\Exceptions\Whoops;
use Phplite\Session\Session;
use Phplite\Cookie\Cookie;

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

    }
}