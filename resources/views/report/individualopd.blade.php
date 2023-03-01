
@extends('layouts.template')
@section('title','รายงานข้อมูลการรักษารายคน (OPD)') {{-- Title --}}


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
                                                <label class="form-label">รหัสลูกค้า</label>
                                                <input type="text" class="form-control" id="custcode">
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">เลข Order</label>
                                                <input type="text" class="form-control" id="ordercode">
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">เลขใบนัด</label>
                                                <input type="text" class="form-control" id="appointmentcode">
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

    });

    var dataTable = $('#datatableinfo').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            url: "{{ route('report.individualopd.search') }}",
            data: function( d ) {
                d.custcode = $('#custcode ').val(),
                d.ordercode = $('#ordercode ').val(),
                d.appointmentcode = $('#appointmentcode ').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "วันที่บันทึก OPD", data: 'created', name: 'created' },
            { title: "เลขที่ใบสั่งซื้อ", data: 'orderscode', name: 'orderscode' },
            { title: "เลขที่ใบนัด", data: 'aptcode', name: 'aptcode' },
            { title: "รหัสลูกค้า", data: 'custcode', name: 'custcode' },
            { title: "ชื่อลูกค้า", data: 'custname', name: 'custname' },
            { title: "บริการ", data: 'service_name', name: 'service_name' },
            { title: "บริการหลัก", data: 'servicemaster_name', name: 'servicemaster_name' },
            { title: "ประเภทบริการ", data: 'servicetype_name', name: 'servicetype_name' },
            { title: "รักษาครั้งที่", data: 'round_at', name: 'round_at' },
            { title: "บันทึก OPD", data: 'note', name: 'note', width: '20%' },
            { title: "ผู้บันทึก OPD", data: 'doctor', name: 'doctor' },
        ],
        dom: '<"row"<"col-6"l><"col-6"f>><"row"<"col-6"B><"col-6">>rtip',
        buttons: [
            'copy', 'excel', 'print'
        ]
    });

    dataTable.columns.adjust().draw();
    


    function searchTable() {
        dataTable.ajax.reload();
    }

    </script>
@endsection

