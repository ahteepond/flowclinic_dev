@extends('layouts.template')
@section('title','รายงานยอดขายรายวัน (สินค้าและบริการ)') {{-- Title --}}


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
                                                <label class="form-label">สถานะการชำระเงินใบสั่งซื้อ</label>
                                                <select name="paid_status" id="paid_status" class="form-control form-select" data-bs-placeholder="Select Payment Status">
                                                    <option value="0" selected>ยกเลิก</option>
                                                    <option value="1">รอชำระเงิน</option>
                                                    <option value="2">อยู่ระหว่างการชำระเงิน</option>
                                                    <option value="3" selected>ชำระเงินครบแล้ว</option>
                                                    <option value="A">ทั้งหมด</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">วันที่ชำระเงินครบ</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                    <input class="form-control fc-datepicker" id="paid_sdate" placeholder="กรุณาระบุวันที่เริ่ม..." type="text" onchange="validateSearchDatePayment()">
                                                    <div class="input-group-text bg-light text-gray">
                                                        <span>ถึง</span>
                                                    </div>
                                                    <input class="form-control fc-datepicker" id="paid_edate" placeholder="กรุณาระบุวันที่สิ้นสุด..." type="text">
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
        if ($('#paid_sdate').val() != "") {
            $("#paid_edate").prop('disabled', false);
        } else {
            $("#paid_edate").prop('disabled', true);
            $("#paid_edate").val('');
        }
    }

    function setDatePayment() {
        var date = new Date();
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        $('#paid_sdate').val(moment(firstDay).format('YYYY-MM-DD'));
        $('#paid_edate').val(moment(lastDay).format('YYYY-MM-DD'));
        searchTable();
    }

    var dataTable = $('#datatableinfo').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            url: "{{ route('report.dailysalesproductandservice.search') }}",
            data: function( d ) {
                d.paid_status = $('#paid_status :selected').val(),
                d.paid_sdate = $('#paid_sdate').val(),
                d.paid_edate = $('#paid_edate').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "เลขคำสั่งซื้อ", data: 'order_code', name: 'order_code' },
            { title: "สถานะการชำระเงิน", data: 'status_order', name: 'status_order' },
            { title: "ชื่อลูกค้า", data: 'cust_name', name: 'cust_name' },
            { title: "จำนวนที่ชำระทั้งหมด", data: 'price_nettotal', name: 'price_nettotal' },
            { title: "วันที่ชำระเงินครบ", data: 'paiddate', name: 'paiddate' },
        ],
        dom: '<"row"<"col-6"l><"col-6"f>><"row"<"col-6"B><"col-6">>rtip',
        buttons: [
            'copy', 'excel', 'print'
        ]
    });

    dataTable.columns.adjust().draw();
    
    function searchTable() {
        if ($('#paid_sdate').val() == "" && $('#paid_edate').val() == "") {
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

