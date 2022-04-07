@extends('layouts.template')
@section('title','รายละเอียดการชำระเงิน') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('checkpayment') }}">ตรวจสอบการชำระเงิน</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <p>สถานะการชำระเงิน: <span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3 ms-2">Waiting for approve</span></p>
                                <div class="form-group mt-5">
                                    <label class="form-label">เลขที่ชำระเงิน</label>
                                    <h2>PAY-0001</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 text-end border-bottom border-lg-0">
                                <h5 class="mt-5">วันที่ชำระเงิน: 07-04-2022 09:00:00</h5>
                                <h5 class="mt-2">ผู้รับเงิน: บัญชี ทำดี</h5>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-lg-6">
                                <p class="h3">ข้อมูลลูกค้า:</p>
                                <p class="fs-18 fw-semibold mb-0"><a href="#">CUS-0001</a> พงศกร เหล่านิยมไทย</p>
                                <address>
                                    <span><b>081 234 5678</b></span><br>
                                    เลขที่ 1/2 แขวงลาดพร้าว เขตลาดพร้าว
                                    กรุงเทพมหานคร, 10230
                                </address>
                            </div>
                            <div class="col-lg-6 text-end">
                                <p class="mb-3 fs-18 fw-semibold">เลขที่ใบสั่งซื้อ: <a class="text-primary" href="{{ route('order.detail') }}" >ODR-0001</a></p>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12">
                                <div class="expanel expanel-default">
                                    <div class="expanel-body row">
                                        <div class="col-2">
                                            <h1 class="text-gray mb-2">#2</h1>
                                        </div>
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">รูปแบบการชำระ</label>
                                                        <h2>ปกติ</h2>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">วิธีการชำระเงิน</label>
                                                        <h2>บัตรเครดิต</h2>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">จำนวนเงินที่ชำระ</label>
                                                        <h2 class="text-primary">10,000.-</h2>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">หลักฐานการชำระเงิน</label>
                                                        <a href="#" class="btn btn-sm btn-outline-dark">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary my-2 ms-2" onclick="disapprovePayment()">ไม่อนุมัติ</button>
                                <button class="btn btn-primary my-2 ms-2"  onclick="approvePayment()">อนุมัติ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 END -->

    </div>
    <!-- CONTAINER END -->
@endsection


@section('script')

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
    });

    function disapprovePayment() {
        swal({
            title: "ยืนยันไม่อนุมัติการชำระเงิน",
            type: "warning",
            confirmButtonText: "ไม่อนุมัติ",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                location.href = '{{ route('checkpayment') }}';
            }
        });
    }

    function approvePayment() {
        swal({
            title: "ยืนยันอนุมัติการชำระเงิน",
            type: "warning",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                location.href = '{{ route('checkpayment') }}';
            }
        });
    }


    </script>
@endsection

