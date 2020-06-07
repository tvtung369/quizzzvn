<?php

namespace App\Controllers;

use Phplite\Database\Database;
use Phplite\Http\Response;
use Phplite\Url\Url;
use Phplite\View\View;

class DashboardController {
    public function index() {
        // $data = ['subject_name' => 'Tùng học'];
        // return Database::table('subjects')->where('subject_id', '=', 14)->delete();
        return View::render('admin/dashboard', ['name' => 'Tung', 'age' => 20]);
    }
}