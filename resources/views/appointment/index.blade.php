@extends('layouts.template')
@section('title','ออกใบนัด') {{-- Title --}}


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
                                <div class="card-title">
                                    <i class="fa fa-search me-2"></i>ค้นหาบริการของลูกค้า
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <label class="form-label">ค้นหาด้วย</label>
                                        <select name="fillter_type" id="fillter_type" class="form-control form-select">
                                            <option value="1" selected>รหัสลูกค้า</option>
                                            <option value="2">เลขบัตรประชาชน</option>
                                            <option value="2">เบอร์โทรศัพท์</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <label class="form-label">คำที่ค้นหา</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-auto mt-auto">
                                        <button type="button"onclick="searchTable()" class="btn btn-outline-primary mb-4 ms-2"><i class="fa fa-search me-2"></i>ค้นหา</button>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-file-text me-2"></i>รายการบริการสำหรับทำนัดหมาย
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12"><p class="h3">ข้อมูลลูกค้า:</p></div>
                                    <div class="col-lg-6">
                                        <p class="fs-18 fw-semibold mb-0"><a href="#">CUS-0001</a> พงศกร เหล่านิยมไทย</p>
                                        <address>
                                            <span><b>081 234 5678</b></span><br>
                                            เลขที่ 1/2 แขวงลาดพร้าว เขตลาดพร้าว
                                            กรุงเทพมหานคร, 10230
                                        </address>
                                    </div>
                                    <div class="col-lg-6 text-end">
                                        <p class="mb-1">เลขบัตรประชาชน : 1234567898765</p>
                                        <p class="mb-1">วันเกิด : 01/01/2500</p>
                                        <p class="mb-1">อายุ : 65 ปี</p>
                                        <p class="mb-1">กรุ๊ปเลือด : โอ</p>
                                    </div>
                                </div>
                                <div class="table-responsive mt-5">
                                    <table id="datatable" class="table table-bordered w-100 table-hover border-bottom">
                                        <thead>
                                            <tr class=" ">
                                                <th>No.</th>
                                                <th class="text-center">วัน เวลา ที่นัด</th>
                                                <th class="text-center">บริการ</th>
                                                <th class="text-center">บริการย่อย</th>
                                                <th class="text-center">จำนวนครั้งที่นัด</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center">07-04-2022<br>09:00:00</td>
                                                <td><p class="font-w600 mb-1">เสริมหน้าอก (Breast Augmentation)</p></td>
                                                <td class="text-start">ซิลิโคน ซิลิเมต (Silicone Silimed)</td>
                                                <td class="text-center">0</td>
                                                <td class="text-center">
                                                    <a id="" href="{{ route('appointment.history') }}" class="btn btn-sm btn-info">
                                                        ดูประวัติ
                                                    </a>
                                                    <a id="" href="{{ route('appointment.new') }}" class="btn btn-sm btn-primary">
                                                        ทำใบนัด
                                                    </a>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td class="text-center">07-04-2022<br>09:00:00</td>
                                                <td><p class="font-w600 mb-1">เสริมหน้าอก (Breast Augmentation)</p></td>
                                                <td class="text-start">ซิลิโคน ยูโร (Silicone Euro)</td>
                                                <td class="text-center">2</td>
                                                <td class="text-center">
                                                    <button id="" type="button" class="btn btn-sm btn-info">
                                                        ดูประวัติ
                                                    </button>
                                                    <button id="" type="button" class="btn btn-sm btn-primary">
                                                        ทำใบนัด
                                                    </button>
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

    var dataTable = $('#datatable').DataTable({});
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    </script>
@endsection

