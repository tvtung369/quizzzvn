@extends('teacher.auth.layouts.layout')

@section('content')



<h4 class="text-dark mb-5">Sign In</h4>
<form action="{{ url('teacher-panel/login') }}" method="POST">
<div class="form-row">
    @if(session('message'))
    <div class="col-md-12 mb-3">
      <div class="alert alert-danger alert-highlighted" role="alert">
        {{ flash('message')}}
      </div>
    </div>
    @endif
    <div class="col-md-12 mb-3">
      <label for="validationServer01">Tên đăng nhập</label>
      <input name="username" value="{{ $old ? $old['username'] : '' }}" type="text" class="form-control @if($errors && $errors->has('username')) is-invalid @endif" id="validationServer01" placeholder="Tên đăng nhập" required>
      @if($errors && $errors->has('username'))
      <div class="invalid-feedback">
        {{ $errors->first('username') }}
      </div>
      @endif
    </div>
    <div class="col-md-12 mb-3">
      <label for="validationServerUsername">Mật khẩu</label>
      <input name="password" type="password" class="form-control @if($errors && $errors->has('username')) is-invalid @endif" id="validationServerUsername" placeholder="Mật khẩu" aria-describedby="inputGroupPrepend3" required>
      @if($errors && $errors->has('password'))
      <div class="invalid-feedback">
        {{ $errors->first('password') }}
      </div>
      @endif
    </div>
    <div class="col-md-12">
      <div class="d-flex my-2 justify-content-between">
        <div class="d-inline-block mr-3">
          <label class="control control-checkbox">Ghi nhớ
            <input name="remember" type="checkbox"/>
            <div class="control-indicator"></div>
          </label>
  
        </div>
        <p><a class="text-blue" href="#">Quên mật khẩu?</a></p>
      </div>
      <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Đăng nhập</button>
    </div>
  </div>
</form>


@endsection