@extends('layouts.template')
@section('title','Dashboard') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->


        <!-- ROW-1 -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mt-2">
                                        <h6 class="">Total Users</h6>
                                        <h2 class="mb-0 number-font">44,278</h2>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="chart-wrapper mt-1">
                                            <canvas id="saleschart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-muted fs-12"><span class="text-secondary"><i
                                            class="fe fe-arrow-up-circle  text-secondary"></i> 5%</span>
                                    Last week</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mt-2">
                                        <h6 class="">Total Profit</h6>
                                        <h2 class="mb-0 number-font">67,987</h2>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="chart-wrapper mt-1">
                                            <canvas id="leadschart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-muted fs-12"><span class="text-pink"><i
                                            class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>
                                    Last 6 days</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mt-2">
                                        <h6 class="">Total Expenses</h6>
                                        <h2 class="mb-0 number-font">$76,965</h2>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="chart-wrapper mt-1">
                                            <canvas id="profitchart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-muted fs-12"><span class="text-green"><i
                                            class="fe fe-arrow-up-circle text-green"></i> 0.9%</span>
                                    Last 9 days</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="mt-2">
                                        <h6 class="">Total Cost</h6>
                                        <h2 class="mb-0 number-font">$59,765</h2>
                                    </div>
                                    <div class="ms-auto">
                                        <div class="chart-wrapper mt-1">
                                            <canvas id="costchart"
                                                class="h-8 w-9 chart-dropshadow"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <span class="text-muted fs-12"><span class="text-warning"><i
                                            class="fe fe-arrow-up-circle text-warning"></i> 0.6%</span>
                                    Last year</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW-Note -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">
                    <h3>My Note</h3>
                    <ul class="list-group">
                        <li class="list-group-item p-5">
                            <h4>แก้ Flow</h4>
                            <del><p class="m-0">- [บัญชี] ตรวจสอบการชำระเงิน > 1.ยกเลิก payment ก่อน 2.ถึงจะยกเลิก order ได้ (เคสลูกค้าเปลี่ยน product)</p></del>
                            <del><p class="m-0">- สถานะใบนัด > หมอ > เลือกนัดรักษาครั้งต่อไป > stamp สถานะ 'นัดรักษาครั้งต่อไป'</p></del>
                            <del><p class="m-0">- - แก้ตอน load modal</p></del>
                            <br>
                            <h4>เมนู รายงาน</h4>
                            <del><p class="m-0">- รายงานข้อมูลลูกค้า</p></del>
                            <del><p class="m-0">- รายงานข้อมูลการักษารายคน (OPD)</p></del>
                            <del><p class="m-0">- รายงานสินค้าและบริการ</p></del>
                            <p class="m-0">- รายงานยอดขายรายวัน (ใบเสร็จ) -> จับจากการจ่ายเงิน และบัญชีต้องอนุมัติแล้วด้วย</p>
                            <p class="m-0">- รายงานยอดขายรายวัน (สินค้าและบริการ) -> จับจากการจ่ายเงินครบแล้ว และได้รับบริการเสร็จแล้ว (จับด้วย status 'เข้ารับการรักษาแล้ว')</p>
                            <br>
                            <h4>เมนู Dashboard</h4>
                            <p class="m-0">ข้อมูลสรุป</p>
                            <br>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ROW-1 END -->

    </div>
    <!-- CONTAINER END -->
@endsection


@section('script')
    <script src="{{ asset('assets/js/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexchart/irregular-data-series.js') }}"></script>

    <script>
    $( document ).ready(function() {
        // alert( "ready!" );
    });



    </script>
@endsection

