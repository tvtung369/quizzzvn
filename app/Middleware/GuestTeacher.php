<?php

namespace App\Middleware;

use App\Models\Teacher;
use Phplite\Cookie\Cookie;
use Phplite\Session\Session;

class GuestTeacher {
    public function handle() {
        $auth = Session::get('teacher') ? : Cookie::get('teacher');
        if($auth) {
            $teacher = Teacher::where('id', '=', $auth)->first();
            if($teacher) {
                return redirect(url('teacher/dashboard'));
            }
        }
    }
}