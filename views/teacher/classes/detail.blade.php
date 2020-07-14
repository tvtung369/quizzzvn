@extends('teacher.layouts.layout', ['active' => $active])

@section('css')

@endsection

@section('js')

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper" style="display: flex; justify-content: space-between;">
            <h1>Quản lý lớp học</h1>

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
                    <li class="breadcrumb-item" aria-current="page">Lớp học</li>
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
                        <form action="@if(isset($class)) {{ url('teacher-panel/classes/' . $class->id . '/update') }} @else {{url('teacher-panel/classes/store')}} @endif" method="POST">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationServeName">Tên lớp</label>
                                    <input name="name" value="@if($old && $old['name'] != ''){{ $old['name'] }}elseif(isset($class)){{ $class->name }}@endif" type="text" class="form-control @if($errors && $errors->has('name')) is-invalid @endif" id="validationServerName" placeholder="Nhập vào tên lớp học" required>
                                    @if($errors && $errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="col-md-6 mb-3">
                                    <label for="validationServerTeacher">Giáo viên</label>
                                    <select name="teacher_id" class="form-control @if($errors && $errors->has('teacher_id')) is-invalid @endif" required id="validationServerTeacher">
                                        <option value="0">------ Chọn giáo viên ------</option>
                                        @foreach($listTeacher as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @if(isset($class))
                                    <script>
                                        var obj = document.getElementById("validationServerTeacher");
                                        for (var i = 0; i < obj.length; i++) {
                                            if (obj.options[i].value === "{{$class->teacher_id}}") obj.selectedIndex = i;
                                        }
                                    </script>
                                    @endif
                                    @if($errors && $errors->has('teacher_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('teacher_id') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="validationServerGrade">Khối</label>
                                    <select name="grade_id" class="form-control @if($errors && $errors->has('grade_id')) is-invalid @endif" required id="validationServerGrade">
                                        <option value="0">------ Chọn khối ------</option>
                                        @foreach($listGrade as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->grade_name }}</option>
                                        @endforeach
                                    </select>
                                    @if(isset($class))
                                    <script>
                                        var obj = document.getElementById("validationServerGrade");
                                        for (var i = 0; i < obj.length; i++) {
                                            if (obj.options[i].value === "{{$class->grade_id}}") obj.selectedIndex = i;
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
                            <a class="btn btn-danger" href="{{ url('teacher-panel/classes') }}">Close</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('teacher.layouts.delete_modal')
@endsection