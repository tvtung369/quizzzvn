<?php

namespace App\Middleware;

class Owner {
    public function handle() {
        if(1 == 1) {
            die('Error in middleware');
        }
    }
}