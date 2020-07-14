@extends('teacher.layouts.layout', ['active' => $active])

@section('css')
<link href="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{ asset('teacher/assets/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet" />
<link href="https://unpkg.com/sleek-dashboard/dist/teacher/assets/css/sleek.min.css">
@endsection

@section('js')
<script src="{{ asset('teacher/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('teacher/assets/plugins/data-tables/datatables.responsive.min.js')}}"></script>

<script>
  jQuery(document).ready(function() {
    jQuery('#responsive-data-table').DataTable({
      "aLengthMenu": [
        [10, 30, 50, 75, -1],
        [10, 30, 50, 75, "All"]
      ],
      "pageLength": 10,
      "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
    });
  });
</script>
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
            Danh mục
          </li>
          <li class="breadcrumb-item" aria-current="page">Lớp</li>
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
          <div class="card-header card-header-border-bottom d-flex justify-content-between">
            <h2>{{ $title }}</h2>

            <a href="{{ url('teacher-panel/classes/create')}}" class="btn btn-outline-primary btn-sm text-uppercase">
              <i class=" mdi mdi-account-plus mr-1"></i> Thêm mới lớp học
            </a>
          </div>

          <div class="card-body">
            <div class="responsive-data-table">
              <table id="responsive-data-table" class="table dt-responsive nowrap" style="width:100%">
                <thead>
                  <tr">
                    <th>Tên lớp học</th>
                    <th>Khối</th>
                    <th>Giáo viên chủ nhiệm</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($list as $class)
                  <tr>
                    <td>{{ $class->name }}</td>
                    <td>{{ $class->grade_name }}</td>
                    <td>{{ $class->t_name }}</td>
                    <td class="text-center">
                      <a href="{{ url('teacher-panel/classes/'. $class->id .'/edit') }}" class="btn btn-sm btn-warning"><span class="mdi mdi-square-edit-outline mdi-18px"></span></a>
                      <a href="#" data-action="{{ url('teacher-panel/classes/'. $class->id .'/delete') }}" class="btn btn-sm btn-danger delete_confirmation" data-toggle="modal" data-target="#deleteModal"><span class="mdi mdi-trash-can-outline mdi-18px"></span></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@include('teacher.layouts.delete_modal')
@endsection