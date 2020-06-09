<?php

namespace App\Controllers\Teacher;

use App\Models\Teacher;
use Phplite\Cookie\Cookie;
use Phplite\Http\Request;
use Phplite\Session\Session;
use Phplite\Url\Url;
use Phplite\Validation\Validate;

class AuthController {
    /**
     * Teacher login page
     * 
     * @return \Phplite\View\View
     */
    public function index() {
        $title = "Teacher login";
        return view('teacher.auth.login', ['title' => $title]);
    }

    /**
     * Teacher login
     *
     * @return \Phplite\Url\Url
     */
    public function submit() {
        Validate::validate([
            'username' => 'required|min:5|max:191',
            'password' => 'required|min:6|max:191',
            'remember' => 'in:on',
        ], false);

        $admin = Teacher::where('username', '=', Request::post('username'))->first();
        if(! $admin) {
            Session::set('message', 'Tên đăng nhập không tồn tại');
            Session::set('old', Request::all());
            return redirect(Url::previous());
        }

        if(! password_verify(Request::post('password'), $admin->password)) {
            Session::set('message', 'Mật khẩu đăng nhập không đúng');
            return redirect(Url::previous());
        }

        Request::post('remember') == 'on' ? Cookie::set('teachers', $admin->id) : Session::set('teachers', $admin->id);

        return redirect(url('teacher-panel/dashboard'));
    }

    /**
     * Logout teacher
     *
     * @return \Phplite\Url\Url
     */
    public function logout() {
        Cookie::remove('teachers');
        Session::remove('teachers');

        return redirect(url('teacher-panel/login'));
    }
}

