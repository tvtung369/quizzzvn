@extends('teacher.layouts.layout', ['active' => $active])

@section('css')

@endsection

@section('js')

@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper" style="display: flex; justify-content: space-between;">
            <h1>Quản lý học sinh</h1>

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
                    <li class="breadcrumb-item" aria-current="page">Học sinh</li>
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
                        <form action="@if(isset($student)) {{ url('teacher-panel/students/' . $student->id . '/update') }} @else {{url('teacher-panel/students/store')}} @endif" method="POST">
                            <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationServeName">Họ tên</label>
                                    <input name="name" value="@if($old && $old['name'] != '') {{ $old['name'] }} @elseif(isset($student)) {{ $student->name }}@endif" type="text" class="form-control @if($errors && $errors->has('name')) is-invalid @endif" id="validationServerName" placeholder="Họ tên đầy đủ" required>
                                    @if($errors && $errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationServerUsername">Tên đăng nhập</label>
                                    <input name="username" value="@if($old && $old['username'] != '') {{ $old['username'] }} @elseif(isset($student)) {{ $student->username }}@endif" type="text" class="form-control @if($errors && $errors->has('email')) is-invalid @endif" type="text" class="form-control @if($errors && $errors->has('username')) is-invalid @endif" id="validationServerUsername" placeholder="Tên đăng nhập" required>
                                    @if($errors && $errors->has('username'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('username') }}
                                    </div>
                                    @endif
                                </div>
                                @if(! isset($student))
                                <div class="col-md-12 mb-3">
                                    <label for="validationServerPassword">Mật khẩu</label>
                                    <input name="password" type="password" class="form-control @if($errors && $errors->has('password')) is-invalid @endif" id="validationServerPassword" placeholder="Mật khẩu" required>
                                    @if($errors && $errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                            <div class="form-row">
                                <div class="col-md-7 mb-3">
                                    <label for="validationServerEmail">Email</label>
                                    <input name="email" value="@if($old && $old['email'] != '') {{ $old['email'] }} @elseif(isset($student)) {{ $student->email }}@endif" type="email" class="form-control @if($errors && $errors->has('email')) is-invalid @endif" id="validationServerEmail" placeholder="Email liên lạc">
                                    @if($errors && $errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                    @endif
                                </div>

                                <div class="col-md-5 mb-3">
                                    <label for="validationServerClass">Lớp</label>
                                    <select name="class_id" class="form-control @if($errors && $errors->has('class_id')) is-invalid @endif" required id="validationServerClass">
                                        <option>Chọn Lớp</option>
                                        @foreach($listClass as $class)
                                        <option value="{{ $class->id }}">{{$class->name}}</option>
                                        @endforeach
                                    </select>
                                    <script>
                                        var obj = document.getElementById("validationServerClass");
                                        for (var i = 0; i < obj.length; i++) {
                                            if (obj.options[i].value == "@if($old && $old['class_id'] != '') {{ $old['class_id'] }} @elseif(isset($student)) {{ $student->class_id }}@endif".trim()) obj.selectedIndex = i;
                                        }
                                    </script>
                                    @if($errors && $errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServerAdrress">Địa chỉ</label>
                                    <input name="address" value="@if($old && $old['address'] != '') {{ $old['address'] }} @elseif(isset($student)) {{ $student->address }}@endif" type="text" class="form-control @if($errors && $errors->has('email')) is-invalid @endif" type="text" class="form-control @if($errors && $errors->has('address')) is-invalid @endif" id="validationServerAddress" placeholder="Địa chỉ thường trú" required>
                                    @if($errors && $errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServerBirthday">Ngày sinh</label>
                                    <input name="birthday" type="date" class="form-control @if($errors && $errors->has('email')) is-invalid @endif" type="date" class="form-control @if($errors && $errors->has('birthday')) is-invalid @endif" id="validationServerBirthday" required>
                                    @if($errors && $errors->has('birthday'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('birthday') }}
                                    </div>
                                    @endif
                                    <script>
                                        window.onload = function() {
                                            document.getElementById('validationServerBirthday').value = (new Date("@if($old && $old['birthday'] != '') {{ $old['birthday'] }} @elseif(isset($student)) {{ $student->birthday }}@endif")).toISOString().substr(0, 10);
                                        }
                                    </script>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServerGender">Giới tính</label>
                                    <select name="gender" class="form-control @if($errors && $errors->has('address')) is-invalid @endif" required id="validationServerGender">
                                        <option value="0">Chọn giới tính</option>
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                    <script>
                                        var obj = document.getElementById("validationServerGender");
                                        for (var i = 0; i < obj.length; i++) {
                                            if (obj.options[i].value == "@if($old && $old['gender'] != '') {{ $old['gender'] }} @elseif(isset($student)) {{ $student->gender }}@endif".trim()) obj.selectedIndex = i;
                                        }
                                    </script>
                                    @if($errors && $errors->has('address'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('address') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a class="btn btn-danger" href="{{ url('teacher-panel/students') }}">Close</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('teacher.layouts.delete_modal')
@endsection