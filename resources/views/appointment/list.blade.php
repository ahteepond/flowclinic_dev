@extends('layouts.template')


@section('content')
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: #fbfbfb; color: #000;
    }
</style>

    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-filter" aria-hidden="true"></i> ตัวกรอง</h3>
                            </div>
                            <div class="card-body py-2">
                                <div class="row">
                                    <div class="col-12 text-start">
                                        <div class="row align-items-end">
                                            <div class="form-group col-auto">
                                                <label class="form-label">ข้อมูลลูกค้า</label>
                                                <div class="input-group">
                                                    <select class="form-select" id="cust_option">
                                                        <option value="cust_code" selected>รหัสลูกค้า</option>
                                                        <option value="idcard">เลขบัตรประชาชน</option>
                                                        <option value="tel">เบอร์โทรศัพท์</option>
                                                    </select>
                                                    <input type="text" class="form-control" id="cust_value">
                                                  </div>
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">เลขที่ใบนัดหมาย</label>
                                                <input type="text" name="appointment_no" id="appointment_no" class="form-control">
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">วันที่นัดหมาย</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                    <input class="form-control fc-datepicker" name="appointment_date" id="appointment_date" placeholder="กรุณาระบุวันที่ใบสั่งซื้อ..." type="text">
                                                </div>
                                            </div>
                                            <div class="form-group col-auto">
                                                
                                                <label class="form-label">สถานะใบนัดหมาย</label>
                                                <select name="appointment_status" id="appointment_status" class="form-control form-select">
                                                    @foreach ( $aptstatus as $status )
                                                        <option value="{{ $status->status }}">{{ $status->status_text }}</option>
                                                    @endforeach
                                                    <option value="" selected>ทั้งหมด</option>
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button"onclick="clearFillter()" class="btn btn-outline-dark mb-4 ms-2"><i class="fa fa-refresh me-2"></i>ล้าง</button>
                                                <button type="button"onclick="searchTable()" class="btn btn-outline-primary mb-4 ms-2"><i class="fa fa-search me-2"></i>ค้นหา</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ROW END -->

        @yield('appointment_checklist')

    </div>
    <!-- CONTAINER END -->
@endsection

@section('other')
<div class="modal fade" id="dtlapt_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-6">
                <!-- ROW  -->
                <div class="row">
                    <div class="col-md">
                        <p class="mb-3 fs-18">เลขที่ใบนัด <b><span class="text-primary fw-semibold clear_dtl_t" id="dtl_appointment_code"></span></b></p>
                    </div>
                    <div class="col-md text-end" id="disp_status"></div>
                    <div class="col-12">
                        <div class="expanel expanel-default">
                            <div class="expanel-body pt-5">
                                <div class="row">
                                    <div class="col-md-3 px-4">
                                        <div class="clearfix row mb-3">
                                            <div class="col-auto">
                                                <div class="float-start">
                                                    <h4 class="mb-0 mt-2"><strong>นัดครั้งที่</strong></h4>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="float-end">
                                                    <h3 class="fw-bold mb-0 text-primary mt-1 clear_dtl_t" id="dtl_round"></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md px-4">
                                        <div class="clearfix row mb-2">
                                            <div class="col">
                                                <div class="float-start">
                                                    <h5 class="mb-0"><strong>วันที่นัด</strong></h5>
                                                    <small class="text-muted">Appointment Date</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="float-end">
                                                    <h4 class="fw-bold mb-0 mt-2 text-blue clear_dtl_t" id="dtl_aptdate"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md px-4">
                                        <div class="clearfix row mb-2">
                                            <div class="col">
                                                <div class="float-start">
                                                    <h5 class="mb-0"><strong>เวลานัด</strong></h5>
                                                    <small class="text-muted">Appointment Time</small>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="float-end">
                                                    <h4 class="fw-bold mb-0 mt-2 text-blue clear_dtl_t" id="dtl_apttime"></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-end">
                        <p class="">สินค้าจากใบสั่งซื้อ <a href="#"><b><span class="clear_dtl_t" id="dtl_order_code"></span></b></a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p class="h4 fw-semibold">ข้อมูลลูกค้า</p>
                        <hr class="my-1">
                    </div>
                    <div class="col-md-12">
                        <p class="fs-14 mb-0">
                            <span class="fw-semibold text-primary clear_dtl_t" id="dtl_custcode"></span> 
                            <span class="clear_dtl_t" id="dtl_custfullname"></span>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p class="fs-14 mb-0"><span class="fw-semibold">การติดต่อ : </span></p>
                        <p class="fs-14 mb-0"><span class="clear_dtl_t" id="dtl_custtel"></span></p>
                        <p class="fs-14 mb-0"><span class="clear_dtl_t" id="dtl_custaddr"></span></p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">เลขบัตรประชาชน : </span><span class="clear_dtl_t" id="dtl_custidcard"></span></p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">วันเกิด : </span><span class="clear_dtl_t" id="dtl_custbdate"></span></p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">อายุ : </span><span class="clear_dtl_t" id="dtl_custage"></span> ปี</p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">กรุ๊ปเลือด : </span><span class="clear_dtl_t" id="dtl_custbloodtype"></span></p>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-md-12">
                        <p class="h4 fw-semibold">ข้อมูลบริการ</p>
                        <hr class="my-1">
                    </div>
                    <div class="col-md">
                        <p class="fs-14 mb-0"><span class="fw-semibold">บริการ : </span><span class="clear_dtl_t" id="dtl_service_master"></span></p>
                        <p class="fs-14 mb-0"><span class="clear_dtl_t" id="dtl_service"></span></p>
                    </div>
                    <div class="col-md">
                        <p class="fs-14 mb-0"><span class="fw-semibold">ประเภทบริการ : </span><span class="clear_dtl_t" id="dtl_service_type"></span></p>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-12"><p class="h4 fw-semibold">หมายเหตุ</p></div>
                    <hr class="my-1">
                    <div class="col-md-12">
                        <p id="note_newapt"></p>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-12"><p class="h4 fw-semibold">บันทึก</p></div>
                    <hr class="my-1">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-floating floating-label1">
                                <textarea class="form-control clear_dtl_i" placeholder="Comments" id="note" style="height: 140px"></textarea>
                                <label for="note"><i class="fa fa-sticky-note-o me-2 text-azure"></i>บันทึกนัดหมาย</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-6" id="disp_note_cancel">
                    <div class="col-12"><p class="h4 fw-semibold text-danger">เหตุผลที่ยกเลิก</p></div>
                    <hr class="my-1">
                    <div class="col-md-12">
                        <p class="text-danger" id="txt_note_cancel"></p>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-12"><p class="h4 fw-semibold">ประวัติการบันทึก</p></div>
                    <hr class="my-2">
                    <div class="col-md-12">
                        <ul class="task-list">
                            <li class="d-sm-flex">
                                <div>
                                    <i class="task-icon bg-secondary"></i>
                                    <h6 class="fw-semibold">
                                        <span class="text-primary me-1">Sale</span>
                                        <span>พงศกร เหล่านิยมไทย</span>
                                        <span class="text-muted fs-11 ms-2 fw-normal">2022/09/1</span>
                                    </h6>
                                    <p class="text-muted fs-12">Adam Berry finished task on</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary my-2 ms-2" onclick="sendtoOR('')" id="btn_apt_sendtoor">ส่งใบนัดให้ OR</button>
                        <button class="btn btn-danger my-2 ms-2" onclick="cancelAPT('')" id="btn_apt_cancle">ยกเลิกนัด</button>
                        <button class="btn btn-outline-primary my-2 ms-2" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
                <!-- ROW END -->
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="aptcancel_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-4 pb-5">
                <i class="icon icon-exclamation fs-70 text-danger lh-1 my-4 d-inline-block"></i>
                <h4 class="text-danger mb-20">กรุณากรอกเหตุผลการยกเลิกนัด (<span id="titlecancel_aptcode"></span>)</h4>
                <input type="text" id="tmpcancle_aptno" hidden>
                <textarea class="form-control mb-4" placeholder="กรอกเหตุผล..." rows="4" id="note_cancel"></textarea>
                <button class="btn btn-danger my-2 ms-2 pd-x-25" onclick="confirmCancelAPT($('#note_cancel').val())">ยกเลิกนัด</button>
                <button data-bs-dismiss="modal" class="btn btn-outline-danger my-2 ms-2 pd-x-25" onclick="">ปิด</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('script')

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- Internal Timeline js-->
    <script src="{{ asset('assets/plugins/timeline/js/timeline.min.js') }}"></script>

    <!-- FULL CALENDAR JS -->
    <script src="{{ asset('assets/plugins/fullcalendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>

    <script>
    $( document ).ready(function() {

    });

    var dataTable = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            url: "{{ route('appointment.getaptlist') }}",
            data: function( d ) {
                d.cust_option = $('#cust_option').val(),
                d.cust_value = $('#cust_value').val(),
                d.code = $('#appointment_no').val(),
                d.date = $('#appointment_date').val(),
                d.status = $('#appointment_status :selected').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "เลขที่ใบนัด", data: 'aptcode', name: 'aptcode' },
            { title: "ชื่อลูกค้า", data: 'custfullname', name: 'custfullname' },
            { title: "สถานะใบนัด", data: 'aptstatus', name: 'aptstatus' },
            { title: "วันเวลานัดหมาย", data: 'aptdatetime', name: 'aptdatetime' },
            { title: "วันที่สร้าง", data: 'created', name: 'created' },
        ],
        'columnDefs': [
            { "className": "text-center", "targets": [0,3,4,5] },
        ]
    });
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    function clearFillter() {
        $('#appointment_no').val('');
        $('#appointment_date').val('');
        $('#appointment_status').val('');
        $('#cust_value').val('');
    }



    var mAptCode = "";

    function clearDetail() {
        $('.clear_dtl_t').html('');
        $('.clear_dtl_i').val('');
        mAptCode = "";
    }

    $("#dtlapt_modal").on('hidden.bs.modal', function(){
        clearDetail();
        searchTable();
    });

    function detail(aptcode) {
        mAptCode = aptcode;
        $("#dtlapt_modal").modal('show');
    }

    $("#dtlapt_modal").on('show.bs.modal', function(){
        $.ajax({
            url: '{{ route('appointment.getaptdetail') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                aptcode : mAptCode
            },
            success: function (response) {
                if(response.status == "success") {
                    var res = response.param;
                    $('#dtl_appointment_code').html(res.code);
                    $('#dtl_round').html(res.round_at);
                    $('#dtl_aptdate').html(res.appointment_date);
                    $('#dtl_apttime').html(res.appointment_time);
                    $('#dtl_order_code').html(res.order_code);
                    $('#dtl_custcode').html(res.cust_code);
                    $('#dtl_custfullname').html(res.fname+' '+res.lname);
                    $('#dtl_custtel').html(res.tel);
                    $('#dtl_custaddr').html(res.addr);
                    $('#dtl_custidcard').html(res.idcard);
                    $('#dtl_custbdate').html(res.bdate);
                    $('#dtl_custage').html(res.bdate);
                    $('#dtl_custbloodtype').html(res.bloodtype);
                    $('#dtl_service_master').html(res.servicemaster_name);
                    $('#dtl_service').html(res.service_name);
                    $('#dtl_service_type').html(res.servicetype_name);
                    $('#note_newapt').html(res.note_newapt ? res.note_newapt : '-');
                    $('#note_sale').val(res.note_sale);
                    $('#note_or').val(res.note_or);
                    $('#note_doctor').val(res.note_doctor);
                    $('#txt_note_cancel').html(res.note_cancel ? res.note_cancel : '-');

                    if (res.status == 0) { var badgestatus = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ยกเลิก</span>'; }
                    if (res.status == 1) { var badgestatus = '<span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">บันทึก</span>'; }
                    if (res.status == 2) { var badgestatus = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอ OR ดำเนินการ</span>'; }
                    if (res.status == 3) { var badgestatus = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รอหมอดำเนินการ</span>'; }
                    if (res.status == 4) { var badgestatus = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">เข้ารับการรักษาแล้ว</span>'; }
                    $('#disp_status').html(badgestatus);

                    switch (res.status) {
                        case 0:
                            $('#btn_apt_sendtoor').hide();
                            $('#btn_apt_cancle').hide();
                            $('#note_sale').prop('disabled', true);
                            $('#disp_note_cancel').show();
                            break;
                        case 1:
                            $('#btn_apt_sendtoor').show();
                            $('#btn_apt_cancle').show();
                            $('#note_sale').prop('disabled', false);
                            $('#disp_note_cancel').hide();
                            
                            break;
                        case 2:
                            $('#btn_apt_sendtoor').hide();
                            $('#btn_apt_cancle').hide();
                            $('#note_sale').prop('disabled', true);
                            $('#disp_note_cancel').hide();
                            break;
                    
                    }

                }
            },
            complete: function () {
            }
        });
    });




    function sendtoOR(aptcode) {
        swal({
            title: "ยืนยันการส่งใบนัดให้ OR",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันการส่งใบนัด",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('appointment.updateaptdetail') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        aptcode : mAptCode,
                        note_sale : $('#note_sale').val(),
                        param : 'to_or'
                    },
                    success: function (response) {
                        if(response.status == "success") {
                            swal({
                                title: "ส่งใบนัดเลขที่ "+response.aptcode+" ไปยัง OR เรียบร้อย",
                                type: "success",
                                confirmButtonText: "ตกลง",
                            });
                        }
                    },
                    complete: function () {
                        $("#dtlapt_modal").modal('hide');
                    }
                });
            }
        });
    }


    $("#aptcancel_modal").on('hidden.bs.modal', function(){
        $('#tmpcancle_aptno').val('');
        $('#note_cancel').val('');
        searchTable();
    });

    
    function cancelAPT(aptcode) {
        $("#aptcancel_modal").modal('show');
        $('#titlecancel_aptcode').html(aptcode);
        $('#tmpcancle_aptno').val(aptcode);
    }

    function confirmCancelAPT(notecancel) {
        var aptcode = $('#tmpcancle_aptno').val();
        if ($('#note_cancel').val() != '') {
            swal({
                title: "ยืนยันยกเลิกใบนัด "+aptcode,
                text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
                type: "warning",
                confirmButtonText: "ยืนยันยกเลิกใบนัด",
                cancelButtonText: 'ยกเลิก',
                showCancelButton: true,
                },
                function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '{{ route('appointment.updateaptdetail') }}',
                        method: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            aptcode : aptcode,
                            note_cancel : $('#note_cancel').val(),
                            param : 'cancel'
                        },
                        success: function (response) {
                            if(response.status == "success") {
                                console.log(response);
                                swal({
                                    title: "ยกเลิกใบนัดเลขที่ "+response.aptcode+" เรียบร้อย",
                                    type: "success",
                                    confirmButtonText: "ตกลง",
                                });
                            }
                        },
                        complete: function () {
                            $("#aptcancel_modal").modal('hide');
                        }
                    });
                }
            });
        } else {
            swal({
                title: "กรุณากรอกเหตุผลการยกเลิกนัด",
                type: "error",
                confirmButtonText: "ตกลง",
            });
        }
       
    }

    </script>
@endsection