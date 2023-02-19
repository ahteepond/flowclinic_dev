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
                                                <label class="form-label">เลขที่ Order</label>
                                                <input type="text" name="order_no" id="order_no" class="form-control">
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">วันที่นัดหมาย</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                    <input class="form-control fc-datepicker" name="appointment_date" id="appointment_date" placeholder="กรุณาระบุวันที่นัดหมาย..." type="text">
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

        @yield('all_list')


    </div>
    <!-- CONTAINER END -->
@endsection

@section('other')
<div class="modal fade" id="dtlapt_modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <div class="modal-body p-6">
                <!-- ROW  -->
                <div class="row">
                    <div class="col-md">
                        <p class="mb-3 fs-18">เลขที่ใบนัด <b><span class="text-primary fw-semibold clear_dtl_t" id="dtl_appointment_code"></span></b></p>
                    </div>
                    <div class="col-md text-end" id="disp_status"></div>
                    <input type="text" style="display:none;" id="tmp_status"> {{--  //////// --}}
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
                <div class="row mt-6" id="disptext_emp">
                    <div class="col-md-12">
                        <p class="h4 fw-semibold">ผู้ดำเนินการรักษา</p>
                        <hr class="my-1">
                    </div>
                    <div class="col-md">
                        <p class="fs-14 mb-0"><span class="fw-semibold">หมอ : </span><span class="" id="disp_doc"></span></p>
                    </div>
                    <div class="col-md">
                        <p class="fs-14 mb-0"><span class="fw-semibold">OR คนที่ 1 : </span><span class="" id="disp_or1"></span></p>
                        <p class="fs-14 mb-0"><span class="fw-semibold">OR คนที่ 2 : </span><span class="" id="disp_or2"></span></p>
                    </div>
                </div>
                <div class="row mt-6" id="disptext_nextapt">
                    <div class="col-md-12">
                        <p class="h3 fw-semibold text-primary"><i class="fa fa fa-bell text-warning"></i> นัดรักษาครั้งต่อไป</p>
                        <hr class="my-1">
                    </div>
                </div>
                <div class="row mt-6" id="disptext_opd">
                    <div class="col-md-12">
                        <p class="h4 fw-semibold">บันทึกประวัติ OPD</p>
                        <hr class="my-1">
                    </div>
                    <div class="col-md-auto">
                        <button type="button" class="btn btn-secondary mb-3 btn-block" onclick="gotoOPD()">รายละเอียด OPD</button>
                    </div>
                </div>

                @yield('detail_waittingadmit')
                @yield('detail_admitted')

                <div class="row mt-6" id="space_note">
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
                        <ul class="task-list" id="historynote">
                        </ul>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-md-12 text-center">
                        @yield('detail_button')
                        <button class="btn btn-danger my-2 ms-2" onclick="cancelAPT()" id="btn_apt_cancle">ยกเลิกนัด</button>
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
                <button class="btn btn-danger my-2 ms-2 pd-x-25" onclick="confirmCancelAPT()">ยกเลิกนัด</button>
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
                d.orderno = $('#order_no').val(),
                d.date = $('#appointment_date').val(),
                d.status = $('#appointment_status :selected').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "เลขที่ใบนัด", data: 'aptcode', name: 'aptcode' },
            { title: "รหัสลูกค้า", data: 'custcode', name: 'custcode' },
            { title: "ชื่อลูกค้า", data: 'custfullname', name: 'custfullname' },
            { title: "สถานะใบนัด", data: 'aptstatus', name: 'aptstatus' },
            { title: "หมอ", data: 'doctorname', name: 'aptstatus' },
            { title: "นัดครั้งต่อไป", data: 'aptnextflag', name: 'aptnextflag' },
            { title: "วันเวลานัดหมาย", data: 'aptdatetime', name: 'aptdatetime' },
            { title: "วันที่สร้าง", data: 'created', name: 'created' },
        ],
        'columnDefs': [
            { "className": "text-center", "targets": [0,4,5,6,7] },
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
        $('#tmpcancle_aptno').val('');
        $('#note_cancel').val('');
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
                    $('#txt_note_cancel').html(res.note_cancel ? res.note_cancel : '-');
                    $('#tmpcancle_aptno').val(res.code);
                    $('#titlecancel_aptcode').html(res.code);
                    setTimeout(() => { 
                        $('#empdoctor').val(res.doctor);
                        $('#empdoctor').trigger('change');
                        $('#empor1').val(res.or_1);
                        $('#empor1').trigger('change');
                        $('#empor2').val(res.or_2);
                        $('#empor2').trigger('change');
                    }, 300)
                    
                    
                    var hnote = '';
                    for (var i = 0; i < response.note.length; i++) {
                        hnote += '<li class="d-sm-flex"><div><i class="task-icon bg-secondary"></i>';
                        hnote += '<h6 class="fw-semibold">';
                        hnote += '<p class="fw-semibold mb-1 text-muted">'+response.note[i].status_text+'</p>';
                        hnote += '<span class="text-primary me-1">'+response.note[i].emp_posi_name+'</span>';
                        hnote += '<span>'+response.note[i].emp_fname_th+' '+response.note[i].emp_lname_th+'</span>';
                        hnote += '<span class="text-muted fs-11 ms-2 fw-normal">'+response.note[i].created_at+'</span>';
                        hnote += '</h6>';
                        if (response.note[i].note) {
                            hnote += '<div class="media-body border p-4 overflow-visible br-5">';
                            hnote += '<p class="font-13 text-dark mb-0">'+response.note[i].note+'</p>';
                            hnote += '</div>';
                        }
                        hnote += '</div></li>';
                    }
                    $('#historynote').html(hnote);

                    if (res.status == 6 || res.status == 7) {
                        $('#disp_doc').html(res.doctor+' - '+response.empdoc.emp_fname_th+' '+response.empdoc.emp_lname_th);
                        $('#disp_or1').html(res.or_1 ? (res.or_1+' - '+response.empor1.emp_fname_th+' '+response.empor1.emp_lname_th) : ' - ');
                        $('#disp_or2').html(res.or_2 ? (res.or_2+' - '+response.empor2.emp_fname_th+' '+response.empor2.emp_lname_th) : ' - ');
                    }
                    
                    if (res.status == 0) { var badgestatus = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ยกเลิก</span>'; }
                    if (res.status == 1) { var badgestatus = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอการแก้ไข (S)</span>'; }
                    if (res.status == 2) { var badgestatus = '<span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">บันทึก (S)</span>'; }
                    if (res.status == 3) { var badgestatus = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รอ OR ดำเนินการ</span>'; }
                    if (res.status == 4) { var badgestatus = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอการแก้ไข (O)</span>'; }
                    if (res.status == 5) { var badgestatus = '<span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">บันทึก (O)</span>'; }
                    if (res.status == 6) { var badgestatus = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รอหมอดำเนินการ</span>'; }
                    if (res.status == 7) { var badgestatus = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">เข้ารับการรักษาแล้ว</span>'; }
                    if (res.status == 90) { var badgestatus = '<span class="badge bg-success-transparent rounded-pill text-primary p-2 px-3">นัดรักษาครั้งต่อไป</span>'; }
                    $('#disp_status').html(badgestatus);
                    $('#tmp_status').val(res.status);
                    dispBtnAPTDetail(res.status);
                    if(res.nextapt_flag == 1) {
                        $('#disptext_nextapt').show();
                    } else {
                        $('#disptext_nextapt').hide();
                    }
                }
            },
            complete: function () {
            }
        });
    });

    function dispBtnAPTDetail(status) {
        // 1 | Set button display first
        $('#btn_apt_savedraf').hide();
        $('#btn_apt_recall').hide();
        $('#btn_apt_send').hide();
        $('#btn_apt_cancle').hide();
        $('#note').prop('disabled', true);
        $('#disp_note_cancel').hide();
        $('#disptext_emp').hide();
        $('#disptext_opd').hide();
        $('#disptext_nextapt').hide();
        
        // 2 | Set button display by status
        switch (status) {
            case 0:
                break;
            case 1:
                $('#btn_apt_savedraf').show();
                $('#btn_apt_send').show();
                // $('#btn_apt_send').show();
                $('#btn_apt_cancle').show();
                $('#note').prop('disabled', false);
                break;
            case 2:
                $('#btn_apt_savedraf').show();
                $('#btn_apt_send').show();
                // $('#btn_apt_send').show();
                $('#btn_apt_cancle').show();
                $('#note').prop('disabled', false);
                break;
            case 3:
                $('#btn_apt_savedraf').show();
                $('#btn_apt_recall').show();
                $('#btn_apt_send').show();
                $('#disptext_nextapt').show();
                $('#disptext_opd').show();
                $('#note').prop('disabled', false);
                break;
            case 4:
                $('#btn_apt_savedraf').show();
                $('#btn_apt_recall').show();
                $('#btn_apt_send').show();
                $('#btn_apt_cancle').show();
                $('#space_emp').hide();
                $('#note').prop('disabled', false);
                break;
            case 5:
                // $('#btn_apt_savedraf').show();
                $('#btn_apt_recall').show();
                $('#btn_apt_send').show();
                $('#btn_apt_cancle').show();
                $('#space_emp').hide();
                $('#note').prop('disabled', false);
                break;
            case 6:
                $('#btn_apt_recall').show();
                $('#btn_apt_send').show();
                $('#btn_apt_next').show();
                $('#disptext_emp').show();
                $('#space_emp').show();
                $('#disptext_nextapt').hide();
                $('#disptext_opd').hide();
                $('#note').prop('disabled', false);
                break;
            case 7:
                $('#space_note').hide();
                $('#space_emp').hide();
                $('#space_opd').hide();
                $('#space_nextapt').hide();
                $('#disptext_emp').show();
                $('#disptext_opd').show();
                $('#disptext_nextapt').show();
                break;
        }
    }


    function updateAPT(param, alerttxt) {
        swal({
            title: alerttxt,
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันการอัพเดทสถานะใบนัด",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                var arrdata = "";
                switch (param) {
                    case 0:
                        arrdata = {
                            _token: "{{ csrf_token() }}",
                            aptcode : mAptCode,
                            note_cancel : $('#note_cancel').val(),
                            param : param
                        }
                        break;
                    case 1:
                    arrdata = {
                        _token: "{{ csrf_token() }}",
                        aptcode : mAptCode,
                        note : $('#note').val(),
                        param : param
                    }
                    break;
                    case 2:
                        arrdata = {
                            _token: "{{ csrf_token() }}",
                            aptcode : mAptCode,
                            doctor : $('#empdoctor :selected').val(),
                            note : $('#note').val(),
                            param : param
                        }
                    break;
                    case 3:
                        arrdata = {
                            _token: "{{ csrf_token() }}",
                            aptcode : mAptCode,
                            note : $('#note').val(),
                            param : param
                        }
                    break;
                    case 4:
                    arrdata = {
                        _token: "{{ csrf_token() }}",
                        aptcode : mAptCode,
                        note : $('#note').val(),
                        param : param
                    }
                    break;
                    case 5:
                        arrdata = {
                            _token: "{{ csrf_token() }}",
                            aptcode : mAptCode,
                            note : $('#note').val(),
                            or_1: $('#empor1 :selected').val(),
                            or_2: ($('#empor2 :selected').val() == 0 ? '' : $('#empor2 :selected').val()),
                            param : param
                        }
                        break;
                    case 6:
                        arrdata = {
                            _token: "{{ csrf_token() }}",
                            aptcode : mAptCode,
                            note : $('#note').val(),
                            opd: $('#opd').val(),
                            doctor : $('#empdoctor :selected').val(),
                            param : param
                        }
                        break;
                    case 7:
                        var checkBox = document.getElementById("chknextapt");  
                        arrdata = {
                            _token: "{{ csrf_token() }}",
                            aptcode : mAptCode,
                            note : $('#note').val(),
                            chknextapt: (checkBox.checked == true ? 1 : null),
                            or_1: $('#empor1 :selected').val(),
                            or_2: ($('#empor2 :selected').val() == 0 ? '' : $('#empor2 :selected').val()),
                            opd: $('#opd').val(),
                            param : param
                        }
                        break;
                    default:
                        arrdata = {
                            _token: "{{ csrf_token() }}",
                            aptcode : mAptCode,
                            param : param
                        }
                        break;
                }
                
                $.ajax({
                    url: '{{ route('appointment.updateaptdetail') }}',
                    method: 'post',
                    data: arrdata,
                    success: function (response) {
                        if(response.status == "success") {
                            swal({
                                title: "อัพเดทสถานะใบนัดเลขที่ "+response.aptcode+" เรียบร้อย",
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

    
    function cancelAPT() {
        $("#aptcancel_modal").modal('show');
    }

    function confirmCancelAPT() {
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
                            param : 0
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
                            $("#dtlapt_modal").modal('hide');
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

    function gotoOPD() {
        // var url = "{{ route('opd.detail', '')}}"+"/"+ordercode;
        var url = "{{ route('opd.detail')}}";
        window.open(url, "_blank");
    }
    
    
    </script>
    @yield('js_detail')
@endsection

