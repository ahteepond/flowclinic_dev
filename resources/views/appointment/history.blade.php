@extends('layouts.template')
@section('title','ประวัติการนัดหมาย') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customertype') }}">ออกใบนัด</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-xl-3 col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-user me-2"></i>ข้อมูลลูกค้า
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="fs-18 fw-semibold mb-0"><a href="#">CUS-0001</a><br> พงศกร เหล่านิยมไทย</p>
                                        <address>
                                            <span><b>081 234 5678</b></span><br>
                                            เลขที่ 1/2 แขวงลาดพร้าว เขตลาดพร้าว
                                            กรุงเทพมหานคร, 10230
                                        </address>
                                    </div>
                                    <div class="col-lg-12 text-start">
                                        <p class="mb-1">เลขบัตรประชาชน : 1234567898765</p>
                                        <p class="mb-1">วันเกิด : 01/01/2500</p>
                                        <p class="mb-1">อายุ : 65 ปี</p>
                                        <p class="mb-1">กรุ๊ปเลือด : โอ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-md-12 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-history me-2"></i>ประวัติการนัดหมาย
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="h3">ข้อมูลบริการ:</p>
                                        <p class="fs-16 fw-semibold mb-0">ประเภทบริการ: ศัลยกรรมใหญ่</p>
                                        <p class="fs-18 fw-semibold mb-0">บริการ: เสริมหน้าอก (Breast Augmentation)</p>
                                        <p class="fs-16 fw-semibold mb-0">บริการย่อย: ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                        <p class="fs-16 fw-semibold mb-0">จำนวนครั้งที่นัดแล้ว: <span class="fs-20">2 ครั้ง</span></p>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p class="pt-5">สินค้าจากใบสั่งซื้อ <a href="{{ route('order.detail') }}"><b>ORD-0001</b></a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12"><hr></div>
                                    <div class="col-12">
                                        <table id="datatable" class="table table-bordered w-100 border-bottom">

                                            <thead>
                                                <tr>
                                                    <th>ครั้งที่</th>
                                                    <th>เลขที่ใบนัด</th>
                                                    <th>หมอที่ดำเนินการ</th>
                                                    <th>สถานะการรักษา</th>
                                                    <th>วันที่นัดหมาย</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td class="text-center">APT-0001</td>
                                                    <td class="text-start">คุณหมอ คนที่หนึ่ง</td>
                                                    <td class="text-center"><span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Success</span></td>
                                                    <td>07-04-2022<br>09:00:00</td>
                                                    <td class="text-center">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td class="text-center">APT-0002</td>
                                                    <td class="text-start">คุณหมอ คนที่สอง</td>
                                                    <td class="text-center"><span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Waiting</span></td>
                                                    <td>07-04-2022<br>09:00:00</td>
                                                    <td class="text-center">
                                                        <a id="" href="{{ route('appointment.new') }}" class="btn btn-sm btn-danger">
                                                            ยกเลิกนัด
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>

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

    var dataTable = $('#datatable').DataTable({});
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    </script>
@endsection

