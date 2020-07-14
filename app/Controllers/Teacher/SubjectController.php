<?php

namespace App\Controllers\Teacher;

use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Subject;
use Phplite\Http\Request;
use Phplite\Session\Session;
use Phplite\Validation\Validate;

class SubjectController {
    /**
     * Show list of subject
     *
     * @return \Phplite\View\View
     */
    public function index() {
        $list = Subject::select('subjects.*', 'grades.grade_name')
                        ->leftjoin('grades','grades.id', '=', 'subjects.grade_id')
                        ->get();
        $title = "Danh sách môn học";
        $active = 'subject';
        return view('teacher.subjects.index', ['active' => $active, 'list' => $list, 'title' => $title]);
    }

    /**
     * Create new subject
     *
     * @return \Phplite\View\View
     */
    public function create() {
        $title = 'Thêm mới môn học';
        $listGrade = Grade::get();
        $active = 'subject';
        return view('teacher.subjects.detail', ['active' => $active, 'title' => $title, 'listGrade' => $listGrade]);
    }

    /**
     * Store new subject
     *
     * @return \Phplite\Url\Url
     */
    public function store() {
        Validate::validate([
            'subject_name' => 'required|unique:subjects,subject_name',
        ], false);

        $data = [
            'subject_name' => Request::post('subject_name'),
        ];
        $data = Request::post('grade_id') ? array_merge($data,['grade_id' => Request::post('grade_id')]) : $data;

        Subject::insert($data);

        Session::set('message', "Đã thêm thành công");
        return redirect(url('teacher-panel/subjects'));
    }

    /**
     * Edit subject by given id
     *
     * @param string $id
     * @return \Phplite\View\View
     */
    public function edit($id) {
        $subject = Subject::where('id', '=', $id)->first();
        if(! $subject) {
            Session::set('message', "Không tìm thấy môn học này");
            return redirect(url('teacher-panel/classes'));
        }
        $title = "Chỉnh sửa ". $subject->subject_name;
        $listGrade = Grade::get();
        $active = 'subject';
        return view('teacher.subjects.detail', ['active' => $active, 'title' => $title, 'listGrade' => $listGrade, 'subject' => $subject]);
    }

    /**
     * Update subject by given id
     *
     * @param string $id
     * @return void
     */
    public function update($id) {
        $subject = Subject::where('id', '=', $id)->first();
        if(! $subject) {
            Session::set('message', "Không tìm thấy môn học này");
            return redirect(url('teacher-panel/subjects'));
        }

        Validate::validate([
            'subject_name' => 'required|unique:subjects,subject_name,'.$subject->subject_name,
        ], false);

        $data = [
            'subject_name' => Request::post('subject_name'),
        ];
        $data = Request::post('grade_id') ? array_merge($data,['grade_id' => Request::post('grade_id')]) : $data;

        Subject::where('id', '=', $id)->update($data);
        Session::set('message', "Cập nhật thành công");
        return redirect(url('teacher-panel/subjects'));
    }

    /**
     * Delete existing subject
     *
     * @param string $id
     * @return \Phplite\Url\Url
     */
    public function delete($id) {
        $subject = Subject::where('id', '=', $id)->first();
        if(! $subject) {
            Session::set('message', "Không tìm thấy môn học này");
            return redirect(url('teacher-panel/subjects'));
        }

        Subject::where('id', '=', $id)->delete();
        Session::set('message', "Xóa thành công");
        return redirect(url('teacher-panel/subjects'));
    }
}