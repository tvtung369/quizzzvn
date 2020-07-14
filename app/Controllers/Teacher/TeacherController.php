<?php

namespace App\Controllers\Teacher;

use App\Models\Teacher;
use Phplite\Http\Request;
use Phplite\Session\Session;
use Phplite\Validation\Validate;

class TeacherController {
    /**
     * Show list of teachers
     *
     * @return \Phplite\View\View
     */
    public function index() {
        $list = Teacher::where('id', '!=', 1)->get();
        $title = "Danh sách giáo viên";
        $active = 'teacher';
        return view('teacher.teachers.index', ['active' => $active, 'list' => $list, 'title' => $title]);
    }

    /**
     * Create new teacher
     *
     * @return \Phplite\View\View
     */
    public function create() {
        $title = 'Thêm mới giáo viên';
        $active = 'teacher';
        return view('teacher.teachers.detail', ['active' => $active, 'title' => $title]);
    }

    /**
     * Store new teacher
     *
     * @return \Phplite\Url\Url
     */
    public function store() {
        Validate::validate([
            'name' => 'required',
            'email' => 'email|unique:teachers,email',
            'username' => 'required|min:5|max:30|unique:teachers,username',
            'password' => 'required|min:8',
        ], false);

        Teacher::insert([
            'username' => Request::post('username'),
            'email' => Request::post('email'),
            'name' => Request::post('name'),
            'permission' => 2,
            'gender' => Request::post('gender'),
            'birthday' => Request::post('birthday'),
            'password' => password_hash(Request::post('password'), PASSWORD_BCRYPT),
            'address' => Request::post('address')
        ]);

        Session::set('message', "Đã thêm thành công");
        return redirect(url('teacher-panel/teachers'));
    }

    /**
     * Edit teacher by given id
     *
     * @param string $id
     * @return \Phplite\View\View
     */
    public function edit($id) {
        $teacher = Teacher::where('id', '=', $id)->first();
        if(! $teacher) {
            Session::set('message', "Không tìm thấy giáo viên này");
            return redirect(url('teacher-panel/teachers'));
        }
        $title = "Chỉnh sửa ". $teacher->name;
        $active = 'teacher';
        return view('teacher.teachers.detail', ['active' => $active, 'teacher' => $teacher, 'title' => $title]);
    }

    /**
     * Update teacher by given id
     *
     * @param string $id
     * @return void
     */
    public function update($id) {
        $teacher = Teacher::where('id', '=', $id)->first();
        if(! $teacher) {
            Session::set('message', "Không tìm thấy giáo viên này");
            return redirect(url('teacher-panel/teachers'));
        }

        Validate::validate([
            'name' => 'required',
            'email' => 'email|unique:teachers,email,'.$teacher->email,
            'username' => 'required|min:5|max:30|unique:teachers,username,'.$teacher->username,
        ], false);

        $data = [
            'username' => Request::post('username'),
            'email' => Request::post('email'),
            'name' => Request::post('name'),
            'gender' => Request::post('gender'),
            'birthday' => Request::post('birthday'),
            'address' => Request::post('address')
        ];

        Teacher::where('id', '=', $id)->update($data);
        Session::set('message', "Cập nhật thành công");
        return redirect(url('teacher-panel/teachers'));
    }

    /**
     * Delete existing teacher
     *
     * @param string $id
     * @return \Phplite\Url\Url
     */
    public function delete($id) {
        $teacher = Teacher::where('id', '=', $id)->first();
        if(! $teacher) {
            Session::set('message', "Không tìm thấy giáo viên này");
            return redirect(url('teacher-panel/teachers'));
        }

        Teacher::where('id', '=', $id)->delete();
        Session::set('message', "Xóa thành công");
        return redirect(url('teacher-panel/teachers'));
    }
}