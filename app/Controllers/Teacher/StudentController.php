<?php

namespace App\Controllers\Teacher;

use App\Models\ClassModel;
use App\Models\Student;
use Phplite\Http\Request;
use Phplite\Session\Session;
use Phplite\Validation\Validate;

class StudentController {
    /**
     * Show list of student
     *
     * @return \Phplite\View\View
     */
    public function index() {
        $list = Student::select('students.*', 'classes.name as c_name')->join('classes', 'students.class_id', '=', 'classes.id')->get();
        $title = "Danh sách học sinh";
        $active = "student";
        return view('teacher.students.index', ['list' => $list, 'title' => $title, 'active' => $active]);
    }

    /**
     * Create new student
     *
     * @return \Phplite\View\View
     */
    public function create() {
        $title = 'Thêm mới học sinh';
        $listClass = ClassModel::get();
        $active = "student";
        return view('teacher.students.detail', ['title' => $title, 'listClass' => $listClass, 'active' => $active]);
    }

    /**
     * Store new student
     *
     * @return \Phplite\Url\Url
     */
    public function store() {
        Validate::validate([
            'name' => 'required',
            'email' => 'email|unique:students,email',
            'username' => 'required|min:5|max:30|unique:students,username',
            'password' => 'required|min:8',
            'class_id' => 'required',
        ], false);

        Student::insert([
            'username' => Request::post('username'),
            'email' => Request::post('email'),
            'name' => Request::post('name'),
            'class_id' => Request::post('class_id'),
            'gender' => Request::post('gender'),
            'birthday' => Request::post('birthday'),
            'password' => password_hash(Request::post('password'), PASSWORD_BCRYPT),
            'address' => Request::post('address')
        ]);

        Session::set('message', "Đã thêm thành công");
        return redirect(url('teacher-panel/students'));
    }

    /**
     * Edit student by given id
     *
     * @param string $id
     * @return \Phplite\View\View
     */
    public function edit($id) {
        $student = Student::where('id', '=', $id)->first();
        if(! $student) {
            Session::set('message', "Không tìm thấy học sinh này");
            return redirect(url('teacher-panel/students'));
        }
        $title = "Chỉnh sửa ". $student->name;
        $listClass = ClassModel::get();
        $active = "student";
        return view('teacher.students.detail', ['active' => $active, 'student' => $student, 'title' => $title, 'listClass' => $listClass]);
    }

    /**
     * Update teacher by given id
     *
     * @param string $id
     * @return void
     */
    public function update($id) {
        $student = Student::where('id', '=', $id)->first();
        if(! $student) {
            Session::set('message', "Không tìm thấy học sinh này");
            return redirect(url('teacher-panel/students'));
        }

        Validate::validate([
            'name' => 'required',
            'email' => 'email|unique:teachers,email,'.$student->email,
            'username' => 'required|min:5|max:30|unique:teachers,username,'.$student->username,
            'class_id' => 'required',
        ], false);

        $data = [
            'username' => Request::post('username'),
            'email' => Request::post('email'),
            'name' => Request::post('name'),
            'class_id' => Request::post('class_id'),
            'gender' => Request::post('gender'),
            'birthday' => Request::post('birthday'),
            'address' => Request::post('address')
        ];

        Student::where('id', '=', $id)->update($data);
        Session::set('message', "Cập nhật thành công");
        return redirect(url('teacher-panel/students'));
    }

    /**
     * Delete existing student
     *
     * @param string $id
     * @return \Phplite\Url\Url
     */
    public function delete($id) {
        $student = Student::where('id', '=', $id)->first();
        if(! $student) {
            Session::set('message', "Không tìm thấy giáo viên này");
            return redirect(url('teacher-panel/students'));
        }

        Student::where('id', '=', $id)->delete();
        Session::set('message', "Xóa thành công");
        return redirect(url('teacher-panel/students'));
    }
}