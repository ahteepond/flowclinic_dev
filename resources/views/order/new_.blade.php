@extends('layouts.template')
@section('title','สั่งซื้อบริการ') {{-- Title --}}


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
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Service Order Wizard
                        </div>
                    </div>
                    <div class="card-body">

                        <div id="orderwizard">
                            <h3>ข้อมูลลูกค้า</h3>
                            <section class="row">
                                <div class="control-group form-group col-md-6">
                                    <label class="form-label">ประเภทลูกค้า</label>
                                    <select name="service_type" class="form-control form-select" data-bs-placeholder="กรุณาเลือกประเภทลูกค้า...">
                                        <option value="0">ลูกค้าใหม่</option>
                                        <option value="1">ลูกค้าเก่า</option>
                                    </select>
                                </div>
                                <div class="col-6"></div>
                                <div class="col-12"><hr class="my-1"></div>
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
                                <div class="control-group form-group mb-0 col-md-12">
                                    <label class="form-label">รูปภาพ</label>
                                    <div class="control-group form-group  row">
                                        <div class="col-lg-12 col-sm-12">
                                            <input type="file" class="dropify" onchange="readURL(this);"
                                                data-height="180" />
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <h3>เลือกบริการ</h3>
                            <section class="row">
                                {{-- <h5>note : เพิ่มจำนวนบริการได้<br>
                                    input : ราคาปกติ, ราคาโปรโมชั่น/ส่วนลด, จำนวนบริการ, ส่วนลดท้ายบิล->Vocher || ส่วนลดการตลาด || อื่นๆ </h5> --}}
                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="control-group form-group col-md-6">
                                            <label class="form-label">บริการ</label>
                                            <select name="service" class="form-control form-select" data-bs-placeholder="กรุณาเลือกและบริการ...">
                                                <option value="">เสริมหน้าอก (Breast Augmentation)</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group col-md-6">
                                            <label class="form-label">บริการย่อย</label>
                                            <select name="service_type" class="form-control form-select" data-bs-placeholder="กรุณาเลือกบริการย่อย...">
                                                <option value="">ซิลิโคน ซิลิเมต (Silicone Silimed)</option>
                                                <option value="">ซิลิโคน ยูโร (Silicone Euro)</option>
                                                <option value="">ซิลิโคน เซบบิน (Silicone Sebbin)</option>
                                                <option value="">ซิลิโคน เมนเตอร์ (Silicone Mentor)</option>
                                            </select>
                                        </div>
                                        <div class="control-group form-group col-md-12">
                                            <label class="form-label">รายละเอียดเพิ่มเติม</label>
                                            <p>ไม่เกิน 400cc เกิน 3,000</p>
                                        </div>
                                        <div class="control-group form-group col-md-4">
                                            <label class="form-label">ราคาปกติ</label>
                                            <h3 class="fw-bold fs-25 text-muted"><del>45,000.-</del></h3>
                                        </div>
                                        <div class="control-group form-group col-md-4">
                                            <label class="form-label">ราคาโปรโมชั่น</label>
                                            <p class="fw-bold fs-25 text-primary">26,900.-</p>
                                        </div>
                                        <div class="control-group form-group col-md-4">
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
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" class="text-uppercase text-end">ราคารวมทั้งหมด</td>
                                                            <td class="text-end h5">109,600.-</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" class="text-uppercase text-end">ส่วนลดท้ายบิล (Vocher)</td>
                                                            <td class="text-end h5">1,000.-</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5" class="fw-bold text-uppercase text-end">ราคารวมสุทธิ</td>
                                                            <td class="fw-bold text-end h4">108,600.-</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <h3>ข้อมูลการชำระเงิน</h3>
                            <section class="row">
                                {{-- <h5>note : วิธีการชำระเงิน : เงินสด->default, บัตรเครดิต->Bank+หลักฐาน, โอน->Bank+หลักฐาน<br>
                                    input : </h5> --}}
                                <div class="control-group form-group col-md-12">
                                    <label class="form-label">ราคารวมสุทธิ</label>
                                    <h3 class="fw-bold fs-25 text-primary mb-0">108,600.-</h3>
                                </div>
                                <div class="control-group form-group col-md-6">
                                    <label class="form-label">จำนวนที่ชำระ (บาท)</label>
                                    <input type="text" class="form-control required" placeholder="กรุณากรอกจำนวนเงิน..." value="0">
                                </div>
                                <div class="control-group form-group col-md-6">
                                    <label class="form-label">จำนวนเงินมัดจำที่ชำระ (บาท)</label>
                                    <input type="text" class="form-control required" placeholder="กรุณากรอกจำนวนเงิน..." value="2,000">
                                </div>
                                <div class="control-group form-group col-md-12">
                                    <label class="form-label">วิธีการชำระเงิน</label>
                                    <select onchange="paymenttypeInputSwap(this.value)" name="paymenttype" id="paymenttype" class="form-control form-select" data-bs-placeholder="กรุณาเลือกวิธีการชำระเงิน...">
                                        <option value="1">เงินสด</option>
                                        <option value="2">บัตรเครดิต</option>
                                        <option value="3">โอน</option>
                                    </select>
                                </div>
                                <div class="control-group form-group col-md-12 payment_evidence" style="display: none;">
                                    <label class="form-label">หลักฐานการชำระเงิน</label>
                                    <div class="control-group form-group  row">
                                        <div class="col-lg-12 col-sm-12">
                                            <input type="file" class="dropify" onchange="readURL(this);"
                                                data-height="180" />
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group form-group col-md-12 payment_evidence" style="display: none;">
                                    <label class="form-label">หลักฐานการชำระเงินมัดจำ</label>
                                    <div class="control-group form-group  row">
                                        <div class="col-lg-12 col-sm-12">
                                            <input type="file" class="dropify" onchange="readURL(this);"
                                                data-height="180" />
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <h3>สรุปรายละเอียดสั่งซื้อบริการ</h3>
                            <section class="row">
                                <div class="control-group form-group col-md-6">
                                    <label class="form-label">ประเภทลูกค้า</label>
                                    <p class="mb-0">ลูกค้าใหม่</p>
                                </div>
                                <div class="col-6"></div>
                                <div class="col-12"><hr class="my-1"></div>
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
                                {{-- <div class="control-group form-group mb-0 col-md-12">
                                    <label class="form-label">รูปภาพ</label>

                                </div> --}}

                                <div class="col-12 my-5">
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
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-uppercase text-end">ราคารวมทั้งหมด</td>
                                                    <td class="text-end h5">109,600.-</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="text-uppercase text-end">ส่วนลดท้ายบิล (Vocher)</td>
                                                    <td class="text-end h5">1,000.-</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" class="fw-bold text-uppercase text-end">ราคารวมสุทธิ</td>
                                                    <td class="fw-bold text-end h4">108,600.-</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="control-group form-group mb-0 col-md-12 text-end">
                                    <label class="form-label">เงินมัดจำ</label>
                                    <p class="fw-bold fs-25 text-primary">2,000.-</p>
                                </div>
                            </section>

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

<!-- FILE UPLOADES JS -->
<script src="../assets/plugins/fileuploads/js/fileupload.js"></script>
<script src="../assets/plugins/fileuploads/js/file-upload.js"></script>

    <!-- INTERNAl Jquery.steps js -->
    <script src="../assets/plugins/jquery-steps/jquery.steps.min.js"></script>
    <script src="../assets/plugins/parsleyjs/parsley.min.js"></script>

    <script>
    $( document ).ready(function() {

    });

    $('#orderwizard').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#<\/span> <span class="title">#title#<\/span>',
        stepsOrientation: 1
    });

    function paymenttypeInputSwap(val) {

        if (val == 1) { $('.payment_evidence').slideUp(); }
        if (val == 2) { $('.payment_evidence').slideDown(); }
        if (val == 3) { $('.payment_evidence').slideDown(); }

    }

    </script>
@endsection

