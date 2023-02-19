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
                    <li class="breadcrumb-item"><a href="{{ route('orders') }}">จัดการใบสั่งซื้อ</a></li>
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
                                <label class="form-label">ชื่อ <span class="text-red">*</span></label>
                                <input type="text" class="form-control required" id="n_fname" placeholder="กรุณากรอกชื่อ...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">นามสกุล <span class="text-red">*</span></label>
                                <input type="text" class="form-control required" id="n_lname" placeholder="กรุณากรอกนามสกุล...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">วันเกิด</label>
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                    </div><input class="form-control fc-datepicker" id="n_birthdate" placeholder="กรุณาระบุวันเกิด..." type="text">
                                </div>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เลขบัตรประชาชน <span class="text-red">*</span></label>
                                <input type="text" class="form-control required numbers-only" id="n_idcard" maxlength="13" placeholder="กรุณากรอกเลขบัตรประชาชน...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">กรุ๊ปเลือด</label>
                                <input type="text" class="form-control required" id="n_bloodtype" placeholder="กรุณากรอกกรุ๊ปเลือด...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">อีเมล์</label>
                                <input type="email" class="form-control required" id="n_email" placeholder="กรุณากรอกอีเมล์...">
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เบอร์โทรศัพท์ <span class="text-red">*</span></label>
                                <input type="text" class="form-control required numbers-only" id="n_tel" maxlength="10" placeholder="กรุณากรอกเบอร์โทรศัพท์...">
                            </div>
                            <div class="control-group form-group mb-0 col-md-12">
                                <label class="form-label">ที่อยู่</label>
                                <textarea class="form-control required" id="n_addr" placeholder="กรุณากรอกที่อยู่..." rows="4"></textarea>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">ประเภทลูกค้า</label>
                                <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทลูกค้า" id="n_customertype"></select>
                            </div>
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
                                <select name="filter_type" id="filter_type" class="form-control form-select">
                                    <option value="code" selected>รหัสลูกค้า</option>
                                    <option value="idcard">เลขบัตรประชาชน</option>
                                    <option value="tel">เบอร์โทรศัพท์</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <div class="form-group">
                                    <label class="form-label">คำที่ค้นหา</label>
                                    <input type="text" class="form-control" id="filter_text">
                                </div>
                            </div>
                            <div class="col-auto mt-auto">
                                <button type="button"onclick="searchCustomer()" id="searcholdcust" class="btn btn-outline-primary mb-4 ms-2"><i class="fa fa-search me-2"></i>ค้นหา</button>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row" id="rescustinfo" style="display: none;">
                            <div class="control-group form-group col-md-12">
                                <label class="form-label">รหัสลูกค้า</label>
                                <h3 class="mb-0" id="o_custcode"></h3>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">ชื่อ</label>
                                <p class="mb-0" id="o_fname"></p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">นามสกุล</label>
                                <p class="mb-0" id="o_lname"></p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">วันเกิด</label>
                                <p class="mb-0" id="o_birthdate">/p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เลขบัตรประชาชน</label>
                                <p class="mb-0" id="o_idcard"></p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">กรุ๊ปเลือด</label>
                                <p class="mb-0" id="o_bloodtype"></p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">อีเมล์</label>
                                <p class="mb-0" id="o_email"></p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">เบอร์โทรศัพท์</label>
                                <p class="mb-0" id="o_tel"></p>
                            </div>
                            <div class="control-group form-group col-md-12">
                                <label class="form-label">ที่อยู่</label>
                                <p class="mb-0" id="o_addr"></p>
                            </div>
                            <div class="control-group form-group col-md-6">
                                <label class="form-label">ประเภทลูกค้า</label>
                                <p class="mb-0" id="o_custtype">ลูกค้าทั่วไป</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <hr>
                                <a href="javascript:void(0)" onclick="backtoEmpType(2)" class="btn btn-outline-dark btn-rounded waves-effect waves-light me-2"><i class="fa fa-chevron-left me-2"></i> ย้อนกลับ</a>
                                <a href="javascript:void(0)" onclick="confirmSelectCust()" id="btnselectcust" class="btn btn-primary btn-rounded waves-effect waves-light disabled"><i class="fa fa-chevron-right me-2"></i> ต่อไป</a>
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
                                        <h2 id="orderno">ODR-<i class="text-primary">NEW</i></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 text-end border-bottom border-lg-0">
                                    <h5 class="mt-5">วันที่ใบสั่งซื้อ: <span id="ordercreated_at" class=""></span></h5>
                                </div>
                            </div>
                            <div class="row pt-5">
                                <div class="col-lg-6">
                                    <p class="h3">ข้อมูลลูกค้า:</p>
                                    <p class="fs-18 fw-semibold mb-0"><a href="#" id="customercode"></a> <span id="fullname"></span></p>
                                    <address>
                                        <b><span id="tel"></span></b><br>
                                        <span id="addr"></span>
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
                                    <div class="form-group">
                                        <label class="form-label"> ประเภทบริการ</label>
                                        <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทบริการ" id="servicetype" onchange="selectServiceType()">
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">บริการหลัก</label>
                                        <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทบริการ" id="servicemaster" onchange="selectServiceMaster()">

                                        </select>
                                    </div>
                                </div>
                                <div class="control-group form-group col-md-6 mb-0">
                                    <div class="form-group">
                                        <label class="form-label">บริการย่อย</label>
                                        <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทบริการ" id="servicesub" onchange="selectServiceSub()">

                                        </select>
                                    </div>
                                </div>
                                <div class="control-group form-group col-md-6 mb-0">
                                    <label class="form-label">รายละเอียดเพิ่มเติม</label>
                                    <p class="mb-2" id="description">-</p>
                                </div>
                                <div class="control-group form-group col-md-4 mb-0">
                                    <label class="form-label">ราคาปกติ</label>
                                    <h3 class="fw-bold fs-25 text-muted mb-2"><del id="price">0.00</del></h3>
                                </div>
                                <div class="control-group form-group col-md-4 mb-0">
                                    <label class="form-label">ราคาโปรโมชั่น</label>
                                    <p class="fw-bold fs-25 text-primary mb-2" id="price_promo">0.00</p>
                                </div>
                                <div class="control-group form-group col-md-4 mb-0">
                                    <label class="form-label">จำนวน</label>
                                    <div class="input-group input-indec input-indec1 w-100 w-sm-50 mt-3">
                                        <span class="input-group-btn">
                                            <button type="button" id="qtydel" class="minus btn btn-white btn-number btn-icon br-7 disabled ">
                                                <i class="fa fa-minus text-muted"></i>
                                            </button>
                                        </span>
                                        <input type="text" name="quantity" id="quantity" class="form-control text-center qty h3 bg-white" readonly value="0">
                                        <span class="input-group-btn">
                                            <button type="button" id="qtyadd" class="quantity-right-plus btn btn-white btn-number btn-icon br-7 disabled add">
                                                <i class="fa fa-plus text-muted"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <a href="javascript:void(0)" class="btn btn-lg btn-success disabled" id="addlist" onclick="addList()">+ เพิ่มรายการ</a>
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
                                            <thead>
                                                <tr class=" ">
                                                    <th>No.</th>
                                                    <th class="text-center">บริการ</th>
                                                    <th class="text-center">บริการย่อย</th>
                                                    <th class="text-center">ราคา</th>
                                                    <th class="text-center">จำนวน</th>
                                                    <th class="text-center">ราคาทั้งหมด</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="addedlist">
                                                <tr>
                                                    <td class="text-center" colspan="7">ยังไม่มีบริการที่เลือก</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-uppercase text-end">ราคารวมทั้งหมด</td>
                                                    <td class="text-end h5" id="alltotalprice">-</td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-uppercase text-end">ส่วนลดท้ายบิล</td>
                                                    <td class="text-end h5" id="discount">-</td>
                                                    <td class="text-center"></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="fw-bold text-uppercase text-end">ราคารวมสุทธิ</td>
                                                    <td class="fw-bold text-end h4" id="grandtotalprice">-</td>
                                                    <td class="text-center"></td>
                                                </tr>
                                            </tfoot>
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
                                        <input type="checkbox" class="custom-control-input" name="" value="1" id="chkdiscount" onchange="checkDiscount()">
                                        <span class="custom-control-label fw-bolder h4 mt-2">ส่วนลดท้ายบิล</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row discount-space" style="display:none;">
                                <div class="control-group form-group col-md-6 " >
                                    <label class="form-label">ประเภทส่วนลดท้ายบิล</label>
                                    <select name="service_type" id="service_type" class="form-control select2-show-search form-select" data-bs-placeholder="กรุณาเลือกประเภทส่วนลด...">
                                    </select>
                                </div>
                                <div class="control-group form-group col-md-6">
                                    <label class="form-label">จำนวนเงินส่วนลด (บาท)</label>
                                    <input type="number" class="form-control numbers-only" value="0" id="valdiscount" min="0">
                                </div>
                                <div class="col-md-12">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-outline-success" id="addlist" onclick="checkDiscount()"><i class="fa fa-calculator"></i> คำนวณส่วนลด</a>
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
                                    <textarea class="form-control" placeholder="Comments" id="remark" style="height: 100px"></textarea>
                                    <label for="remark">กรอกหมายเหตุ</label>
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
                                <select class="form-control select2-show-search form-select" data-placeholder="กรุณาเลือกผู้ขายคนที่ 1..." id="empsale1">
                                        <option label="กรุณาเลือกผู้ขายคนที่ 1..."></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"> ผู้ขายคนที่ 2</label>
                                <select class="form-control select2-show-search form-select" data-placeholder="กรุณาเลือกผู้ขายคนที่ 2..." id="empsale2">
                                    <option label="กรุณาเลือกผู้ขายคนที่ 2..."></option>
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
        {{-- <div class="row" id="space_addpayment">
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
                        <div class="col-12">
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
                        </div>
                        <div class="col-12 text-center">
                            <hr>
                            <a href="javascript:void(0)" onclick="gotoThisOrder()" class="btn btn-primary btn-rounded waves-effect waves-light mr-2"><i class="fa fa-chevron-right me-2"></i>ไปยังหน้าของใบสั่งซื้อ</a>
                            <a href="javascript:void(0)" onclick="gotoThisOrder()" class="btn btn-info btn-rounded waves-effect waves-light"><i class="fa fa-chevron-right me-2"></i>ทำใบนัด</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
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


        // $('#space_selectservice').show();
        // $('#space_emptype').hide();


        $('#n_customertype').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });

        getdataServicetype();
        $('#servicetype').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('#servicemaster').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('#servicesub').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });

        $('#valdiscount').focusout(function() {
            checkDiscount();
        })

        getEmpSale();
        getDiscountList();

    });

    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        width: '100%'
    });
    $('.numbers-only').keyup(function () {
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    function setViewDefault() {
        $('#space_emptype').show();
        $('#space_newemp').hide();
        $('#space_oldemp').hide();
        $('#space_selectservice').hide();
        // $('#space_addpayment').hide();
    }

    function empTypeSelect(param) {
        switch (param) {
            case 'new':
                $('#space_emptype').hide();
                $('#space_newemp').fadeIn();
                getdataCusttype();
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

    function getdataCusttype() {
        $.ajax({
            url: '{{ route('customer.getdatacusttype') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                if(response.status == "success") {
                    var html = '';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].id+'" >'+response.data[i].name+'</option>';
                    }
                    $('#n_customertype').html(html);
                }
            },
            complete: function () {
            }
        });
    }




    // Create Order ---------------
    function createOrder(customercode) {
        $.ajax({
            url: '{{ route('orders.selectcustomer') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                customercode: customercode,
            },
            success: function (response) {
                if(response.status == "success") {
                    var dt = new Date();
                    var date = dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate();
                    var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
                    $('#ordercreated_at').html(date + ' ' + time);
                    $('#customercode').html(response.param[0].code);
                    $('#fullname').html(response.param[0].fname + ' ' + response.param[0].lname);
                    $('#tel').html(response.param[0].tel);
                    $('#addr').html(response.param[0].addr);
                }
            },
            complete: function () {
                $('#space_newemp').hide();
                $('#space_oldemp').hide();
                $('#space_selectservice').fadeIn();
            }
        });
    }

    async function selectServiceType() {
        var id = $('#servicetype :selected').val();
        await getdataServicetype(id);
        $('#servicesub :selected').val('');
        await setTimeout(() => {
            checkSelectService();
        }, 200)
    }

    function getdataServicetype(id, fload) {
        $.ajax({
            url: '{{ route('service.getdata') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                val: "servicetype"
            },
            success: function (response) {
                if(response.status == "success") {
                    var html = '<option label="กรุณาเลือกประเภทบริการ" selected></option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].id+'" '+(response.data[i].id == id ? 'selected' : '')+' >'+response.data[i].name_th+'</option>';
                    }
                    $('#servicetype').html(html);
                }
            },
            complete: function () {
                getdataServiceMaster(id, fload);
            }
        });
    }

    function getdataServiceMaster(id, fload) {
        $.ajax({
            url: '{{ route('service.getdata') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                val: "servicemaster",
                id: id
            },
            success: function (response) {
                if(response.status == "success") {
                    var html = '<option label="กรุณาเลือกบริการหลัก" selected></option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].id+'" '+(response.data[i].id == fload ? 'selected' : '')+' >'+response.data[i].name_th+' ('+response.data[i].name_en+')'+'</option>';
                    }
                    $('#servicemaster').html(html);
                }
            },
            complete: function () {
                getdataServicesub();
            }
        });
    }

    async function selectServiceMaster() {
        var id = $('#servicemaster :selected').val();
        await getdataServicesub(id);
        await setTimeout(() => {
            checkSelectService();
        }, 200)
    }

    function getdataServicesub(id, fload) {
        $.ajax({
            url: '{{ route('service.getdata') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                val: "servicesub",
                id: id
            },
            success: function (response) {
                if(response.status == "success") {
                    var html = '<option label="กรุณาเลือกบริการย่อย" selecetd></option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].code+'" '+(response.data[i].id == fload ? 'selected' : '')+' >'+response.data[i].name_th+' ('+response.data[i].name_en+')'+'</option>';
                    }
                    $('#servicesub').html(html);
                }
            },
            complete: function () {
            }
        });
    }

    async function selectServiceSub() {
        var code = $('#servicesub :selected').val();
        await getService(code);
        await setTimeout(() => {
            checkSelectService();
        }, 200)
    }

    function getService(code) {
        $.ajax({
            url: '{{ route('service.getdata') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                val: "service",
                code: code
            },
            success: function (response) {
                if(response.status == "success") {
                    $('#description').html(response.data[0].description);
                    $('#price').html(commaSeparateNumber(response.data[0].price));
                    $('#price_promo').html(commaSeparateNumber(response.data[0].price_promo));
                }
            },
            complete: function () {

            }
        });
    }

    function checkSelectService() {
        if ($('#servicesub :selected').val() === "") {
            $('#description').html('-');
            $('#price').html('0.00');
            $('#price_promo').html('0.00');
            $('#qtydel').addClass('disabled');
            $('#quantity').val(0);
            $('#qtyadd').addClass('disabled');
            $('#addlist').addClass('disabled');
        } else {
            $('#qtydel').removeClass('disabled');
            $('#quantity').val(1);
            $('#qtyadd').removeClass('disabled');
            $('#addlist').removeClass('disabled');
        }
    }

    let arrList = [];
    let arrAlltotalPrice = [];
    let strDiscount = 0;
    let strGrandtotalPrice = 0;

    function addList() {
        var servicecode = $('#servicesub :selected').val();
        var qty = $('#quantity').val();
        var servicetype = $('#servicetype :selected').text();
        var servicemaster = $('#servicemaster :selected').text();
        var servicesub = $('#servicesub :selected').text();
        var description = $('#description').html();
        var price = $('#price').html();
        var price_promo = $('#price_promo').html();

        arrList.push({
            servicecode: servicecode,
            qty: qty,
            servicetype: servicetype,
            servicemaster: servicemaster,
            servicesub: servicesub,
            description: description,
            price: parseFloat(price.replace(/,/g, '')).toFixed(2),
            price_promo: parseFloat(price_promo.replace(/,/g, '')).toFixed(2),
            totalprice: parseFloat(price_promo.replace(/,/g, '') * qty.replace(/,/g, '')).toFixed(2),
        });
        arrAlltotalPrice.push(Number(parseFloat(price_promo.replace(/,/g, '') * qty.replace(/,/g, '')).toFixed(2)));
        setList();
    }

    function setList() {
        var html = '';
        var index = 0;
        if (arrList.length > 0) {
            for (var i = 0; i < arrList.length; i++) {
                html += '<tr>';
                html += '<td class="text-center">'+(index+1)+'</td>';
                html += '<td><p class="font-w600 mb-1">'+arrList[i].servicemaster+'</p></td>';
                html += '<td class="text-start">'+arrList[i].servicesub+'</td>';
                html += '<td class="text-end">'+commaSeparateNumber(arrList[i].price_promo)+'</td>';
                html += '<td class="text-center">'+arrList[i].qty+'</td>';
                html += '<td class="text-end">'+commaSeparateNumber(arrList[i].totalprice)+'</td>';
                html += '<td class="text-center"><a href="javascript:void(0)" title="ลบ" class="btn text-danger" onclick="deleteList('+index+')"><i class="fe fe-trash"></i></a></td>';
                html += '</tr>';
                index++;
            }
        } else {
            html += '<tr>';
            html += '<td class="text-center" colspan="7">ยังไม่มีบริการที่เลือก</td>';
            html += '</tr>';
        }
        $('#addedlist').html(html);

        // Calculate
        calculatePriceOrder();
    }

    function calculatePriceOrder() {
        strGrandtotalPrice = arrAlltotalPrice.reduce((a, b) => a + b, 0) - strDiscount;
        $('#alltotalprice').html(commaSeparateNumber(arrAlltotalPrice.reduce((a, b) => a + b, 0)));
        $('#discount').html(commaSeparateNumber(strDiscount));
        $('#grandtotalprice').html(commaSeparateNumber(strGrandtotalPrice));
        // console.log('arrAlltotalPrice = ' + arrAlltotalPrice);
        // console.log('strDiscount = ' + strDiscount);
        // console.log('strGrandtotalPrice = ' + strGrandtotalPrice);
    }

    function checkDiscount() {
        var checkBox = document.getElementById("chkdiscount");
        if (checkBox.checked == true){
            strDiscount = $('#valdiscount').val();
            $('.discount-space').slideDown();
        } else {
            strDiscount = $('#valdiscount').val(0);
            strDiscount = 0;
            $('.discount-space').slideUp();
        }
        calculatePriceOrder();
    }


    function getDiscountList() {
        $.ajax({
            url: '{{ route('orders.getdiscountlist') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                console.log(response);
                if(response.status == "success") {
                    var html = '';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
                    }
                    $('#service_type').html(html);
                }
            },
            complete: function () {

            }
        });
    }

    function getEmpSale() {
        $.ajax({
            url: '{{ route('orders.getempsale') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function (response) {
                if(response.status == "success") {
                    var html = '<option label="กรุณาเลือกผู้ขายคนที่ 1" seleceted></option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].emp_code+'">'+'('+response.data[i].emp_code+') '+response.data[i].emp_fname_th+' '+response.data[i].emp_lname_th+'</option>';
                    }
                    $('#empsale1').html(html);
                    var html2 = '<option label="กรุณาเลือกผู้ขายคนที่ 2"></option>';
                    html2 += '<option value="0" selected>ไม่ระบุ</option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html2 += '<option value="'+response.data[i].emp_code+'">'+'('+response.data[i].emp_code+') '+response.data[i].emp_fname_th+' '+response.data[i].emp_lname_th+'</option>';
                    }
                    $('#empsale2').html(html2);
                }
            },
            complete: function () {

            }
        });
    }


    function deleteList(index) {
        arrList.splice(index, 1);
        arrAlltotalPrice.splice(index, 1);
        setList();
    }




    function confirmOrder() {
        var arrSumInfoOrder = [];
        arrSumInfoOrder.push({
            code: '',
            status_order: 1,
            status_orderpayment: 1,
            cust_code: $('#customercode').html(),
            price_paid: 0,
            price_balance: strGrandtotalPrice,
            price_discount: strDiscount,
            discounttype_id: $('#service_type :selected').val(),
            price_total: arrAlltotalPrice.reduce((a, b) => a + b, 0),
            price_nettotal: strGrandtotalPrice,
            remark: $('#remark').val(),
            sale_1: $('#empsale1 :selected').val(),
            sale_2: ($('#empsale2 :selected').val() == 0 ? '' : $('#empsale2 :selected').val()),
        });
        // Log -------
        // console.log(arrSumInfoOrder);

        var arrSumInfoOrderDetail = arrList;
        // Log -------
        // console.log(arrSumInfoOrderDetail);

        if(arrSumInfoOrder.length < 1) {
            swal({
                title: "กรุณาเพิ่มบริการ",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) {
                 setTimeout(() => { $('#servicetype').focus(); }, 300)
            });
            return false;
        }

        var checkBox = document.getElementById("chkdiscount");
        if (checkBox.checked == true){
            if($('#valdiscount').val() < 1) {
                swal({
                    title: "กรุณาระบุจำนวนเงินส่วนลด",
                    type: "error",
                    confirmButtonText: "ตกลง",
                },
                function(isConfirm) {
                    setTimeout(() => { $('#valdiscount').select(); }, 300)
                });
                return false;
            }
        }

        if ($('#empsale1 :selected').val() == "") {
            swal({
                title: "กรุณาเลือกผู้ขาย",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) {
                 setTimeout(() => { $('#empsale1 :selected').focus(); }, 300)
            });
            return false;
        } else {
            if ($('#empsale1 :selected').val() == $('#empsale2 :selected').val()) {
                swal({
                    title: "ผู้ขายซ้ำ กรุณาตรวจสอบการเลือกผู้ขาย",
                    type: "error",
                    confirmButtonText: "ตกลง",
                },
                function(isConfirm) {
                    setTimeout(() => { $('#empsale2 :selected').focus(); }, 300)
                });
                return false;
            }
        }

        swal({
            title: "ยืนยันเพิ่มคำสั่งซื้อ",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันข้อมูลคำสั่งซื้อ",
            cancelButtonText: 'แก้ไขข้อมูล',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('orders.insert') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        arr_order: arrSumInfoOrder,
                        arr_orderdetail: arrSumInfoOrderDetail,
                    },
                    success: function (response) {
                        
                        if(response.status == "success") {
                            swal({
                                title: "เลขที่ใบสั่งซื้อ "+response.ordercode+" ทำการบันทึกข้อมูลเรียบร้อย",
                                type: "success",
                                confirmButtonText: "ตกลง",
                            },
                            function(isConfirm) {
                                gotoThisOrder(response.ordercode);
                            });

                        }
                    },
                    complete: function () {

                    }
                });
            }
        });


    }







    // Old Customer -----------------------------
    function searchCustomer() {
        var filtertype = $('#filter_type :selected').val();
        var filtertext = $('#filter_text').val();
        if (filtertext == "") {
            swal({
                title: "กรุณากรอกคำค้นหา",
                text: "",
                type: "warning",
                confirmButtonText: "OK",
                closeOnConfirm: true,
            });
            return false;
        }
        $.ajax({
            url: '{{ route('orders.searchcustomer') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                filtertype: filtertype,
                filtertext: filtertext,
            },
            success: function (response) {
                if(response.status == "success") {
                    $('#rescustinfo').fadeOut();
                    setTimeout(() => {
                        $('#o_custcode').html(response.param[0].code);
                        $('#o_fname').html(response.param[0].fname);
                        $('#o_lname').html(response.param[0].lname);
                        $('#o_birthdate').html(response.param[0].bdate);
                        $('#o_idcard').html(response.param[0].idcard);
                        $('#o_bloodtype').html(response.param[0].bloodtype);
                        $('#o_email').html(response.param[0].email);
                        $('#o_tel').html(response.param[0].tel);
                        $('#o_addr').html(response.param[0].addr);
                        $('#o_custtype').html(response.param[0].name);

                        $('#rescustinfo').fadeIn();
                        $('#btnselectcust').removeClass('disabled');
                    }, 400)
                }
                if(response.status == "failed") {
                    swal({
                        title: "ไม่พบข้อมูล",
                        text: "",
                        type: "error",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $('#rescustinfo').fadeOut();
                            $('#btnselectcust').addClass('disabled');
                            setTimeout(() => {
                                $('#filter_text').focus();
                                $('#filter_text').select();
                            }, 400)
                        }
                    });
                }
            },
            complete: function () {
            }
        });
    }

    function confirmSelectCust() {
        swal({
            title: "ยืนยันข้อมูลลูกค้า",
            type: "warning",
            confirmButtonText: "ยืนยันข้อมูลถูกต้อง",
            cancelButtonText: 'แก้ไขข้อมูล',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                createOrder($('#o_custcode').html());
            }
        });
    }






    // New Customer -----------------------------
    function confirmAddNewEmp() {
        if (checkInput('newemp') == false) {
            swal({
                title: "กรุณากรอกข้อมูลให้ครบ",
                text: "",
                type: "warning",
                confirmButtonText: "OK",
                closeOnConfirm: true,
            });
        } else {
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
                    $.ajax({
                        url: '{{ route('customer.insert') }}',
                        method: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            n_fname: $('#n_fname').val(),
                            n_lname: $('#n_lname').val(),
                            n_birthdate: $('#n_birthdate').val(),
                            n_idcard: $('#n_idcard').val(),
                            n_bloodtype: $('#n_bloodtype').val(),
                            n_email: $('#n_email').val(),
                            n_tel: $('#n_tel').val(),
                            n_addr: $('#n_addr').val(),
                            n_customertype: $('#n_customertype :selected').val(),
                        },
                        success: function (response) {
                            if(response.status == "success") {
                                swal({
                                    title: "เพิ่มข้อมูลลูกค้าแล้ว!",
                                    text: "Your infomation has been succesfully save.",
                                    type: "success",
                                    confirmButtonText: "OK",
                                    confirmButtonClass: "btn-success",
                                    },
                                function(isConfirm) {
                                    if (isConfirm) {
                                        createOrder(response.customercode);
                                    }
                                });
                            }

                            if(response.status == "failed") {
                                swal({
                                    title: "Data is already!",
                                    text: response.param,
                                    type: "error",
                                    confirmButtonText: "OK",
                                    },
                                function(isConfirm) {

                                });
                            }
                        },
                        complete: function () {
                        }
                    });
                }
            });
        }
    }

    function checkInput(param) {
        if (param == 'newemp') {
            const invalidValues = [
                "n_fname",
                "n_lname",
                "n_idcard",
                "n_bloodtype",
                "n_tel"
            ];
            for (var i = 0; i < invalidValues.length; i++) {
                if ($('#'+invalidValues[i]).val() == "") {
                    return false;
                }
            }
            return true;
        }
    }



    function gotoThisOrder(ordercode) {
        var url = "{{ route('orders.detail', '')}}"+"/"+ordercode;
        location.href = url;
    }

    </script>
@endsection

