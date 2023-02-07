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
                                <p>สถานะการชำระเงิน:
                                    @switch($res->payment_status)
                                        @case(0)
                                        <span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3 ms-2">ยกเลิก</span>
                                            @break
                                        @case(1)
                                            <span class="badge bg-info-transparent rounded-pill text-info p-2 px-3 ms-2">รออนุมัติ</span>
                                            @break
                                        @case(2)
                                        <span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3 ms-2">ไม่อนุมัติ/รอแก้ไข</span>
                                            @break
                                        @case(3)
                                            <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3 ms-2">อนุมัติแล้ว</span>
                                            @break
                                    @endswitch
                                </p>
                                <div class="form-group mt-5">
                                    <label class="form-label">เลขที่ชำระเงิน</label>
                                    <h2>{{ $res->code }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 text-end border-bottom border-lg-0">
                                <h5 class="mt-5">วันที่ชำระเงิน: {{ $res->paymentdate }}</h5>
                                <h5 class="mt-2">ผู้รับเงิน: {{ $res->employeefname }} {{ $res->employeelname }}</h5>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-lg-6">
                                <p class="h3">ข้อมูลลูกค้า:</p>
                                <p class="fs-18 fw-semibold mb-0"><span class="text-primary">{{ $res->customercode }}</span> {{ $res->customerfname }} {{ $res->customerlname }}</p>
                                <address>
                                    <span><b>{{ $res->tel }}</b></span><br>
                                    {{ $res->addr }}
                                </address>
                            </div>
                            <div class="col-lg-6 text-end">
                                <p class="mb-3 fs-18 fw-semibold">เลขที่ใบสั่งซื้อ: <a class="text-primary" href="javascript:void(0)" onclick="gotoOrderCode('{{ $res->order_code }}')">{{ $res->order_code }}</a></p>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12">
                                <div class="expanel expanel-default">
                                    <div class="expanel-body row">
                                        <div class="col-2">
                                            <h1 class="text-gray mb-2">#{{ $res->round }}</h1>
                                        </div>
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">ประเภทการชำระเงิน</label>
                                                        <h2>{{ $res->paymenttypename }}</h2>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">จำนวนเงินที่ชำระ</label>
                                                        <h2 class="text-primary">@price($res->price_paid)</h2>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label class="form-label">หมายเหตุ/บันทึก</label>
                                                        <p>{{ ($res->remark == "" ? "-" : $res->remark) }}</p>
                                                    </div>
                                                </div>

                                                @switch($res->evidence)
                                                    @case(0)
                                                        @break
                                                    @case(1)
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label class="form-label">หลักฐานการชำระเงิน</label>
                                                                <a href="/payment_evidence/{{ $res->evidence_file }}" class="btn btn-sm btn-outline-dark" target="_blank">ดูหลักฐานการชำระเงิน</a>
                                                            </div>
                                                        </div>
                                                        @break
                                                @endswitch

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-12 text-center">
                                @switch($res->payment_status)
                                    @case(0)
                                        @break
                                    @case(1)
                                        <button class="btn btn-dark my-2 ms-2" onclick="canclePayment('{{ $res->code }}')">ยกเลิก</button>
                                        <button class="btn btn-primary my-2 ms-2" onclick="disapprovePayment('{{ $res->code }}')">ไม่อนุมัติ</button>
                                        <button class="btn btn-primary my-2 ms-2"  onclick="approvePayment('{{ $res->code }}')">อนุมัติ</button>
                                        @break
                                    @case(2)
                                        <button class="btn btn-danger my-2 ms-2" onclick="canclePayment('{{ $res->code }}')">ยกเลิก</button>
                                        @break
                                    @case(3)
                                        @break
                                @endswitch
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

    function disapprovePayment(paymentcode) {
        var operator = "{{ session()->get('session_empcode') }}";
        swal({
            title: "ยืนยันไม่อนุมัติการชำระเงิน",
            text: "หลังจากกดยืนยันแล้ว ระบบจะส่งข้อมูลการชำระเงินนี้กลับไปแก้ไข",
            type: "warning",
            confirmButtonText: "ยืนยันไม่อนุมัติการชำระเงิน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('payment.disapprove') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        payment_code: paymentcode,
                        operator: operator,
                    },
                    success: function (response) {
                        if(response.status == "success") {
                            swal({
                                title: "ไม่อนุมัติการชำระเงินเรียบร้อย ("+paymentcode+")",
                                type: "success",
                                confirmButtonText: "ตกลง",
                            },
                            function(isConfirm) {
                                location.href = "{{ route('checkpayment.view', '')}}"+"/"+paymentcode;
                            });
                        }
                    },
                    complete: function () {
                    }
                });
            }
        });
    }

    function approvePayment(paymentcode) {
        var approver = "{{ session()->get('session_empcode') }}";
        swal({
            title: "ยืนยันอนุมัติการชำระเงิน",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันอนุมัติการชำระเงิน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('payment.approve') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        payment_code: paymentcode,
                        approver: approver,
                    },
                    success: function (response) {
                        if(response.status == "success") {
                            swal({
                                title: "อนุมัติการชำระเงินเรียบร้อย ("+paymentcode+")",
                                type: "success",
                                confirmButtonText: "ตกลง",
                            },
                            function(isConfirm) {
                                location.href = "{{ route('checkpayment.view', '')}}"+"/"+paymentcode;
                            });
                        }
                    },
                    complete: function () {
                    }
                });
            }
        });
    }


    function canclePayment(paymentcode) {
        var operator = "{{ session()->get('session_empcode') }}";
        swal({
            title: "ยืนยันยกเลิกการชำระเงิน ("+paymentcode+")",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันยกเลิกการชำระเงิน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('payment.cancle') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        payment_code: paymentcode,
                        operator: operator,
                    },
                    success: function (response) {
                        if(response.status == "success") {
                            swal({
                                title: "ยกเลิกการชำระเงินเรียบร้อย ("+paymentcode+")",
                                type: "success",
                                confirmButtonText: "ตกลง",
                            },
                            function(isConfirm) {
                                location.href = "{{ route('checkpayment.view', '')}}"+"/"+paymentcode;
                            });
                        }
                    },
                    complete: function () {
                    }
                });
            }
        });
    }

    function gotoOrderCode(ordercode) {
        var url = "{{ route('orders.detail', '')}}"+"/"+ordercode;
        window.open(url, "_blank");
    }


    </script>
@endsection

