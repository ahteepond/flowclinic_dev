@extends('layouts.template')
@section('title','รายงานยอดขายรายวัน (ใบเสร็จ)') {{-- Title --}}


@section('content')

    <style>
        .dt-buttons {
        position: relative!important;
        float: left!important;
        left: 0!important;
        margin-bottom: 15px;
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
                                <h3 class="card-title"><i class="fa fa-search" aria-hidden="true"></i> ค้นหา</h3>
                            </div>
                            <div class="card-body py-2">
                                <div class="row">
                                    <div class="col-12 text-start">
                                        <div class="row align-items-end">
                                            <div class="form-group col-auto">
                                                <label class="form-label">สถานะอนุมัติการชำระเงิน</label>
                                                <select name="payment_status" id="payment_status" class="form-control form-select" data-bs-placeholder="Select Payment Status">
                                                    <option value="0" selected>ยกเลิก</option>
                                                    <option value="1">รออนุมัติ</option>
                                                    <option value="2">ไม่อนุมัติ/รอแก้ไข</option>
                                                    <option value="3" selected>อนุมัติแล้ว</option>
                                                    <option value="A">ทั้งหมด</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">วันที่ชำระเงิน</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                    <input class="form-control fc-datepicker" id="payment_sdate" placeholder="กรุณาระบุวันที่เริ่ม..." type="text" onchange="validateSearchDatePayment()">
                                                    <div class="input-group-text bg-light text-gray">
                                                        <span>ถึง</span>
                                                    </div>
                                                    <input class="form-control fc-datepicker" id="payment_edate" placeholder="กรุณาระบุวันที่สิ้นสุด..." type="text">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button"onclick="searchTable()" class="btn btn-outline-primary mb-4 btn-block"><i class="fa fa-search me-2"></i>ค้นหา</button>
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
                            <div class="card-header row">
                                <div class="col-8 text-start">
                                    <h3 class="card-title">รายการ</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatableinfo" class="table table-bordered w-100 border-bottom dt-responsive">

                                    </table>
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
    {{-- <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
        setDatePayment();
        validateSearchDatePayment();
    });

    function validateSearchDatePayment() {
        if ($('#payment_sdate').val() != "") {
            $("#payment_edate").prop('disabled', false);
        } else {
            $("#payment_edate").prop('disabled', true);
            $("#payment_edate").val('');
        }
    }

    function setDatePayment() {
        var date = new Date();
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        $('#payment_sdate').val(moment(firstDay).format('YYYY-MM-DD'));
        $('#payment_edate').val(moment(lastDay).format('YYYY-MM-DD'));
        searchTable();
    }

    var dataTable = $('#datatableinfo').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            url: "{{ route('report.dailysalesreceipt.search') }}",
            data: function( d ) {
                d.payment_status = $('#payment_status :selected').val(),
                d.payment_sdate = $('#payment_sdate').val(),
                d.payment_edate = $('#payment_edate').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "เลขการชำระเงิน", data: 'payment_code', name: 'service_name' },
            { title: "เลขคำสั่งซื้อ", data: 'order_code', name: 'servicemaster_name' },
            { title: "ประเภทการชำระเงิน", data: 'paymenttype_name', name: 'servicetype_name' },
            { title: "ไฟล์หลักฐาน", data: 'evidence_file', name: 'service_description' },
            { title: "บันทึกการชำระเงิน", data: 'remark', name: 'remark' },
            { title: "จำนวนเงิน", data: 'price_paid', name: 'price_paid' },
            { title: "วันที่ชำระเงิน", data: 'payment_date', name: 'payment_date' },
            { title: "สถานะอนุมัติการชำระเงิน", data: 'payment_status', name: 'payment_status' },
        ],
        dom: '<"row"<"col-6"l><"col-6"f>><"row"<"col-6"B><"col-6">>rtip',
        buttons: [
            'copy', 'excel', 'print'
        ]
    });

    dataTable.columns.adjust().draw();
    
    function searchTable() {
        if ($('#payment_sdate').val() == "" && $('#payment_edate').val() == "") {
            setDatePayment();
            validateSearchDatePayment();
        }
        dataTable.ajax.reload();
    }

    function detail(paymentcode) {
        var url = "{{ route('checkpayment.view', '')}}"+"/"+paymentcode;
        window.open(url, "_blank");
    }

    function gotoOrderCode(ordercode) {
        var url = "{{ route('orders.detail', '')}}"+"/"+ordercode;
        window.open(url, "_blank");
    }


    </script>
@endsection

