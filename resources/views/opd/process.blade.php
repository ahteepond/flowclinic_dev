@extends('layouts.template')
@section('title','บันทึกข้อมูล OPD') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('opd') }}">บันทึกประวัติ OPD</a></li>
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
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pb-3">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto fw-semibold fs-20">วันที่นัด</div>
                                            <div class="col my-auto">
                                                <p class="mb-0">วันที่ 08/04/2022<br>เวลา 09:00</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pb-3">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto fw-semibold fs-20">พยาบาล</div>
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
                                            <div class="col my-auto">
                                                <p class="mb-0">วันที่ 17/04/2022<br>เวลา 09:00</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 my-auto fw-semibold fs-20 pb-3">ประวัติ OPD</div>
                                    <div class="col-md-12">
                                        <div class="form-group pb-3">
                                            <textarea name="" id="" rows="5" class="form-control" placeholder="กรอกประวัติ OPD..."></textarea>
                                            <a href="javascript:void(0)" class="btn btn-primary btn-rounded waves-effect waves-light mt-3"><i class="fa fa-plus me-2" aria-hidden="true"></i>เพิ่มประวัติ OPD</a>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="media mb-2 overflow-visible d-block d-sm-flex">
                                            <div class="me-3 mb-2">
                                                <i class="fa fa-stethoscope fs-16 me-1 p-3 bg-primary-transparent text-primary bradius" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body overflow-visible">
                                                <div class="border mb-2 p-4 br-5">
                                                    <nav class="nav float-end">
                                                        <div class="dropdown">
                                                            <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit me-1"></i> Edit</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 me-1"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </nav>
                                                    <h5 class="mt-0">EMP-D001 คุณหมอ คนที่หนึ่ง</h5>
                                                    <span><i class="fe fe-thumb-up text-danger"></i></span>
                                                    <p class="font-13 text-muted">Lorem ipsum dolor sit amet, quis Neque porro quisquam est, nostrud exercitation ullamco laboris commodo consequat. There’s an old maxim that states, “No fun for the writer, no fun for the reader.”No matter
                                                        what industry you’re working in, as a blogger, you should live and die by this statement.</p>
                                                    <p class="mb-0">08/04/2022 18:00</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="media mb-2 overflow-visible d-block d-sm-flex">
                                            <div class="me-3 mb-2">
                                                <i class="fa fa-stethoscope fs-16 me-1 p-3 bg-primary-transparent text-primary bradius" aria-hidden="true"></i>
                                            </div>
                                            <div class="media-body overflow-visible">
                                                <div class="border mb-2 p-4 br-5">
                                                    <nav class="nav float-end">
                                                        <div class="dropdown">
                                                            <a class="nav-link text-muted fs-16 p-0 ps-4" href="javascript:;" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fe fe-more-vertical"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-edit me-1"></i> Edit</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="fe fe-trash-2 me-1"></i> Delete</a>
                                                            </div>
                                                        </div>
                                                    </nav>
                                                    <h5 class="mt-0">EMP-D001 คุณหมอ คนที่หนึ่ง</h5>
                                                    <span><i class="fe fe-thumb-up text-danger"></i></span>
                                                    <p class="font-13 text-muted">Lorem ipsum dolor sit amet, quis Neque porro quisquam est, nostrud exercitation ullamco laboris commodo consequat. There’s an old maxim that states, “No fun for the writer, no fun for the reader.”No matter
                                                        what industry you’re working in, as a blogger, you should live and die by this statement.</p>
                                                    <p class="mb-0">08/04/2022 18:05</p>
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

    function confirmSaveOPD() {
        swal({
            title: "ยืนยันบันทึกข้อมูล OPD",
            type: "warning",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                location.href = '{{ route('opd') }}';
            }
        });
    }

    </script>
@endsection

