@extends('layouts.template')
@section('title','คำสั่งซื้อใหม่') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('order') }}">จัดการใบสั่งซื้อ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->


        <!-- ROW-1 -->
        <div class="row justify-content-center" id="space_emptype">
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-user-plus text-success fa-3x"></i>
                        <h2 class="mt-4 mb-2 number-font">ลูกค้าใหม่</h2>
                        <a class="mt-3 btn btn-outline-primary" href="javascript:void(0)" onclick="empTypeSelect('new')">เลือก</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-users text-info fa-3x"></i>
                        <h2 class="mt-4 mb-2 number-font">ลูกค้าเก่า</h2>
                        <a class="mt-3 btn btn-outline-primary" href="javascript:void(0)" onclick="empTypeSelect('old')">เลือก</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 END -->


        <!-- ROW-New Customer -->
        <div class="row justify-content-center" id="space_newemp">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fa fa-user-plus text-success me-2 fa-2x"></i> เพิ่มลูกค้าใหม่
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">ชื่อ</label>
                                <input type="text" class="form-control required" placeholder="กรุณากรอกชื่อ...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">นามสกุล</label>
                                <input type="text" class="form-control required" placeholder="กรุณากรอกนามสกุล...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">วันเกิด</label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" placeholder="กรุณาระบุวันเกิด..." type="text">
                                </div>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เลขบัตรประชาชน</label>
                                <input type="text" class="form-control required" placeholder="กรุณากรอกเลขบัตรประชาชน...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">กรุ๊ปเลือด</label>
                                <input type="text" class="form-control required" placeholder="กรุณากรอกกรุ๊ปเลือด...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">อีเมล์</label>
                                <input type="email" class="form-control required"
                                    placeholder="กรุณากรอกอีเมล์...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control required" placeholder="กรุณากรอกเบอร์โทรศัพท์...">
                            </div>
                            <div class="control-group form-group mb-0 col-md-12">
                                <label class="form-label">ที่อยู่</label>
                                <textarea class="form-control required" placeholder="กรุณากรอกที่อยู่..." rows="4"></textarea>
                            </div>
                            {{-- <div class="control-group form-group mb-0 col-md-12">
                                <label class="form-label">รูปภาพ</label>
                                <div class="control-group form-group  row">
                                    <div class="col-lg-12 col-sm-12">
                                        <input type="file" class="dropify" onchange="readURL(this);"
                                            data-height="180" />
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-12 text-center">
                                <hr>
                                <a href="javascript:void(0)" onclick="backtoEmpType(1)" class="btn btn-outline-dark btn-rounded waves-effect waves-light me-2"><i class="fa fa-chevron-left me-2"></i> ย้อนกลับ</a>
                                <a href="javascript:void(0)" onclick="confirmAddNewEmp()" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fa fa-chevron-right me-2"></i> ต่อไป</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-New Customer END -->


        <!-- ROW-Old Customer -->
        <div class="row justify-content-center" id="space_oldemp">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fa fa-users text-info me-2 fa-2x"></i> เลือกลูกค้า
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
                        <div class="row">
                            <div class="control-group form-group col-md-12">
                                <label class="form-label">รหัสลูกค้า</label>
                                <h3 class="mb-0">CUS-0001</h3>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">ชื่อ</label>
                                <p class="mb-0">พงศกร</p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">นามสกุล</label>
                                <p class="mb-0">เหล่านิยมไทย</p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">วันเกิด</label>
                                <p class="mb-0">1/1/2500</p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เลขบัตรประชาชน</label>
                                <p class="mb-0">1234567898765</p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">กรุ๊ปเลือด</label>
                                <p class="mb-0">โอ</p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">อีเมล์</label>
                                <p class="mb-0">mail@mail.com</p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เบอร์โทรศัพท์</label>
                                <p class="mb-0">081 234 5678</p>
                            </div>
                            <div class="control-group form-group mb-0 col-md-12">
                                <label class="form-label">ที่อยู่</label>
                                <p class="mb-0">123/45 เขตลาดพร้าว แขวงลาดพร้าว จังหวัดกรุงเทพมหานคร</p>
                            </div>
                            <div class="col-12 text-center">
                                <hr>
                                <a href="javascript:void(0)" onclick="backtoEmpType(2)" class="btn btn-outline-dark btn-rounded waves-effect waves-light me-2"><i class="fa fa-chevron-left me-2"></i> ย้อนกลับ</a>
                                <a href="javascript:void(0)" onclick="confirmSelectEmp()" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fa fa-chevron-right me-2"></i> ต่อไป</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-Old Customer END -->


        <!-- ROW-Select Service -->
        <div class="row" id="space_selectservice">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            คำสั่งซื้อใหม่
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                                        <h2>ODR-0002</h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-end border-bottom border-lg-0">
                                    <h5 class="mt-5">วันที่ใบสั่งซื้อ: 07-04-2022 09:00:00</h5>
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
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="row mt-5">
                                <div class="col-12">
                                    <p class="h3">เลือกบริการ:</p>
                                </div>
                                <div class="control-group form-group col-md-6 mb-0">
                                    <label class="form-label">บริการ</label>
                                    <select name="service" class="form-control form-select mb-2" data-bs-placeholder="กรุณาเลือกและบริการ...">
                                        <option value="">เสริมหน้าอก (Breast Augmentation)</option>
                                    </select>
                                </div>
                                <div class="control-group form-group col-md-6 mb-0">
                                    <label class="form-label">บริการย่อย</label>
                                    <select name="service_type" class="form-control form-select mb-2" data-bs-placeholder="กรุณาเลือกบริการย่อย...">
                                        <option value="">ซิลิโคน ซิลิเมต (Silicone Silimed)</option>
                                        <option value="">ซิลิโคน ยูโร (Silicone Euro)</option>
                                        <option value="">ซิลิโคน เซบบิน (Silicone Sebbin)</option>
                                        <option value="">ซิลิโคน เมนเตอร์ (Silicone Mentor)</option>
                                    </select>
                                </div>
                                <div class="control-group form-group col-md-12 mb-0">
                                    <label class="form-label">รายละเอียดเพิ่มเติม</label>
                                    <p class="mb-2">ไม่เกิน 400cc เกิน 3,000</p>
                                </div>
                                <div class="control-group form-group col-md-4 mb-0">
                                    <label class="form-label">ราคาปกติ</label>
                                    <h3 class="fw-bold fs-25 text-muted mb-2"><del>45,000.-</del></h3>
                                </div>
                                <div class="control-group form-group col-md-4 mb-0">
                                    <label class="form-label">ราคาโปรโมชั่น</label>
                                    <p class="fw-bold fs-25 text-primary mb-2">26,900.-</p>
                                </div>
                                <div class="control-group form-group col-md-4 mb-0">
                                    <label class="form-label">จำนวน</label>
                                    <div class="input-group input-indec input-indec1 w-100 w-sm-50 mt-3">
                                        <span class="input-group-btn">
                                            <button type="button" class="minus btn btn-white btn-number btn-icon br-7 ">
                                                <i class="fa fa-minus text-muted"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity" class="form-control text-center qty h3" value="1">
                                        <span class="input-group-btn">
                                            <button type="button" class="quantity-right-plus btn btn-white btn-number btn-icon br-7 add">
                                                <i class="fa fa-plus text-muted"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <a href="javascript:void(0)" class="btn btn-lg btn-success">+ เพิ่มรายการ</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <h4 class="fw-bold mt-3">รายการที่เลือก</h4>
                                </div>
                                <div class="col-mb-12 mb-3">
                                    <div class="table-responsive push">
                                        <table class="table table-bordered table-hover mb-0 text-nowrap">
                                            <tbody>
                                                <tr class=" ">
                                                    <th>No.</th>
                                                    <th class="text-center">บริการ</th>
                                                    <th class="text-center">บริการย่อย</th>
                                                    <th class="text-center">ราคา</th>
                                                    <th class="text-center">จำนวน</th>
                                                    <th class="text-center">ราคาทั้งหมด</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">1</td>
                                                    <td>
                                                        <p class="font-w600 mb-1">เสริมหน้าอก (Breast Augmentation)</p>
                                                    </td>
                                                    <td class="text-start">ซิลิโคน ซิลิเมต (Silicone Silimed)</td>
                                                    <td class="text-end">26,900.-</td>
                                                    <td class="text-center">2</td>
                                                    <td class="text-end">53,800.-</td>
                                                    <td class="text-center"><a href="javascript:void(0)" title="ลบ" class="btn text-danger"><i class="fe fe-trash"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2</td>
                                                    <td>
                                                        <p class="font-w600 mb-1">เสริมหน้าอก (Breast Augmentation)</p>
                                                    </td>
                                                    <td class="text-start">ซิลิโคน ยูโร (Silicone Euro)</td>
                                                    <td class="text-end">27,900.-</td>
                                                    <td class="text-center">2</td>
                                                    <td class="text-end">55,800.-</td>
                                                    <td class="text-center"><a href="javascript:void(0)" title="ลบ" class="btn text-danger"><i class="fe fe-trash"></i></a></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-uppercase text-end">ราคารวมทั้งหมด</td>
                                                    <td class="text-end h5">109,600.-</td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-uppercase text-end">ส่วนลดท้ายบิล (Vocher)</td>
                                                    <td class="text-end h5">1,000.-</td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="fw-bold text-uppercase text-end">ราคารวมสุทธิ</td>
                                                    <td class="fw-bold text-end h4">108,600.-</td>
                                                    <td class="text-center"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <label class="custom-control custom-checkbox-md form-label">
                                        <input type="checkbox" class="custom-control-input" name="" value="1" checked>
                                        <span class="custom-control-label fw-bolder h4 mt-2">ส่วนลดท้ายบิล</span>
                                    </label>
                                </div>
                                <div class="control-group form-group col-md-6">
                                    <label class="form-label">ประเภทส่วนลดท้ายบิล</label>
                                    <select name="service_type" class="form-control form-select" data-bs-placeholder="กรุณาเลือกประเภทส่วนลด...">
                                        <option value="">Vocher</option>
                                    </select>
                                </div>
                                <div class="control-group form-group col-md-6">
                                    <label class="form-label">จำนวนเงินส่วนลด (บาท)</label>
                                   <input type="text" class="form-control" value="1000">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <h4 class="fw-bold mt-3">หมายเหตุ</h4>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <div class="form-floating floating-label1">
                                    <textarea class="form-control" placeholder="Comments" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">กรอกหมายเหตุ</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <hr>
                            <h4 class="fw-bold mt-3">ผู้ขาย</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> ผู้ขายคนที่ 1</label>
                                <select class="form-control select2-show-search form-select" data-placeholder="กรุณาเลือกผู้ขายคนที่ 1...">
                                        <option label="กรุณาเลือกผู้ขายคนที่ 1..."></option>
                                        <option value="A">ผู้ขาย A</option>
                                        <option value="B">ผู้ขาย B</option>
                                        <option value="C">ผู้ขาย C</option>
                                        <option value="D">ผู้ขาย D</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> ผู้ขายคนที่ 2</label>
                                <select class="form-control select2-show-search form-select" data-placeholder="กรุณาเลือกผู้ขายคนที่ 2...">
                                        <option label="กรุณาเลือกผู้ขายคนที่ 2..."></option>
                                        <option value="0">ไม่ระบุ</option>
                                        <option value="A">ผู้ขาย A</option>
                                        <option value="B">ผู้ขาย B</option>
                                        <option value="C">ผู้ขาย C</option>
                                        <option value="S">ผู้ขาย D</option>
                                    </select>
                            </div>
                        </div>
                        <div class="col-12 text-center my-5">
                            <hr>
                            <a href="javascript:void(0)" onclick="confirmOrder()" class="btn btn-primary btn-rounded waves-effect waves-light"><i class="fa fa-chevron-right me-2"></i> บันทึกคำสั่งซื้อ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-Select Service END -->


         <!-- ROW-Select Service -->
        <div class="row" id="space_addpayment">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-8 text-start">
                            <h3 class="card-title">การชำระเงิน</h3>
                        </div>
                        <div class="col-4 text-end">
                            <a class="btn btn-sm btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modal_payment_add"><i class="fa fa-plus me-2"></i>เพิ่มบันทึกชำระเงิน</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                                    <h2>ODR-0002</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 text-end border-bottom border-lg-0">
                                <h5 class="mt-5">วันที่ใบสั่งซื้อ: 07-04-2022 09:00:00</h5>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="expanel expanel-default" role="button" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modal_payment_add">
                                    <div class="expanel-body row">
                                        <div class="col-12 text-center">
                                            <h4 class="text-gray mb-0 p-7">ยังไม่มีการชำระเงิน คลิกเพื่อเพิ่มบันทึกชำระเงิน</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <div class="expanel expanel-default">
                                <div class="expanel-body row">
                                    <div class="col-2">
                                        <h1 class="text-gray mb-2">#1</h1>
                                    </div>
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">วันที่ชำระเงิน</label>
                                                    <h4>07-04-2022 09:00:00</h4>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">รูปแบบการชำระ</label>
                                                    <h2>เงินมัดจำ</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">วิธีการชำระเงิน</label>
                                                    <h2>เงินสด</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">จำนวนเงินที่ชำระ</label>
                                                    <h2 class="text-primary">2,000.-</h2>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">สถานะการชำระเงิน</label>
                                                    <span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">Waiting for approve</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="expanel-footer text-end">
                                    <a class="btn btn-sm btn-dark my-2 ms-2" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modal_payment_edit">แก้ไข</a>
                                    <button class="btn btn-sm btn-danger my-2 ms-2">ยกเลิกบันทึกชำระเงิน</button>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-12 text-center">
                            <hr>
                            <a href="javascript:void(0)" onclick="gotoThisOrder()" class="btn btn-primary btn-rounded waves-effect waves-light mr-2"><i class="fa fa-chevron-right me-2"></i>ไปยังหน้าของใบสั่งซื้อ</a>
                            <a href="javascript:void(0)" onclick="gotoThisOrder()" class="btn btn-info btn-rounded waves-effect waves-light"><i class="fa fa-chevron-right me-2"></i>ทำใบนัด</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-Select Service END -->

    </div>
    <!-- CONTAINER END -->
@endsection



@section('other')
<div class="modal fade" id="modal_payment_add">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fa fa-plus me-2"></i>เพิ่มบันทึกชำระเงิน</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body p-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">รูปแบบการชำระ</label>
                            <select name="payment_case" id="payment_case" class="form-control form-select">
                                <option value="" selected disabled>กรุณาเลือก...</option>
                                <option value="1">มัดจำ</option>
                                <option value="2">ปกติ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">วิธีการชำระเงิน</label>
                            <select name="payment_case" id="payment_case" class="form-control form-select">
                                <option value="" selected disabled>กรุณาเลือก...</option>
                                <option value="1">เงินสด</option>
                                <option value="2">บัตรเครดิต</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">จำนวนเงินที่ชำระ</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">หลักฐานการชำระเงิน</label>
                            <div class="control-group form-group  row">
                                <div class="col-lg-12 col-sm-12">
                                    <input type="file" class="dropify" onchange="readURL(this);"
                                        data-height="180" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary">บันทึก</button> <button class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')

    <!-- FILE UPLOADES JS -->
    <script src="{{ asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
        setViewDefault();
    });

    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        width: '100%'
    });

    function setViewDefault() {
        $('#space_emptype').show();
        $('#space_newemp').hide();
        $('#space_oldemp').hide();
        $('#space_selectservice').hide();
        $('#space_addpayment').hide();
    }

    function empTypeSelect(param) {
        switch (param) {
            case 'new':
                $('#space_emptype').hide();
                $('#space_newemp').fadeIn();
                break;
            case 'old':
                $('#space_emptype').hide();
                $('#space_oldemp').fadeIn();
                break;
        }
    }

    function backtoEmpType(v) {
        switch (v) {
            case 1:
                $('#space_newemp').hide();
                $('#space_emptype').fadeIn();
                break;
            case 2:
                $('#space_oldemp').hide();
                $('#space_emptype').fadeIn();
                break;
        }
    }

    function confirmAddNewEmp() {
        swal({
            title: "ยืนยันข้อมูลลูกค้า",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันข้อมูลถูกต้อง",
            cancelButtonText: 'แก้ไขข้อมูล',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $('#space_newemp').hide();
                $('#space_selectservice').fadeIn();
            }
        });
    }

    function confirmSelectEmp() {
        swal({
            title: "ยืนยันข้อมูลลูกค้า",
            type: "warning",
            confirmButtonText: "ยืนยันข้อมูลถูกต้อง",
            cancelButtonText: 'แก้ไขข้อมูล',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $('#space_oldemp').hide();
                $('#space_selectservice').fadeIn();
            }
        });
    }

    function confirmOrder() {
        swal({
            title: "ยืนยันบันทึกคำสั่งซื้อ",
            type: "warning",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $('#space_selectservice').hide();
                $('#space_addpayment').fadeIn();
            }
        });
    }

    function gotoThisOrder() {
        location.href = '{{ route('order.detail') }}';
    }

    </script>
@endsection

