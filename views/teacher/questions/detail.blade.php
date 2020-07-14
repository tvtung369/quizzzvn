@extends('teacher.layouts.layout', ['active' => $active])

@section('css')
@endsection

@section('js')

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper" style="display: flex; justify-content: space-between;">
            <h1>Quản lý ngân hàng câu hỏi</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('teacher-panel/dashboard') }}">
                            <span class="mdi mdi-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Câu hỏi</li>
                </ol>
            </nav>
        </div>

        <form autocomplete="off" class="wa-validated" action="@if(isset($question)) {{ url('teacher-panel/questions/' . $question->id . '/update') }} @else {{url('teacher-panel/questions/store')}} @endif" method="POST">
            <div class="row">
                <div class="col-7">
                    <div class="card card-border shadow">
                        <div class="card-header card-header-border-bottom">
                            <h2>Thêm câu hỏi</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <select name="subject_id" class="custom-select @if($errors && $errors->has('subject_id')) is-invalid @endif" required id="validationServerSubject">
                                        <option value="">Bấm để chọn môn học</option>
                                        @foreach($listSubject as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        var obj = document.getElementById("validationServerSubject");
                                        for (var i = 0; i < obj.length; i++) {
                                            if (obj.options[i].value == "@if($old && $old['subject_id'] != ''){{ $old['subject_id'] }}@elseif(isset($question)){{ $question->subject_id }}@endif") obj.selectedIndex = i;
                                        }
                                    </script>
                                    @if($errors && $errors->has('subject_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subject_id') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationServeQuestionContent">Câu hỏi</label>
                                    <textarea required name="question_content" id="validationServeQuestionContent" rows="8" class="form-control @if($errors && $errors->has('question_content')) is-invalid @endif">@if($old && $old['question_content'] != ''){{ $old['question_content'] }}@elseif(isset($question)){{ $question->question_content }}@endif</textarea>
                                    @if($errors && $errors->has('question_content'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('question_content') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationServeUnit">Chương</label>
                                    <input name="unit" NAME="name" min="1" max="99" size="1" maxlength="2" value="@if($old && $old['unit'] != ''){{ $old['unit'] }}@elseif(isset($question)){{ $question->unit }}@endif" type="number" class="form-control @if($errors && $errors->has('unit')) is-invalid @endif" id="validationServeUnit" placeholder="Chương bao nhiêu" required>
                                    @if($errors && $errors->has('unit'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('unit') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3 d-flex">
                                    <label for="validationServeQuestionLevel" class="mr-5">Độ khó</label>
                                    <div>
                                        @foreach($listLevel as $key => $level)
                                        <div class="custom-control custom-radio">
                                            <input required type="radio" class="form-check-input @if($errors && $errors->has('level_id')) is-invalid @endif" name="level_id" id="{{$level->id}}_level" value="{{$level->id}}" @if(isset($old['level_id']) && $old['level_id']==$level->id){{ "checked" }}@elseif(isset($question) && $question->level_id == $level->id){{ "checked" }}@endif>
                                            <label class="form-check-label" for="{{$level->id}}_level">{{$level->name}}</label>
                                            @if($key == 2)
                                            @if($errors && $errors->has('level_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('level_id') }}
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                        <!-- <li class="d-inline-block">
                                            <label class="control outlined control-radio">{{$level->name}}
                                                <input class="custom-control-input" name="level_id" type="radio" value="{{$level->id}}" @if(isset($old['level_id']) && $old['level_id']==$level->id){{ "checked" }}@elseif(isset($question) && $question->level_id == $level->id){{ "checked" }}@endif/>
                                                <div class="control-indicator"></div>
                                            </label>
                                        </li> -->
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button class="btn btn-primary mr-3" type="submit"><i class="mdi mdi-content-save"></i> Lưu vào ngân hàng câu hỏi</button>
                                    <a class="btn btn-danger" href="{{ url('teacher-panel/questions') }}"><i class="mdi mdi-close"></i> Hủy</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card card-border shadow">
                        <div class="card-header card-header-border-bottom d-flex justify-content-between">
                            <div>
                                <h2>Danh sách câu trả lời</h2>
                                <small><i class="mdi mdi-play"></i> Chọn một đáp án đúng</small>
                            </div>
                            <div>
                                <label class="switch switch-primary switch-pill form-control-label" data-toggle="tooltip" data-placement="bottom" title="Chuyển đổi qua lại để chọn một hoặc nhiều đáp án">
                                    <input type="checkbox" class="switch-input form-check-input" value="on" checked="">
                                    <span class="switch-label"></span>
                                    <span class="switch-handle"></span>
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">

                                <input autocomplete="false" name="hidden" type="text" style="display:none;">

                                <div class="col-md-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <label class="control outlined control-radio radio-success">
                                                    <input required id="a_checkbox" name="correct_answer" type="radio" @if(isset($question) && $question->correct_answer == $question->answer_a){{ "checked" }}@endif/>
                                                    <div class="control-indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <input id="a_value" name="answer_a" value="@if($old && $old['answer_a'] != ''){{ $old['answer_a'] }}@elseif(isset($question)){{ $question->answer_a }}@endif" type="text" class="form-control" aria-label="Text input with radio button" required>
                                    </div>
                                    <script>
                                        document.getElementById('a_checkbox').value = "@if($old && $old['answer_a'] != ''){{ $old['answer_a'] }}@elseif(isset($question)){{ $question->answer_a }}@endif";
                                        document.getElementById("a_value").addEventListener("change", function() {
                                            document.getElementById('a_checkbox').value = document.getElementById("a_value").value;
                                        })
                                    </script>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <label class="control outlined control-radio radio-success">
                                                    <input required id="b_checkbox" name="correct_answer" type="radio" @if(isset($question) && $question->correct_answer == $question->answer_b){{ "checked" }}@endif/>
                                                    <div class="control-indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <input id="b_value" name="answer_b" value="@if($old && $old['answer_b'] != ''){{ $old['answer_b'] }}@elseif(isset($question)){{ $question->answer_b }}@endif" type="text" class="form-control" aria-label="Text input with radio button" required>
                                    </div>
                                    <script>
                                        document.getElementById('b_checkbox').value = "@if($old && $old['answer_b'] != ''){{ $old['answer_b'] }}@elseif(isset($question)){{ $question->answer_b }}@endif";
                                        document.getElementById("b_value").addEventListener("change", function() {
                                            document.getElementById('b_checkbox').value = document.getElementById("b_value").value;
                                        })
                                    </script>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <label class="control outlined control-radio radio-success">
                                                    <input required id="c_checkbox" name="correct_answer" type="radio" @if(isset($question) && $question->correct_answer == $question->answer_c){{ "checked" }}@endif/>
                                                    <div class="control-indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <input id="c_value" name="answer_c" value="@if($old && $old['answer_c'] != ''){{ $old['answer_c'] }}@elseif(isset($question)){{ $question->answer_c }}@endif" type="text" class="form-control" aria-label="Text input with radio button" required>
                                    </div>
                                    <script>
                                        document.getElementById('c_checkbox').value = "@if($old && $old['answer_c'] != ''){{ $old['answer_c'] }}@elseif(isset($question)){{ $question->answer_c }}@endif";
                                        document.getElementById("c_value").addEventListener("change", function() {
                                            document.getElementById('c_checkbox').value = document.getElementById("c_value").value;
                                        })
                                    </script>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group input-group-sm @if($errors && $errors->has('correct_answer')) is-invalid @endif">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <label class="control outlined control-radio radio-success">
                                                    <input required id="d_checkbox" name="correct_answer" type="radio" @if(isset($question) && $question->correct_answer == $question->answer_d){{ "checked" }}@endif/>
                                                    <div class="control-indicator"></div>
                                                </label>
                                            </div>
                                        </div>
                                        <input id="d_value" name="answer_d" value="@if($old && $old['answer_d'] != ''){{ $old['answer_d'] }}@elseif(isset($question)){{ $question->answer_d }}@endif" type="text" class="form-control" aria-label="Text input with radio button" required>
                                    </div>
                                    @if($errors && $errors->has('correct_answer'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('correct_answer') }}
                                    </div>
                                    @endif
                                    <script>
                                        document.getElementById('d_checkbox').value = "@if($old && $old['answer_d'] != ''){{ $old['answer_d'] }}@elseif(isset($question)){{ $question->answer_d }}@endif";
                                        document.getElementById("d_value").addEventListener("change", function() {
                                            document.getElementById('d_checkbox').value = document.getElementById("d_value").value;
                                        })
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include('teacher.layouts.delete_modal')
@endsection