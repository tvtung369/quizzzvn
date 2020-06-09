<?php

namespace App\Controllers\Teacher;

use Phplite\Database\Database;
use Phplite\Http\Response;
use Phplite\Url\Url;
use Phplite\View\View;

class DashboardController {
    /**
     * Dashboard page
     * 
     * @return \Phplite\View\View
     */
    public function index() {
        return auth('teachers')->username;
    }
}