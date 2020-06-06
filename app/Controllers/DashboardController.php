<?php

namespace App\Controllers;

use Phplite\Http\Response;
use Phplite\Url\Url;
use Phplite\View\View;

class DashboardController {
    public function index() {
        return View::render('admin/dashboard', ['name' => 'Tung', 'age' => 20]);
    }
}