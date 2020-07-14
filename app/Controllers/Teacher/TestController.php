<?php

namespace App\Controllers\Teacher;

use App\Models\Question;
use App\Models\QuestionOfTest;
use App\Models\Subject;
use App\Models\Test;
use Exception;
use Phplite\Url\Url;
use Phplite\Http\Request;
use Phplite\Http\Response;
use Phplite\Session\Session;
use Phplite\Validation\Validate;

class TestController {
    /**
     * Show list of tests
     *
     * @return \Phplite\View\View
     */
    public function index() {
        $active = 'test';
        $title = 'Danh sách bài kiểm tra';
        $testList = Test::select()
                    ->join('subjects', 'tests.subject_id', '=', 'subjects.id')
                    ->get();
        return view('teacher.tests.index', ['active' => $active, 'title' => $title, 'testList' => $testList]);
    }

    /**
     * Create new test
     *
     * @return \Phplite\View\View
     */
    public function create() {
        Session::set('questionListOfTest', []);

        $title = 'Tạo bài kiểm tra';
        $active = 'test';
        $subjectList = Subject::get();
        return view('teacher.tests.detail', ['active' => $active, 'title' => $title, 'subjectList' => $subjectList]);
    }

    /**
     * Store a new tests
     *
     * @return \Phplite\Url\Url
     */
    public function store() {
        Validate::validate([
            'test_name' => 'required',
            'subject_id' => 'required|numeric',
            'time_to_do' => 'required|numeric',
        ], false);
        
        if(count(session('questionListOfTest')) == 0) {
            Session::set('message', "Bài kiểm tra chưa có câu hỏi nào.");
            Session::set('old', Request::all());
            return redirect(URL::previous());
        }

        $data = [
            'test_name' => Request::post('test_name'),
            'subject_id' => Request::post('subject_id'),
            'total_questions' => count(session('questionListOfTest')),
            'time_to_do' => Request::post('time_to_do'),
            'status_id' => 1,
        ];
        $data = Request::post('note') ? array_merge($data, ['note' => Request::post('note')]) : $data;

        try {
            $test = Test::insert($data);
            foreach (session('questionListOfTest') as $value) {
                QuestionOfTest::insert([
                    'test_id' => (int) $test->id,
                    'question_id' => (int) $value->id
                ]);
            }

        } catch(Exception $e) {
            Session::set('message', "Đã xảy ra lỗi, vui lòng thử lại!");
            Session::set('level', "error");
            return redirect(url('teacher-panel/tests'));
        }

        Session::set('message', "Bài kiểm tra đã được thêm");
        Session::set('level', "success");
        return redirect(url('teacher-panel/tests'));
    }

    /*
    |-----------------------------------
    | AJAX
    |-----------------------------------
    |
    |
    /*

    /**
     * Get unit list of subject (AJAX)
     *
     * @return json
     */
    public static function getUnitListOfSubject() {
        $validation = Validate::validate([
            'subject_id' => 'required|numeric',
        ], true);

        if($validation) {
            return $validation;
        }

        $unitList = Question::select('unit', 'COUNT(unit) as total')
                            ->where('subject_id', '=', Request::post('subject_id'))
                            ->groupBy('unit')
                            ->get();
        return Response::json(['unitList' => $unitList]);
    }

    /**
     * Get level list of unit (AJAX)
     *
     * @return json
     */
    public function getLevelListOfUnit() {
        $validation = Validate::validate([
            'subject_id' => 'required|numeric',
            'unit' => 'required|numeric',
        ], true);

        if($validation) {
            return $validation;
        }
        $levelList = Question::select('levels.name as l_name', 'questions.level_id', 'COUNT(questions.level_id) as total', 'unit')
                            ->join('levels', 'levels.id', '=', 'questions.level_id')
                            ->where('subject_id', '=', Request::post('subject_id'))
                            ->where('unit', '=', Request::post('unit'))
                            ->groupBy('questions.level_id')
                            ->orderBy('level_id')
                            ->get();
        return Response::json(['levelList' => $levelList]);
    }

    /**
     * Get question list of test
     *
     * @return json
     */
    public function getQuestionListOfTest() {
        return Response::json(session('questionListOfTest'));
    }

    /**
     * Generator radom a question list of test given by unit_it & level_id & subject_id (AJAX)
     *
     * @return json
     */
    public function getQuestionListOfTestByCriteria() {
        $limitArray = Request::all();

        Session::set('questionListOfTest', []);

        foreach ($limitArray as $key => $value) {
            $limitArray[$key] = [
                'subject_id' => (int) explode("/", str_replace(["_unit_","_level_"], "/", $key))[0],
                'unit' => (int) explode("/", str_replace(["_unit_","_level_"], "/", $key))[1],
                'level' => (int) explode("/", str_replace(["_unit_","_level_"], "/", $key))[2],
                'limit' => (int) $value,
            ];
            $questions = Question::select('questions.*', 'levels.name as l_name')
                                ->join('levels', 'questions.level_id', '=', 'levels.id')
                                ->where('subject_id', '=', $limitArray[$key]['subject_id'])
                                ->where('unit', '=', $limitArray[$key]['unit'])
                                ->where('level_id', '=', $limitArray[$key]['level'])
                                ->orderBy('', 'rand()')
                                ->limit($limitArray[$key]['limit'])
                                ->get();
            Session::set('questionListOfTest', $questions ? array_merge(session('questionListOfTest'), $questions) : session('questionListOfTest'));
        }
        return Response::json(['questionListOfTest' => session('questionListOfTest')]);
    }

    /**
     * Delete question of test (AJAX)
     *
     * @return json
     */
    public function deleteQuestionOfTest() {
        $subjectId = Request::post('question_id');
        $questionListOfTest = session('questionListOfTest');
        foreach ($questionListOfTest as $key => $value) {
            if($value->id == $subjectId) {
                array_splice($questionListOfTest, $key, 1);
                Session::set('questionListOfTest', $questionListOfTest);
                return Response::json(['questionListOfTest' => session('questionListOfTest')]);
            }
        }
        return Response::json(['error' => 'Lỗi']);
    }
}