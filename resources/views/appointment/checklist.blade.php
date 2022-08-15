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

    function detail(aptcode) {
        // ดูรายละเอียดนัดหมาย
    }

    function sendtoOR(aptcode) {
        // ส่งนัดหมายให้ OR
    }

    function cancleAPT(aptcode) {
        // ยกเลิกนัดหมาย
    }

    </script>
@endsection

