@extends('layouts.template')
@section('title','จัดการใบสั่งซื้อ') {{-- Title --}}


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
                                                <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                                                <input type="text" name="orders_no" id="orders_no" class="form-control">
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">วันที่ใบสั่งซื้อ</label>
                                                <div class="input-group">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                    </div>
                                                    <input class="form-control fc-datepicker" name="orders_date" id="orders_date" placeholder="กรุณาระบุวันที่ใบสั่งซื้อ..." type="text">
                                                </div>
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">สถานะการชำระเงินของใบสั่งซื้อ</label>
                                                <select name="status_payment" id="status_payment" class="form-control form-select">
                                                    <option value="" selected>All</option>
                                                    <option value="1">Waiting</option>
                                                    <option value="2">During</option>
                                                    <option value="3">Success</option>
                                                    <option value="0">Failed</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-auto">
                                                <label class="form-label">สถานะการสั่งซื้อ</label>
                                                <select name="status_orders" id="status_orders" class="form-control form-select">
                                                    <option value="" selected>All</option>
                                                    <option value="1">Waiting</option>
                                                    <option value="2">Processing</option>
                                                    <option value="3">Success</option>
                                                    <option value="0">Void</option>
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
                            <div class="card-header row">
                                <div class="col-8 text-start">
                                    <h3 class="card-title">รายการใบสั่งซื้อ</h3>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{ route('orders.new') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>New</a>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    {{-- <table id="datatable" class="table table-bordered w-100 border-bottom">

                                        <thead>
                                            <tr>
                                                <th>เลขที่ใบสั่งซื้อ</th>
                                                <th>ยอดรวมทั้งหมด</th>
                                                <th>ชื่อลูกค้า</th>
                                                <th>สถานะการชำระเงินของใบสั่งซื้อ</th>
                                                <th>สถานะการสั่งซื้อ</th>
                                                <th>วันที่สั่งซื้อ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="{{ route('orders.detail') }}" title="" class="text-primary">ODR-0001</a></td>
                                                <td class="text-end">108,600.-</td>
                                                <td>พงศกร เหล่านิยมไทย</td>
                                                <td class="text-center"><span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">อยู่ระหว่างการชำระเงิน</span></td>
                                                <td class="text-center"><span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">สำเร็จ</span></td>
                                                <td>07-04-2022<br>09:00:00</td>
                                            </tr>
                                        </tbody>

                                    </table> --}}
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

    function clearFillter() {
        $('#orders_no').val('');
        $('#orders_date').val('');
        $('#status_payment').val('');
        $('#status_orders').val('');
    }

    var dataTable = $('#datatableinfo').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            url: "{{ route('orders.list') }}",
            data: function( d ) {
                // d.active = $('#status :selected').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "เลขที่ใบสั่งซื้อ", data: 'orderscode', name: 'orderscode' },
            { title: "ยอดรวมทั้งหมด", data: 'pricenettotal', name: 'pricenettotal' },
            { title: "ชื่อลูกค้า", data: 'custname', name: 'custname' },
            { title: "สถานะใบสั่งซื้อ", data: 'statusorder', name: 'statusorder' },
            { title: "สถานะการชำระเงินของใบสั่งซื้อ", data: 'statusorderpayment', name: 'statusorderpayment' },
            { title: "วันที่สั่งซื้อ", data: 'created', name: 'created' },
        ],
        'columnDefs': [
            { "className": "text-center", "targets": [0,4,5] },
            { "className": "text-right", "targets": [3] },
        ]
    });
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    function detail(ordercode) {
        var url = "{{ route('orders.detail', '')}}"+"/"+ordercode;
        location.href = url;
    }




    </script>
@endsection

