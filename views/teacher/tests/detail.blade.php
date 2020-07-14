@extends('teacher.layouts.layout', ['active' => $active])

@section('css')
<link href="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{ asset('teacher/assets/plugins/data-tables/responsive.datatables.min.css')}}" rel="stylesheet" />

<!-- Select2 CSS -->
<link href="{{ asset('teacher/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />

<style>
    .material-form {
        position: relative;
    }

    .material-form .material-label {
        position: absolute;
        font-size: 0.875rem;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        background-color: #ffffff;
        color: #565656;
        padding: 0 0.3rem;
        margin: 0 0.5rem;
        transition: .1s ease-out;
        transform-origin: left top;
        pointer-events: none;
    }

    /* ====== */
    .material-form .material-control {
        width: 100%;
        font-size: 0.875rem;
        outline: none;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.59rem 1rem;
        color: #2b2c2d;
        transition: 0.1s ease-out;
        font-weight: 400;
        line-height: 1.5;
    }

    .is-invalid .material-control {
        border: 1px solid #fe5461;
    }

    /* == END == */

    /* ======== */
    .material-form .material-control:focus {
        border-color: #4c84ff;
    }

    .is-invalid .material-control:focus {
        border-color: #fe5461;
    }

    /* == END == */

    /* ======== */
    .material-form .material-control:focus+label {
        color: #4c84ff;
        top: 0;
        transform: translateY(-50%) scale(.9);
    }

    .is-invalid .material-control:focus+label {
        color: #fe5461;
        top: 0;
        transform: translateY(-50%) scale(.9);
    }

    /* == END == */

    .material-form .material-control:not(:placeholder-shown)+label {
        top: 0;
        transform: translateY(-50%) scale(.9);
    }
</style>

@endsection

@section('js')
<!-- Select2 -->
<script src="{{ asset('teacher/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('teacher/assets/plugins/jquery-mask-input/jquery.mask.min.js') }}"></script>

<!-- Datatable -->
<script src="{{ asset('teacher/assets/plugins/data-tables/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('teacher/assets/plugins/data-tables/datatables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('teacher/assets/plugins/data-tables/datatables.responsive.min.js')}}"></script>

<script>
    $(document).ready(function() {
        /**
         * Show criteria list when subject select is changed
         */
        let subjectId = '';
        $('select[name=subject_id]').change(() => {
            subjectId = $('select[name=subject_id]').val();
            showCriteriaList(subjectId);
        });

        $('#frmCriteria').on('submit', (e) => {
            e.preventDefault();

            let inputs = $('#frmCriteria').serializeArray();
            getQuestionListByCriteria(inputs);
        })

        $('#delete_action').on('submit', (e) => {
            e.preventDefault();
            $('#deleteModal').modal('hide');
            let url = "{{ url('teacher-panel/tests/delete-question-of-test') }}"
            postPromise(url, {
                    question_id: $('#delete_action').attr('action')
                })
                .then(res => {
                    res = JSON.parse(res)
                    showQuestionList(res.questionListOfTest);
                });
        })
    });

    /**
     * get question list by given array input  
     * 
     * @param Array input
     * @return void
     */
    function getQuestionListByCriteria(inputs) {
        // Hiden modal
        $('#criteria').modal('hide')

        // Preload
        preload($('#tblQuestionList').parent(), 1);

        let criteriaArray = inputs.filter(x => x.value !== '');
        let url = "{{ url('teacher-panel/tests/get-question-list-of-test-by-criteria') }}";
        postPromise(url, criteriaArray)
            .then(res => {
                res = JSON.parse(res);

                $('#tblQuestionList').addClass('table dt-responsive nowrap');
                // Remove preload
                $('#tblQuestionList').next().html('');

                showQuestionList(res.questionListOfTest);
            });
    }

    /**
     * Show question list by given data
     * 
     * @param Array
     * @return void
     */
    function showQuestionList(resData = []) {
        $('#tblQuestionList').DataTable({
            'destroy': true,
            data: resData.map(x => {
                return {
                    'id': x.id,
                    'question_content': (x.question_content.length >= 40) ? x.question_content.substring(0, 40) + ' ...' : x.question_content,
                    'level': x.l_name,
                    'action': '<a href="javascript:void(0)" data-action="' + x.id + '" class="text-secondary delete_confirmation" data-toggle="modal" data-target="#deleteModal"><span class="mdi mdi-trash-can-outline mdi-18px"></span></a>'
                }
            }),
            columns: [{
                    title: 'ID',
                    data: 'id'
                },
                {
                    title: 'Câu hỏi',
                    data: 'question_content'
                },
                {
                    title: 'Độ khó',
                    data: 'level'
                },
                {
                    title: 'Action',
                    data: 'action'
                }
            ],
            columnDefs: [{
                targets: 3,
                className: 'text-center'
            }],
            "language": {
                "lengthMenu": "Hiển thị _MENU_",
                "zeroRecords": "Không có câu hỏi nào",
                "info": "Hiển thị _START_ đén _END_ trên tổng _TOTAL_ câu hỏi",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Tìm kiếm:",
            },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
        });
    }

    /**
     * Show criteria list by given subject id
     * 
     * @param int subjectId
     * @return void
     */
    function showCriteriaList(subjectId) {
        if (subjectId) {
            $('#btn_criteria').prop('disabled', false);

            $('#criteria .modal-body .container').html('');
            // Preload
            preload($('#criteria .modal-body .container'), 2);

            let data = {
                subject_id: subjectId,
            }
            let url = "{{url('teacher-panel/tests/get-unit-list-of-subject')}}";
            postPromise(url, data)
                .then(res => {
                    data = [];
                    res = JSON.parse(res);
                    for (let i of res.unitList) {
                        data.push({
                            subject_id: subjectId,
                            unit: i.unit,
                        });
                    }
                })
                .then(() => {
                    url = "{{ url('teacher-panel/tests/get-level-list-of-unit')}}";
                    let arrayPromise = data.map(x => {
                        return postPromise(url, x);
                    })
                    return Promise.all(arrayPromise)
                })
                .then((res) => {
                    let htmlStr = ''
                    for (let unit of res) {
                        unit = JSON.parse(unit);
                        // console.log(unit);
                        htmlStr += '<div id="unit_' + unit.levelList[0].unit + '" class="form-group row">' +
                            '<label class="col-sm-3 col-form-label" title="Các phép toán cộng trừ cơ bản" style="color: #6f6f6f">Chương ' + unit.levelList[0].unit + '</label>';
                        for (let level of unit.levelList) {
                            htmlStr += '<div class="col-sm-3">' +
                                '<div class="material-form">' +
                                '<input name="' + subjectId + '_unit_' + level.unit + '_level_' + level.level_id + '" class="material-control" placeholder=" " min="1" max="' + level.total + '" size="5" maxlength="2" type="number">' +
                                '<label class="material-label">' + level.l_name + ' (' + level.total + ') ' + '</label>' +
                                '</div>' +
                                '</div>'
                        }
                        htmlStr += '</div>';
                    }
                    if (htmlStr)
                        $('#criteria .modal-body .container').html(htmlStr);
                    else
                        $('#criteria .modal-body .container').html('<span style="color:red">Môn thi này chưa có câu hỏi, thêm câu hỏi <a href="{{ url("teacher-panel/questions/create") }}" target="_blank">tại đây</a>!</span>');
                });
        } else {
            $('#btn_criteria').prop('disabled', true);
        }
    }
</script>
@if(session('message'))
<script>
    if (toaster.length != 0) {
        if (document.dir != "rtl") {
            callToaster("toast-top-right", '{{ flash("message") }}', 'warning');
        } else {
            callToaster("toast-top-left", '{{ flash("message") }}', 'warning');
        }
    }
</script>
@endif
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper" style="display: flex; justify-content: space-between;">
            <h1>Quản lý đề thi</h1>
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

        <form autocomplete="off" class="wa-validated" action="@if(isset($test)) {{ url('teacher-panel/tests/' . $tests->id . '/update') }} @else {{url('teacher-panel/tests/store')}} @endif" method="POST">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-border shadow">
                                <div class="card-body">

                                    <div class="form-group">
                                        <select name="subject_id" class="custom-select @if($errors && $errors->has('subject_id')) is-invalid @endif" required id="validationServerSubject">
                                            <option value="">Chọn môn học trước khi lấy câu hỏi</option>
                                            @foreach($subjectList as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                            @endforeach
                                        </select>
                                        <script>
                                            var obj = document.getElementById("validationServerSubject");
                                            for (var i = 0; i < obj.length; i++) {
                                                if (obj.options[i].value == "@if($old && $old['subject_id'] != ''){{ $old['subject_id'] }}@elseif(isset($test)){{ $test->subject_id }}@endif") obj.selectedIndex = i;
                                            }
                                        </script>
                                        @if($errors && $errors->has('subject_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('subject_id') }}
                                        </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button disabled type="button" id="btn_criteria" class="btn btn-block btn-info" data-toggle="modal" data-target="#criteria">
                                            <i class="mdi mdi-magnify mdi-18px"></i> Chọn câu hỏi theo tiêu chí
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="card card-border shadow">
                                <div class="card-body">
                                    <h5 class="card-title">Thông số</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Cài đặt một số thuộc tính của đề thi</h6>

                                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                                    <div class="material-form mt-4 @if($errors && $errors->has('test_name')) is-invalid @endif">
                                        <input value="@if($old && $old['test_name'] != ''){{ $old['test_name'] }}@elseif(isset($test)){{ $test->test_name }}@endif" name="test_name" class="material-control" placeholder=" " type="text">
                                        <label class="material-label">Tên bài thi</label>
                                    </div>
                                    @if($errors && $errors->has('test_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('test_name') }}
                                    </div>
                                    @endif
                                    <div class="material-form mt-4 @if($errors && $errors->has('time_to_do')) is-invalid @endif">
                                        <input value="@if($old && $old['time_to_do'] != ''){{ $old['time_to_do'] }}@elseif(isset($test)){{ $test->time_to_do }}@endif" name="time_to_do" class="material-control" placeholder=" " min="1" max="99" size="5" maxlength="2" type="number">
                                        <label class="material-label">Thời gian làm (Phút)</label>
                                    </div>
                                    @if($errors && $errors->has('time_to_do'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('time_to_do') }}
                                    </div>
                                    @endif
                                    <div class="material-form mt-4 @if($errors && $errors->has('note')) is-invalid @endif">
                                        <textarea name="note" class="material-control" col="3">@if($old && $old['note'] != '') {{ $old['note'] }} @elseif(isset($test)) {{ $test->note }}@endif</textarea>
                                        <label class="material-label">Ghi chú</label>
                                    </div>
                                    @if($errors && $errors->has('note'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('note') }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="card card-border shadow">
                        <div class="card-header card-header-border-bottom d-flex justify-content-between">
                            <div>
                                <h2>Danh sách câu hỏi</h2>
                                <small><i class="mdi mdi-play"></i> Có thể thêm hoặc xóa thủ công các câu hỏi</small>
                            </div>
                            <div>
                                <a id="btnAddQuestionsOfTest" href="javascript:void(0)" class="text-secondary" title="Thêm thủ công" data-toggle="modal" data-target="#addQuestions">
                                    <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="responsive-data-table">
                                <table id="tblQuestionList" class="" style="width:100%">
                                    <!-- Datatable -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <button class="btn btn-block btn-primary mr-3"><i class="mdi mdi-content-save"></i> Lưu vào ngân hàng câu hỏi</button>
                    <a class="btn btn-block btn-danger" href="{{ url('teacher-panel/tests') }}"><i class="mdi mdi-cancel"></i> Hủy</a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Criteria-->
<form id="frmCriteria">
    <div class="modal fade" id="criteria" tabindex="-1" role="dialog" aria-labelledby="criteriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="criteriaLabel">Nhập số câu hỏi mà từng trương sẽ có trong đề thi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" title="Các phép toán cộng trừ cơ bản" style="color: #6f6f6f">Chương 1</label>
                            <div class="col-sm-3">
                                <div class="material-form">
                                    <input class="material-control" placeholder=" " min="1" max="99" size="5" maxlength="2" type="number">
                                    <label class="material-label">Dễ (144)</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="material-form">
                                    <input class="material-control" placeholder=" " min="1" max="99" size="5" maxlength="2" type="number">
                                    <label class="material-label">Trung bình (5)</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="material-form">
                                    <input class="material-control" placeholder=" " min="1" max="99" size="5" maxlength="2" type="number">
                                    <label class="material-label">Khó (1000)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Thêm vào đề thi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Criteria-->
<form id="frmAddQuestions">
    <div class="modal fade" id="addQuestions" tabindex="-1" role="dialog" aria-labelledby="addQuestionsLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="criteriaLabel">Thêm câu hỏi thủ công</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Đang hoàn thiện ... Vui lòng quay lại sau!!!
                </div>
                <div class="modal-footer">
                    <div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary">Thêm vào đề thi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@include('teacher.layouts.delete_modal')
@endsection