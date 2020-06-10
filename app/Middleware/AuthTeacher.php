<?php

namespace App\Middleware;

use App\Models\Teacher;
use Phplite\Cookie\Cookie;
use Phplite\Session\Session;

class AuthTeacher {
    public function handle() {
        $auth = Session::get('teachers') ? : Cookie::get('teachers');
        if(! $auth) {
            return redirect(url('teacher-panel/login'));
        }
        $teacher = Teacher::where('id', '=', $auth)->first();
        if(! $teacher) {
            return redirect(url('teacher-panel/login'));
        }
    }
}