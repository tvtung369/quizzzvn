@extends('teacher.layouts.layout', ['active' => $active])

@section('css')
<link href="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ asset('teacher/assets/plugins/data-tables/jquery.datatables.min.css') }}" rel="stylesheet" />
@endsection

@section('js')
<script src="{{ asset('teacher/assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>

<script>

  function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
  }
  /* Formatting function for row details - modify as you need */
  function format(question) {
    question = question.slice(1);
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
      '<tr>' +
      '<td>Câu hỏi:</td>' +
      '<td>' + decodeHtml(question[0]) + '</td>' +
      '</tr>' +
      '<tr>' +
      '<td>Đáp án a:</td>' +
      '<td>' + 'dfdf' + '</td>' +
      '</tr>' +
      '<tr>' +
      '<td>Đáp án b:</td>' +
      '<td>123</td>' +
      '</tr>' +
      '<tr>' +
      '<td>Đáp án c:</td>' +
      '<td>And any further details here (images etc)...</td>' +
      '</tr>' +
      '<tr>' +
      '<td>Đáp án d:</td>' +
      '<td>And any further details here (images etc)...</td>' +
      '</tr>' +
      '</table>';
  }

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
@endsection

@section('content')
<div class="content-wrapper">
  <div class="content">
    <div class="breadcrumb-wrapper d-flex justify-content-between">
      <h1>Quản lý câu hỏi</h1>

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

            <div>
              <a href="{{ url('teacher-panel/questions/create')}}" class="btn btn-outline-primary btn-sm text-uppercase">
                <i class=" mdi mdi-plus mr-1"></i> Thêm câu hỏi
              </a>
              <a href="javascript:void(0);" class="btn btn-outline-primary btn-sm text-uppercase">
                <i class=" mdi mdi-file-plus mr-1"></i> Thêm câu hỏi từ file
              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="expendable-data-table">
              <table id="expendable-data-table" class="table display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th></th>
                    <th>Câu hỏi</th>
                    <th>Môn học</th>
                    <th>Độ khó</th>
                    <th>Chương</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($list as $question)
                  <tr>
                    <td class="details-control"></td>
                    <td class="questionContent">{{$question->question_content}}<br>
                      <ul style="display: lex; justify-content: space-around;">
                        <li>{{$question->answer_a}}</li>
                        <li>{{$question->answer_b}}</li>
                        <li>{{$question->answer_c}}</li>
                        <li>{{$question->answer_d}}</li>
                      </ul>
                    </td>
                    <td>{{$question->subject_name}}</td>
                    <td>{{$question->l_name}}</td>
                    <td>{{$question->unit}}</td>
                    <td><span class="badge badge-warning">{{$question->status_name}}</span></td>
                    <td class="text-center">
                      <a href="{{ url('teacher-panel/questions/'. $question->id .'/edit') }}" class="btn btn-sm btn-warning"><span class="mdi mdi-square-edit-outline mdi-18px"></span></a>
                      <a href="#" data-action="{{ url('teacher-panel/questions/'. $question->id .'/delete') }}" class="btn btn-sm btn-danger delete_confirmation" data-toggle="modal" data-target="#deleteModal"><span class="mdi mdi-trash-can-outline mdi-18px"></span></a>
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