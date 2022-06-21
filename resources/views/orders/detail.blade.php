@extends('layouts.template')
@section('title','ใบสั่งซื้อ') {{-- Title --}}


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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label">เลขที่ใบสั่งซื้อ</label>
                                    <h2>{{ $res->code }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 text-end border-bottom border-lg-0">
                                <h5 class="mt-5">วันที่ใบสั่งซื้อ: {{ $res->created_at }}</h5>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-lg-6">
                                <p class="h3">ข้อมูลลูกค้า:</p>
                                <p class="fs-18 fw-semibold mb-0"><a href="#">{{ $res->cust_code }}</a> {{ $res->fname }} {{ $res->lname }}</p>
                                <address>
                                    <span><b>{{ $res->tel }}</b></span><br>
                                    {{ $res->addr }}
                                </address>
                            </div>
                            <div class="col-lg-6 text-end">
                                <p class="h4 fw-semibold">รายละเอียดการชำระเงิน:</p>
                                <p class="mb-3">สถานะการชำระเงินของใบสั่งซื้อ: <span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">อยู่ระหว่างการชำระเงิน</span></p>
                                <p class="mb-1">ชำระแล้ว: <span class="h4">@price($res->price_paid)</span></p>
                                <p class="mb-1">ยอดคงค้าง: <span class="h4">@price($res->price_balance)</span></p>
                            </div>
                        </div>
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
                        <div class="row pt-5">
                            <div class="col-lg-12">
                                <p class="h4">หมายเหตุ:</p>
                                <p>{{ $res->remark }}</p>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-lg-12">
                                <p class="h4">ผู้ขาย:</p>
                                <div class="row">
                                    <div class="col-auto">
                                        <h5 class="mt-0"><i class="mdi mdi-account-box me-2"></i>{{ $res->sale_1 }}</h5>
                                    </div>
                                    <div class="col-auto">
                                        <h5 class="mt-0"><i class="mdi mdi-account-box me-2"></i>{{ $res->sale_2 }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 END -->


        <!-- ROW-2 -->
        <div class="row">
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
                        <div class="expanel expanel-default">
                            <div class="expanel-body row">
                                <div class="col-2">
                                    <h1 class="text-gray mb-2">#1</h1>
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">เลขที่ชำระเงิน</label>
                                                <h4>PAY-0001</h4>
                                            </div>
                                        </div>
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
                                                <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">สำเร็จ</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="expanel expanel-default">
                            <div class="expanel-body row">
                                <div class="col-2">
                                    <h1 class="text-gray mb-2">#2</h1>
                                </div>
                                <div class="col-10">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">เลขที่ชำระเงิน</label>
                                                <h4>PAY-0002</h4>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">วันที่ชำระเงิน</label>
                                                <h4>08-04-2022 09:00:00</h4>
                                            </div>
                                        </div>
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
                                                <label class="form-label">สถานะการชำระเงิน</label>
                                                <span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รออนุมัติ</span>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label">หลักฐานการชำระเงิน</label>
                                                <a href="#" class="btn btn-sm btn-outline-dark">ดูหลักฐานการชำระเงิน</a>
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
                </div>
            </div>
        </div>
        <!-- ROW-2 END -->

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

<div class="modal fade" id="modal_payment_edit">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title"><i class="fa fa-pencil me-2"></i>แก้ไขบันทึกชำระเงิน</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body p-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">วันที่ชำระเงิน</label>
                            <h4>08-04-2022 09:00:00</h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">รูปแบบการชำระ</label>
                            <select name="payment_case" id="payment_case" class="form-control form-select">
                                <option value="" disabled>กรุณาเลือก...</option>
                                <option value="1">มัดจำ</option>
                                <option value="2" selected>ปกติ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">วิธีการชำระเงิน</label>
                            <select name="payment_case" id="payment_case" class="form-control form-select">
                                <option value="" selected disabled>กรุณาเลือก...</option>
                                <option value="1">เงินสด</option>
                                <option value="2" selected>บัตรเครดิต</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">จำนวนเงินที่ชำระ</label>
                            <input type="text" class="form-control" value="10000">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">สถานะการชำระเงิน</label>
                            <span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">รออนุมัติ</span>
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
                <button class="btn btn-primary">บันทึก</button>
                <button class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')

    <!-- FILE UPLOADES JS -->
    <script src="../assets/plugins/fileuploads/js/fileupload.js"></script>
    <script src="../assets/plugins/fileuploads/js/file-upload.js"></script>

    <script>
    $( document ).ready(function() {
        // alert( "ready!" );
    });

    </script>
@endsection

