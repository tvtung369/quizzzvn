<?php

namespace App\Controllers\Teacher;

use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Teacher;
use Phplite\Http\Request;
use Phplite\Session\Session;
use Phplite\Validation\Validate;

class ClassController {
    /**
     * Show list of class
     *
     * @return \Phplite\View\View
     */
    public function index() {
        $list = ClassModel::select('grades.grade_name, teachers.name as t_name', 'classes.*')
                        ->join('teachers', 'teachers.id', '=', 'classes.teacher_id')
                        ->join('grades', 'grades.id', '=', 'classes.grade_id')
                        ->get();
        // return "<pre>". var_dump($list) ."</pre>";
        $title = "Danh sách lớp học";
        $active = 'class';
        return view('teacher.classes.index', ['active' => $active, 'list' => $list, 'title' => $title]);
    }

    /**
     * Create new class
     *
     * @return \Phplite\View\View
     */
    public function create() {
        $title = 'Thêm mới lớp học';
        $listGrade = Grade::get();
        $listTeacher = Teacher::where('permission', '=', 2)->get();
        $active = 'class';
        return view('teacher.classes.detail', ['active'=> $active, 'title' => $title, 'listGrade' => $listGrade, 'listTeacher' => $listTeacher]);
    }

    /**
     * Store new class
     *
     * @return \Phplite\Url\Url
     */
    public function store() {
        Validate::validate([
            'name' => 'required|unique:classes,name',
            'grade_id' => 'required',
        ], false);

        $data = [
            'name' => Request::post('name'),
            'grade_id' => Request::post('grade_id'),
        ];

        $data = Request::post('teacher_id') ? array_merge($data, ['teacher_id' => Request::post('teacher_id')]) : $data;

        ClassModel::insert($data);

        Session::set('message', "Đã thêm thành công");
        return redirect(url('teacher-panel/classes'));
    }

    /**
     * Edit class by given id
     *
     * @param string $id
     * @return \Phplite\View\View
     */
    public function edit($id) {
        $class = ClassModel::where('id', '=', $id)->first();
        if(! $class) {
            Session::set('message', "Không tìm thấy lớp học này");
            return redirect(url('teacher-panel/classes'));
        }
        $title = "Chỉnh sửa ". $class->name;
        $listGrade = Grade::get();
        $listTeacher = Teacher::where('permission', '=', 2)->get();
        $active = 'class';
        return view('teacher.classes.detail', ['active' => $active, 'title' => $title, 'class' => $class, 'listGrade' => $listGrade, 'listTeacher' => $listTeacher]);
    }

    /**
     * Update class by given id
     *
     * @param string $id
     * @return void
     */
    public function update($id) {
        $class = ClassModel::where('id', '=', $id)->first();
        if(! $class) {
            Session::set('message', "Không tìm thấy lớp học này");
            return redirect(url('teacher-panel/classes'));
        }

        Validate::validate([
            'name' => 'required|unique:classes,name,'.$class->name,
            'grade_id' => 'required',
        ], false);

        $data = [
            'name' => Request::post('name'),
            'grade_id' => Request::post('grade_id'),
        ];

        $data = Request::post('teacher_id') ? array_merge($data, ['teacher_id' => Request::post('teacher_id')]) : $data;

        ClassModel::where('id', '=', $id)->update($data);
        Session::set('message', "Cập nhật thành công");
        return redirect(url('teacher-panel/classes'));
    }

    /**
     * Delete existing class
     *
     * @param string $id
     * @return \Phplite\Url\Url
     */
    public function delete($id) {
        $class = ClassModel::where('id', '=', $id)->first();
        if(! $class) {
            Session::set('message', "Không tìm thấy lớp học này");
            return redirect(url('teacher-panel/classes'));
        }

        ClassModel::where('id', '=', $id)->delete();
        Session::set('message', "Xóa thành công");
        return redirect(url('teacher-panel/classes'));
    }
}