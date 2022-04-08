@extends('layouts.template')
@section('title','บันทึกเข้ารับการรักษา') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admitted') }}">เข้ารับการรักษา</a></li>
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
                                    <i class="fa fa-file-text me-2"></i>รายละเอียดใบนัด
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
                                        <div class="form-group mb-0">
                                            <label class="form-label">เลขที่ใบนัด</label>
                                            <h2>APT-0001</h2>
                                        </div>
                                        <p class="h3">นัดครั้งที่: <span class="text-info fs-30">3</span></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12"><hr></div>
                                    <div class="col-12 pb-3">

                                    </div>
                                    <div class="col-lg-6 pb-3">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto fw-semibold fs-20">หมอ</div>
                                            <div class="col-auto my-auto">
                                                <p class="mb-0">EMP-D001 คุณหมอ คนที่หนึ่ง</p>
                                            </div>
                                            <div class="col my-auto">
                                                <a id="" href="#" class="btn btn-sm btn-outline-primary">
                                                    เปลี่ยนหมอ
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pb-3">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto fw-semibold fs-20">วันที่นัด</div>
                                            <div class="col my-auto">
                                                <p class="mb-0">วันที่ 08/04/20022<br>เวลา 09:00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pb-3">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto fw-semibold fs-20">พยาบาล</div>
                                            <div class="col my-auto">
                                                <a id="" href="#" class="btn btn-sm btn-outline-primary">
                                                    เลือกพยาบาล
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <ol class="order-list">
                                                    <li>พยาบาล คนที่หนึ่ง</li>
                                                    <li>พยาบาล คนที่สอง</li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row mb-3">
                                            <div class="col-12 my-auto fw-semibold fs-20 pb-3">วัน เวลา ที่เข้ารับการรักษา</div>
                                            <div class="col-auto my-auto">
                                                <div class="form-group mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                        <input class="form-control fc-datepicker" name="order_date" id="order_date" placeholder="กรุณาระบุวันที่..." type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                                        </div>
                                                        <input class="form-control" id="tp3" placeholder="กรุณาระบุเวลา..." type="text">
                                                        <button class="btn btn btn-outline-primary br-ts-0 br-bs-0" id="setTimeButton">Set Current Time</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12"><hr></div>
                                    <div class="col-12 text-center">
                                        <a href="javascript:void(0)" onclick="confirmAdmitted()" class="btn btn-primary btn-rounded waves-effect waves-light">บันทึกเข้ารับการรักษา</a>
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


    <script>
    $( document ).ready(function() {

    });

    var dataTable = $('#datatable').DataTable({});
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    function confirmAdmitted() {
        swal({
            title: "ยืนยันบันทึกเข้ารับการรักษา",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการเปลี่ยนสถานะใบนัดนี้ เพื่อให้ทราบว่าเข้ารับการรักษา",
            type: "warning",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                location.href = '{{ route('admitted') }}';
            }
        });
    }

    </script>
@endsection

