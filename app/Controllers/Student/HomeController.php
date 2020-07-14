<?php

namespace App\Controllers\Student;

class HomeController {
    /**
     * Home page
     * 
     * @return \Phplite\View\View
     */
    public function index() {
        $title = "Thi trắc nghiệm";
        return view('student.home.index', ['title' => $title]);
    }
}