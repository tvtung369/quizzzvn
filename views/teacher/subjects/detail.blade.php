@extends('teacher.layouts.layout', ['active' => $active])

@section('css')

@endsection

@section('js')

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper" style="display: flex; justify-content: space-between;">
            <h1>Quản lý môn học</h1>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('teacher-panel/dashboard') }}">
                            <span class="mdi mdi-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        Người dùng
                    </li>
                    <li class="breadcrumb-item" aria-current="page">Môn học</li>
                </ol>
            </nav>

        </div>

        <div class="row">
            @if(session('message'))
            <div class="col-12">
                <div class="alert alert-success alert-highlighted alert-dismissible fade show" role="alert">
                    {{ flash('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            
            @endif
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom">
                        <h2>{{ $title }}</h2>
                    </div>
                    <div class="card-body">
                        <form action="@if(isset($subject)) {{ url('teacher-panel/subjects/' . $subject->id . '/update') }} @else {{url('teacher-panel/subjects/store')}} @endif" method="POST">
                            <div class="form-row">
                                <div class="col-md-7 mb-3">
                                    <label for="validationServeName">Tên môn học</label>
                                    <input name="subject_name" value="@if($old && $old['subject_name'] != '') {{ $old['subject_name'] }} @elseif(isset($subject)) {{ $subject->subject_name }}@endif" type="text" class="form-control @if($errors && $errors->has('subject_name')) is-invalid @endif" id="validationServerName" placeholder="Nhập vào tên môn học" required>
                                    @if($errors && $errors->has('subject_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('subject_name') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-5 mb-3">
                                    <label for="validationServerGrade">Khối</label>
                                    <select name="grade_id" class="form-control @if($errors && $errors->has('grade_id')) is-invalid @endif" required id="validationServerGrade">
                                        <option value="0">------ Chọn khối ------</option>
                                        @foreach($listGrade as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                                        @endforeach
                                    </select>
                                    @if(isset($subject))
                                    <script>
                                        var obj = document.getElementById("validationServerGrade");
                                        for (var i = 0; i < obj.length; i++) {
                                            if (obj.options[i].value === "{{$subject->grade_id}}") obj.selectedIndex = i;
                                        }
                                    </script>
                                    @endif
                                    @if($errors && $errors->has('grade_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('grade_id') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a class="btn btn-danger" href="{{ url('teacher-panel/subjects') }}">Close</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('teacher.layouts.delete_modal')
@endsection