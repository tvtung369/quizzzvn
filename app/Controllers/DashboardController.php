<?php

namespace App\Controllers;

use Phplite\Http\Response;
use Phplite\Url\Url;

class DashboardController {
    public function index() {
        return Url::previous();
    }
}