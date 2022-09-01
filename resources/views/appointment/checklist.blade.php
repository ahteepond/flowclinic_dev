@extends('layouts.template')
@section('title','ตรวจสอบการนัดหมาย') {{-- Title --}}


@section('content')
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
                                                    <option value="1">บันทึก</option>
                                                    <option value="2">รอ OR ดำเนินการ</option>
                                                    {{-- <option value="3">รอหมอดำเนินการ</option> --}}
                                                    {{-- <option value="4">เข้ารับการรักษาแล้ว</option> --}}
                                                    <option value="0">ยกเลิก</option>
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



        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    รายการการนัดหมาย
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="datatable" class="table table-bordered w-100 border-bottom">

                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW END -->

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
                        <p class="mb-3 fs-18">เลขที่ใบนัด <b><span class="text-primary fw-semibold clear_dtl_t" id="dtl_appointment_code">APT2208-00001</span></b></p>
                    </div>
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
                                                    <h3 class="fw-bold mb-0 text-primary mt-1 clear_dtl_t" id="dtl_round">4</h3>
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
                                                    <h4 class="fw-bold mb-0 mt-2 text-blue clear_dtl_t" id="dtl_aptdate">2022-08-11</h4>
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
                                                    <h4 class="fw-bold mb-0 mt-2 text-blue clear_dtl_t" id="dtl_apttime">14:30</h4>
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
                        <p class="">สินค้าจากใบสั่งซื้อ <a href="#"><b><span class="clear_dtl_t" id="dtl_order_code">ODR2206-00001</span></b></a></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <p class="h4 fw-semibold">ข้อมูลลูกค้า</p>
                        <hr class="my-1">
                    </div>
                    <div class="col-md-12">
                        <p class="fs-14 mb-0"><span class="fw-semibold text-primary clear_dtl_t" id="dtl_custcode">CUS-00001 </span><span class="clear_dtl_t" id="dtl_custfullname">สายใจ เกาะมหาสนุก</span></p>
                    </div>
                    <div class="col-md-12">
                        <p class="fs-14 mb-0"><span class="fw-semibold">การติดต่อ : </span></p>
                        <p class="fs-14 mb-0"><span class="clear_dtl_t" id="dtl_custtel">0611111111</span></p>
                        <p class="fs-14 mb-0"><span class="clear_dtl_t" id="dtl_custaddr">21-29 ถ.นาคราช แขวงคลองมหานาคเขตป้อมปราบ จ.กรุงเทพฯ 10100</span></p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">เลขบัตรประชาชน : </span><span class="clear_dtl_t" id="dtl_custidcard">7771402217260</span></p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">วันเกิด : </span><span class="clear_dtl_t" id="dtl_custbdate">2001-05-01</span></p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">อายุ : </span><span class="clear_dtl_t" id="dtl_custage">20</span> ปี</p>
                    </div>
                    <div class="col-md-auto">
                        <p class="fs-14 mb-0"><span class="fw-semibold">กรุ๊ปเลือด : </span><span class="clear_dtl_t" id="dtl_custbloodtype">โอ</span></p>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-md-12">
                        <p class="h4 fw-semibold">ข้อมูลบริการ</p>
                        <hr class="my-1">
                    </div>
                    <div class="col-md">
                        <p class="fs-14 mb-0"><span class="fw-semibold">บริการ : </span><span class="clear_dtl_t" id="dtl_service_master">เสริมหน้าอก (Breast Augmentation)</span></p>
                        <p class="fs-14 mb-0"><span class="clear_dtl_t" id="dtl_service">ซิลิโคน ซิลิเมต (Silicone Silimed)</span></p>
                    </div>
                    <div class="col-md">
                        <p class="fs-14 mb-0"><span class="fw-semibold">ประเภทบริการ : </span><span class="clear_dtl_t" id="dtl_service_type">ศัลยกรรมใหญ่</span></p>
                    </div>
                </div>

                <div class="row mt-6">
                    <div class="col-12"><p class="h4 fw-semibold">บันทึก</p></div>
                    <hr class="my-1">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating floating-label1">
                                <textarea class="form-control clear_dtl_i" placeholder="Comments" id="note_sale" style="height: 140px"></textarea>
                                <label for="note_sale"><i class="fa fa-sticky-note-o me-2 text-azure"></i>Sale</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating floating-label1">
                                <textarea disabled class="form-control clear_dtl_i" placeholder="Comments" id="note_or" style="height: 140px"></textarea>
                                <label for="note_or"><i class="fa fa-sticky-note-o me-2 text-azure"></i>OR</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-floating floating-label1">
                                <textarea disabled class="form-control clear_dtl_i" placeholder="Comments" id="note_doctor" style="height: 140px"></textarea>
                                <label for="note_doctor"><i class="fa fa-sticky-note-o me-2 text-azure"></i>Doctor</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-primary my-2 ms-2" onclick="sendtoOR('')">ส่งใบนัดให้ OR</button>
                        <button class="btn btn-danger my-2 ms-2" onclick="cancleAPT('')">ยกเลิกนัด</button>
                        <button class="btn btn-light my-2 ms-2" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
                <!-- ROW END -->
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
            url: "{{ route('appointmentlist.list') }}",
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
            { title: "Action", data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        'columnDefs': [
            { "className": "text-center", "targets": [0,3,4,5,6] },
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
    });

    function detail(aptcode) {
        mAptCode = aptcode;
        $("#dtlapt_modal").modal('show');
    }

    $("#dtlapt_modal").on('show.bs.modal', function(){
        alert('mAptCode'); /////current task
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

            }
        });
    }

    function cancleAPT(aptcode) {
        swal({
            title: "ยืนยันยกเลิกใบนัด",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันยกเลิกใบนัด",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {

            }
        });
    }

    </script>
@endsection

