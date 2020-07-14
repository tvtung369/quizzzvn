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
        $title = "Dashboard";
        $active = 'dashboard';
        return view('teacher.dashboard.index', ['title' => $title, 'active' => $active]);
    }
}