@extends('teacher.layouts.layout', ['active' => $active])

@section('css')
<link href="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('teacher/assets/plugins/data-tables/jquery.datatables.min.css') }}" rel="stylesheet" />
@endsection

@section('js')
<script src="{{ asset('teacher/assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>

<script>
  $(document).ready(function() {
    console.log(document.getElementsByClassName('questionContent')[0].innerText);
    var table = $('#expendable-data-table').DataTable({
      "className": 'details-control',
      "order": [
        [0, 'asc']
      ],
      "aLengthMenu": [
        [20, 30, 50, 75, -1],
        [20, 30, 50, 75, "All"]
      ],
      "pageLength": 20,
      "dom": '<"row align-items-center justify-content-between top-information"lf>rt<"row align-items-center justify-content-between bottom-information"ip><"clear">'
    });

    // Add event listener for opening and closing details
    $('#expendable-data-table tbody').on('click', 'td.details-control', function() {
      var tr = $(this).closest('tr');
      var row = table.row(tr);

      if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      } else {
        // Open this row
        row.child(format(row.data())).show();
        tr.addClass('shown');
      }
    });
  });
</script>
@if(session('message'))
<script>
    if (toaster.length != 0) {
        if (document.dir != "rtl") {
            callToaster("toast-top-right", '{{ flash("message") }}', '{{ flash("level") }}');
        } else {
            callToaster("toast-top-left", '{{ flash("message") }}', '{{ flash("level") }}');
        }
    }
</script>
@endif
@endsection

@section('content')
<div class="content-wrapper">
  <div class="content">
    <div class="breadcrumb-wrapper d-flex justify-content-between">
      <h1>Quản lý đề thi</h1>

      <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
          <li class="breadcrumb-item">
            <a href="{{ url('teacher-panel/dashboard') }}">
              <span class="mdi mdi-home"></span>
            </a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Đề thi</li>
        </ol>
      </nav>

    </div>

    <div class="row">
      <div class="col-12">
        <div class="card card-default">
          <div class="card-header card-header-border-bottom d-flex justify-content-between">
            <h2>{{ $title }}</h2>

            <div>
              <a href="{{ url('teacher-panel/tests/create')}}" class="btn btn-outline-primary btn-sm text-uppercase">
                <i class=" mdi mdi-file-plus mdi-18px mr-1"></i> Tạo đề thi
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="expendable-data-table">
              <table id="expendable-data-table" class="table display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Bài kiểm tra</th>
                    <th>Môn học</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="details-control"></td>
                    <td class="questionContent">Bài kiểm tra 1<br></td>
                    <td>Toán lớp 1</td>
                    <td><span class="badge badge-warning">Mở</span></td>
                    <td class="text-center">
                      <a href="#" class="btn btn-sm btn-warning"><span class="mdi mdi-square-edit-outline mdi-18px"></span></a>
                      <a href="#" data-action="#" class="btn btn-sm btn-danger delete_confirmation" data-toggle="modal" data-target="#deleteModal"><span class="mdi mdi-trash-can-outline mdi-18px"></span></a>
                    </td>
                  </tr>
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