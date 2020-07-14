<?php

namespace App\Controllers\Teacher;

use App\Models\Level;
use App\Models\Question;
use App\Models\Subject;
use Phplite\Http\Request;
use Phplite\Session\Session;
use Phplite\Validation\Validate;

class QuestionController {
    /**
     * Show list of question
     *
     * @return \Phplite\View\View
     */
    public function index() {
        $list = Question::select('questions.*', 'levels.name as l_name', 'subjects.subject_name', 'statuses.status_name')
                        ->join('levels', 'levels.id', '=', 'questions.level_id')
                        ->join('subjects', 'subjects.id', '=', 'questions.subject_id')
                        ->join('statuses', 'statuses.id', '=', 'questions.status_id')
                        ->get();
        // return "<pre>". var_dump($list) . "</pre>";
        $title = "Danh sách câu hỏi";
        $active = 'question';
        return view('teacher.questions.index', ['active' => $active, 'list' => $list, 'title' => $title]);
    }

    /**
     * Create new question
     *
     * @return \Phplite\View\View
     */
    public function create() {
        $title = 'Thêm câu hỏi';
        $listSubject = Subject::get();
        $listLevel = Level::get();
        $active = 'question';
        return view('teacher.questions.detail', ['active' => $active, 'title' => $title, 'listSubject' => $listSubject, 'listLevel' => $listLevel]);
    }

    /**
     * Store new question
     *
     * @return \Phplite\Url\Url
     */
    public function store() {
        Validate::validate([
            'subject_id' => 'required',
            'question_content' => 'required',
            'unit' => 'required|min:1|max:99',
            'level_id' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'correct_answer' => 'required',
        ], false);

        Question::insert([
            'subject_id' => Request::post('subject_id'),
            'question_content' => Request::post('question_content'),
            'unit' => Request::post('unit'),
            'level_id' => Request::post('level_id'),
            'answer_a' => Request::post('answer_a'),
            'answer_b' => Request::post('answer_b'),
            'answer_c' => Request::post('answer_c'),
            'answer_d' => Request::post('answer_d'),
            'correct_answer' => Request::post('correct_answer'),
            'created_by' => 'admin',
            'status_id' => 1,
        ]);

        Session::set('message', "Đã thêm thành công");
        return redirect(url('teacher-panel/questions'));
    }

    /**
     * Edit question by given id
     *
     * @param string $id
     * @return \Phplite\View\View
     */
    public function edit($id) {
        $question = Question::where('id', '=', $id)->first();
        if(! $question) {
            Session::set('message', "Không tìm thấy câu hỏi này");
            return redirect(url('teacher-panel/questions'));
        }
        $title = "Chỉnh sửa câu hỏi";
        $listSubject = Subject::get();
        $listLevel = Level::get();
        $active = 'question';
        return view('teacher.questions.detail', ['active' => $active, 'question' => $question, 'title' => $title, 'listSubject' => $listSubject, 'listLevel' => $listLevel]);
    }

    /**
     * Update question by given id
     *
     * @param string $id
     * @return void
     */
    public function update($id) {
        $question = Question::where('id', '=', $id)->first();
        if(! $question) {
            Session::set('message', "Không tìm thấy câu hỏi này");
            return redirect(url('teacher-panel/teachers'));
        }

        Validate::validate([
            'subject_id' => 'required',
            'question_content' => 'required',
            'unit' => 'required|min:1|max:99',
            'level_id' => 'required',
            'answer_a' => 'required',
            'answer_b' => 'required',
            'answer_c' => 'required',
            'answer_d' => 'required',
            'correct_answer' => 'required',
        ], false);

        $data = [
            'subject_id' => Request::post('subject_id'),
            'question_content' => Request::post('question_content'),
            'unit' => Request::post('unit'),
            'level_id' => Request::post('level_id'),
            'answer_a' => Request::post('answer_a'),
            'answer_b' => Request::post('answer_b'),
            'answer_c' => Request::post('answer_c'),
            'answer_d' => Request::post('answer_d'),
            'correct_answer' => Request::post('correct_answer'),
            'created_by' => 'admin',
            'status_id' => 1,
        ];

        Question::where('id', '=', $id)->update($data);
        Session::set('message', "Cập nhật thành công");
        return redirect(url('teacher-panel/questions'));
    }

    /**
     * Delete existing question
     *
     * @param string $id
     * @return \Phplite\Url\Url
     */
    public function delete($id) {
        $question = Question::where('id', '=', $id)->first();
        if(! $question) {
            Session::set('message', "Không tìm câu hỏi này");
            return redirect(url('teacher-panel/teachers'));
        }

        Question::where('id', '=', $id)->delete();
        Session::set('message', "Xóa thành công");
        return redirect(url('teacher-panel/questions'));
    }
}