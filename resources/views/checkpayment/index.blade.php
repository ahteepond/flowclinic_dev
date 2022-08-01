@extends('layouts.template')
@section('title','ตรวจสอบการชำระเงิน') {{-- Title --}}


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
                                                <label class="form-label">สถานะการอนุมัติ</label>
                                                <select name="status_approve" id="status_approve" class="form-control form-select">
                                                    <option value="1" selected>รออนุมัติ</option>
                                                    <option value="2">ไม่อนุมัติ/รอแก้ไข</option>
                                                    <option value="3">อนุมัติแล้ว</option>
                                                    <option value="0">ยกเลิก</option>
                                                    <option value="">ทั้งหมด</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                                                <input type="text" name="order_no" id="order_no" class="form-control">
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
                            <div class="card-header row">
                                <div class="col-8 text-start">
                                    <h3 class="card-title">รายการตรวจสอบการชำระเงิน</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatableinfo" class="table table-bordered w-100 border-bottom">

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
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
    });

    var dataTable = $('#datatableinfo').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            url: "{{ route('checkpayment.list') }}",
            data: function( d ) {
                d.status =  $('#status_approve :selected').val(),
                d.searchorderno = $('#order_no').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "เลขที่ใบสั่งซื้อ", data: 'paymentscode', name: 'paymentscode' },
            { title: "เลขที่ชำระเงิน", data: 'orderscode', name: 'orderscode' },
            { title: "ชื่อลูกค้า", data: 'customerfullname', name: 'customerfullname' },
            { title: "ผู้รับเงิน", data: 'empfullname', name: 'empfullname' },
            { title: "จำนวนเงินที่ชำระ", data: 'pricepaid', name: 'pricepaid' },
            { title: "สถานะการชำระเงิน", data: 'paymentstatus', name: 'paymentstatus' },
            { title: "วันที่รับเงิน", data: 'paymentdate', name: 'paymentdate' },
            { title: "Action", data: 'action', name: 'action' },
        ],
        'columnDefs': [
            { "className": "text-center", "targets": [0,6,7,8] },
        ]
    });
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    function clearFillter() {
        $('#order_no').val('');
        $('#status_approve').val('');
    }

    function detail(paymentcode) {
        var url = "{{ route('checkpayment.view', '')}}"+"/"+paymentcode;
        location.href = url;
    }

    function gotoOrderCode(ordercode) {
        var url = "{{ route('orders.detail', '')}}"+"/"+ordercode;
        window.open(url, "_blank");
    }


    </script>
@endsection

