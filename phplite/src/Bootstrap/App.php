<?php

namespace Phplite\Bootstrap;

use Phplite\Exceptions\Whoops;

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
        Whoops::handle();

        throw new \Exception("There is exception");
    }
}