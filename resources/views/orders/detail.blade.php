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
                                <h5 class="mt-5">วันที่ใบสั่งซื้อ: {{ $res->orderdate }}</h5>
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
                                <p class="mb-3">สถานะใบสั่งซื้อ:
                                    @switch($res->status_order)
                                        @case(0)
                                            <span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ยกเลิก</span>
                                            @break
                                        @case(1)
                                            <span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอชำระเงิน</span>
                                            @break
                                        @case(2)
                                            <span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">อยู่ระหว่างการชำระเงิน</span>
                                            @break
                                        @case(3)
                                            <span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">สำเร็จ</span>
                                            @break
                                    @endswitch

                                </p>
                                <p class="mb-1">ชำระแล้ว: <span class="h4">@price($res->price_paid)</span></p>
                                <p class="mb-1">ยอดคงค้าง: <span class="h4">@price($res->price_balance)</span></p>
                            </div>
                        </div>
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
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $ls_i = 1; @endphp
                                    @foreach ($list as $ls)
                                    <tr>
                                        <td class="text-center">{{ $ls_i }}</td>
                                        <td>
                                            <p class="font-w600 mb-1">{{ $ls->servicemaster_name_th }} ({{ $ls->servicemaster_name_en }})</p>
                                        </td>
                                        <td class="text-start">{{ $ls->service_name_th }} ({{ $ls->service_name_en }})</td>
                                        <td class="text-end">@price($ls->price_service)</td>
                                        <td class="text-center">{{ $ls->qty_service }}</td>
                                        <td class="text-end">@price($ls->price_total_service)</td>
                                    </tr>
                                    @php $ls_i++ @endphp
                                    @endforeach
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-uppercase text-end">ราคารวมทั้งหมด</td>
                                        <td class="text-end h5">@price($res->price_total)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-uppercase text-end">ส่วนลดท้ายบิล (Vocher)</td>
                                        <td class="text-end h5">@price($res->price_discount)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="fw-bold text-uppercase text-end">ราคารวมสุทธิ</td>
                                        <td class="fw-bold text-end h4">@price($res->price_nettotal)</td>
                                    </tr>
                                </tfoot>

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
                                        <h5 class="mt-0"><i class="mdi mdi-account-box me-2"></i>({{ $res->sale_1 }}) {{ $res->n_sale_1 }}</h5>
                                    </div>
                                    @if ($res->sale_2 != "")
                                    <div class="col-auto">
                                        <h5 class="mt-0"><i class="mdi mdi-account-box me-2"></i>({{ $res->sale_2 }}) {{ $res->n_sale_2 }}</h5>
                                    </div>
                                    @endif

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
                            <a class="btn btn-sm btn-primary" data-bs-effect="effect-scale" data-bs-toggle="modal" href="#modal_payment_add" onclick="openModalPaymentAdd()"><i class="fa fa-plus me-2"></i>เพิ่มบันทึกชำระเงิน</a>
                        </div>
                    </div>
                    <div class="card-body" id="payment_space">

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
                            <label class="form-label">ประเภทการชำระเงิน</label>
                            <select name="paymenttype" class="form-control form-select" id="paymenttype_new" onchange="checkEvidenceDisplay(this.value, 'new')">
                                @foreach ($paymenttype as $pt)
                                <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">จำนวนเงินที่ชำระ</label>
                            <input type="number" class="form-control form-control-lg numbers-only" value="0" min="0" id="paymentprice_new">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">บันทึก</label>
                            <div class="form-floating floating-label1">
                                <textarea class="form-control" placeholder="Note" style="height: 100px" id="remark_new"></textarea>
                                <label for="remark">กรอกบันทึก</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" id="evidencespace_new" style="display: none;">
                            <label class="form-label">หลักฐานการชำระเงิน</label>
                            <input type="text" id="valevidence_new" style="display: none;">
                            <div class="control-group form-group  row">
                                <div class="col-lg-12 col-sm-12">
                                    <input type="file" class="dropify" onchange="" data-height="180" id="evidence_new" data-allowed-file-extensions="jpg png pdf" data-max-file-size="10M"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="savePayment()">บันทึก</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
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
                            <label class="form-label">เลขที่ชำระเงิน</label>
                            <h3 class="text-primary" id="paymentcode_edit"></h3>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" >เลขที่ใบสั่งซื้อ</label>
                            <h4 id="ordercode_edit"></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" >วันที่ชำระเงิน</label>
                            <h4 id="paymentdate_edit"></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">สถานะการชำระเงิน</label>
                            <p class="mb-0" id="paymentstatus_edit"></p>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">ประเภทการชำระเงิน</label>
                            <select name="paymenttype_edit" id="paymenttype_edit" class="form-control form-select" onchange="checkEvidenceDisplay(this.value, 'edit')">

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">จำนวนเงินที่ชำระ</label>
                            <input type="number" class="form-control form-control-lg numbers-only" value="0" min="0" id="paymentprice_edit">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label">บันทึก</label>
                            <div class="form-floating floating-label1">
                                <textarea class="form-control" placeholder="Note" style="height: 100px" id="remark_edit"></textarea>
                                <label for="remark">กรอกบันทึก</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group"  id="evidencespace_edit" style="display: none;">
                            <label class="form-label">หลักฐานการชำระเงิน</label>
                            <input type="text" id="valevidence_edit" style="display: none;">
                            <div class="control-group form-group row">
                                <div class="col-lg-12 col-sm-12">
                                    <input type="file" class="dropify" onchange="" data-height="180" id="evidence_edit" data-allowed-file-extensions="jpg png" data-max-file-size="5M"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="updatePayment()">บันทึก</button>
                <button class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
@endsection



@section('script')

    <!-- FILE UPLOADES JS -->
    <script src="{{asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>

    <script>
    $( document ).ready(function() {
        setPaymentList();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#evidence_new').dropify();
    $('#evidence_edit').dropify();

    // $("#evidence_new").on("change", function() {

    //     });


    function openModalPaymentAdd() {
        document.getElementById("paymenttype_new").options.selectedIndex = 0;
        $('#paymentprice_new').val(0);
        $('#remark_new').val('');
        var id = $('#paymenttype_new :selected').val();
        checkEvidenceDisplay(id, 'new');
    }


    function openModalPaymentEdit(paymentcode) {
        $.ajax({
            url: '{{ route('payment.getdata') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                paymentcode: paymentcode,
            },
            success: function (response) {
                if (response.status == 'success') {
                    $("#modal_payment_edit").on('show.bs.modal', function(){
                        $('#paymentcode_edit').html(response.data.code);
                        $('#ordercode_edit').html(response.data.order_code);
                        $('#paymentdate_edit').html(response.data.paymentdate);
                        var paymenttype_edit = '';
                        for (var i = 0; i < response.paymenttype.length; i++) {
                            paymenttype_edit += '<option value="'+response.paymenttype[i].id+'" '+(response.data.paymenttype_id == response.paymenttype[i].id ? 'selected' : '')+'>'+response.paymenttype[i].name+'</option>';
                        }
                        $('#paymenttype_edit').html(paymenttype_edit);
                        $('#paymentprice_edit').val(response.data.price_paid);
                        switch (response.data.payment_status) {
                            case 0: var status_text = 'ยกเลิก'; var status_color = 'danger'; break;
                            case 1: var status_text = 'รออนุมัติ'; var status_color = 'info'; break;
                            case 2: var status_text = 'ไม่อนุมัติ/รอแก้ไข'; var status_color = 'primary'; break;
                            case 3: var status_text = 'อนุมัติแล้ว'; var status_color = 'success'; break;
                        }
                        var paymentprice_edit = '<span class="badge bg-'+status_color+'-transparent rounded-pill text-'+status_color+' p-2 px-3">'+status_text+'</span>';
                        $('#paymentstatus_edit').html(paymentprice_edit);
                        $('#remark_edit').val(response.data.remark);
                        // $('#evidence_edit').html('');
                    });
                    var id = response.data.id;
                    checkEvidenceDisplay(id, 'edit');
                }
            },
            complete: function () {
                $("#modal_payment_edit").modal("show");
            }
        });
    }



    function checkEvidenceDisplay(id, space) {
        $.ajax({
            url: '{{ route('orders.getevidence') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
            },
            success: function (response) {
                if(response.status == "success") {
                    $('#valevidence_'+space).val(response.param);
                    switch (response.param) {
                        case 0:
                            $('#evidencespace_'+space).slideUp();
                            $(".dropify-clear").trigger("click");
                            break;
                        case 1:
                            $('#evidencespace_'+space).slideDown();
                            break;
                    }
                }
            },
            complete: function () {

            }
        });
    }


    function setPaymentList() {
        $.ajax({
            url: '{{ route('payment.list') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                order_code: "{{ $res->code }}",
            },
            success: function (response) {
                var html = '';
                if (response.data.length < 1) {
                    html += '<div class="expanel expanel-default" id="nonepayment"><div class="expanel-body row">';
                    html += '<div class="col-12"><h4 class="text-gray text-center mb-0 my-5">ยังไม่มีรายการชำระเงิน</h4></div>';
                    html += '</div></div>';
                } else {
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<div class="expanel expanel-default"><div class="expanel-body row">';
                        html += '<div class="col-2"><h1 class="text-gray mb-2">#'+response.data[i].round+'</h1></div>';
                        html += '<div class="col-10"><div class="row">';
                        html += '<div class="col-md-5"><div class="form-group"><label class="form-label">เลขที่ชำระเงิน</label><h4>'+response.data[i].code+'</h4></div></div>';
                        html += '<div class="col-md-5"><div class="form-group"><label class="form-label">วันที่ชำระเงิน</label><h4>'+response.data[i].paymentdate+'</h4></div></div>';
                        html += '<div class="col-md-5"><div class="form-group"><label class="form-label">ประเภทการชำระเงิน</label><h2>'+response.data[i].paymenttype_name+'</h2></div></div>';
                        html += '<div class="col-md-5"><div class="form-group"><label class="form-label">จำนวนเงินที่ชำระ</label><h2 class="text-primary">'+commaSeparateNumber(response.data[i].price_paid)+'</h2></div></div>';
                        switch (response.data[i].payment_status) {
                            case 0: var status_text = 'ยกเลิก'; var status_color = 'danger'; break;
                            case 1: var status_text = 'รออนุมัติ'; var status_color = 'info'; break;
                            case 2: var status_text = 'ไม่อนุมัติ/รอแก้ไข'; var status_color = 'primary'; break;
                            case 3: var status_text = 'อนุมัติแล้ว'; var status_color = 'success'; break;

                        }
                        html += '<div class="col-md-5"><div class="form-group"><label class="form-label">สถานะการชำระเงิน</label><span class="badge bg-'+status_color+'-transparent rounded-pill text-'+status_color+' p-2 px-3">'+status_text+'</span></div></div>';
                        html += '<div class="col-md-5"><div class="form-group"><label class="form-label">หมายเหตุ/บันทึก</label><p>'+(response.data[i].remark ? response.data[i].remark : "-")+'</p></div></div>';
                        if(response.data[i].evidence == 1) {
                            html += '<div class="col-md-5"><div class="form-group"><label class="form-label">หลักฐานการชำระเงิน</label><a href="/payment_evidence/'+(response.data[i].evidence_file)+'" class="btn btn-sm btn-outline-dark" target="_blank">ดูหลักฐานการชำระเงิน</a></div></div>';
                        }
                        html += '</div></div>';
                        html += '</div>';
                        if(response.data[i].payment_status == 1) {
                            html += '<div class="expanel-footer text-end">';
                            html += '<a class="btn btn-sm btn-dark my-2 ms-2" data-bs-effect="effect-scale" href="javascript:void(0)" onclick="openModalPaymentEdit('+`'`+response.data[i].code+`'`+')">แก้ไข</a>';
                            html += '<button class="btn btn-sm btn-danger my-2 ms-2" onclick="canclePayment('+`'`+response.data[i].code+`'`+')">ยกเลิกบันทึกชำระเงิน</button>';
                            html += '</div>';
                        }
                        if(response.data[i].payment_status == 2) {
                            html += '<div class="expanel-footer text-end">';
                            html += '<button class="btn btn-sm btn-success my-2 ms-2" onclick="resendPayment('+`'`+response.data[i].code+`'`+')"><i class="fa fa-rotate-right"></i> ส่งตรวจสอบอีกครั้ง</button>';
                            html += '<a class="btn btn-sm btn-dark my-2 ms-2" data-bs-effect="effect-scale" href="javascript:void(0)" onclick="openModalPaymentEdit('+`'`+response.data[i].code+`'`+')">แก้ไข</a>';
                            html += '<button class="btn btn-sm btn-danger my-2 ms-2" onclick="canclePayment('+`'`+response.data[i].code+`'`+')">ยกเลิกบันทึกชำระเงิน</button>';
                            html += '</div>';
                        }
                        html += '</div>';
                    }
                }
                $('#payment_space').html(html);
            },
            complete: function () {

            }
        });
    }


    function savePayment() {
        var order_code = "{{ $res->code }}";
        var paymenttype_id = $('#paymenttype_new :selected').val();
        var valevidence = $('#valevidence_new').val();
        var price_paid = $('#paymentprice_new').val();
        var remark = $('#remark_new').val();
        var creator = "{{ session()->get('session_empcode') }}";
        var operator = "{{ session()->get('session_empcode') }}";

        if (checkSavePayment(price_paid, valevidence) == true) {
            swal({
                title: "ยืนยันบันทึกข้อมูลการชำระเงิน",
                text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
                type: "warning",
                confirmButtonText: "ยืนยันบันทึกข้อมูลการชำระเงิน",
                cancelButtonText: 'แก้ไขข้อมูล',
                showCancelButton: true,
                },
                function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '{{ route('payment.insert') }}',
                        method: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            order_code: order_code,
                            paymenttype_id: paymenttype_id,
                            price_paid: price_paid,
                            remark: remark,
                            creator: creator,
                            operator: operator,
                        },
                        success: function (response) {
                            if(response.status == "success") {
// --------------------------------------------------
                            uploadSaveEvidenceFile(response.code);
                                swal({
                                    title: "บันทึกข้อมูลการชำระเงินเรียบร้อย",
                                    type: "success",
                                    confirmButtonText: "ตกลง",
                                },
                                function(isConfirm) {
                                    setPaymentList();
                                });
// --------------------------------------------------

                            }
                        },
                        complete: function () {
                            $("#modal_payment_add").modal("hide");
                            $("#payment_space").focus();

                        }
                    });
                }
            });
        }
    }

    function uploadSaveEvidenceFile(code) {
        var files = document.getElementById("evidence_new");
        var file = files.files[0];
        var fd = new FormData();
        fd.append('file',file);
        fd.append('code',code);
        $.ajax({
            type: "POST",
            url: "{{ route('payment.upload') }}",
            data: fd,
            contentType: false,
            processData: false,
            dataType: 'json',
            cache:false,
            success: function(response){
                console.log(response.filename);
            }
        });
    }


    function checkSavePayment(price_paid, valevidence) {
        if(price_paid == 0 || price_paid == "") {
            swal({
                title: "กรุณาระบุจำนวนเงินที่ชำระ",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) { setTimeout(() => { $('#paymentprice_new').focus(); }, 300) });
            return false;
        } else if ($('#evidence_new').val() == "") {
            if(valevidence == 1) {
                swal({
                    title: "กรุณาระบุหลักฐานการชำระเงิน",
                    type: "error",
                    confirmButtonText: "ตกลง",
                },
                function(isConfirm) { setTimeout(() => { $('#paymenttype_new').focus(); }, 300) });
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }


    function updatePayment() {
        var order_code = $('#paymentcode_edit').html();
        var paymenttype_id = $('#paymenttype_edit :selected').val();
        var valevidence = $('#valevidence_edit').val();
        var price_paid = $('#paymentprice_edit').val();
        var remark = $('#remark_edit').val();
        var operator = "{{ session()->get('session_empcode') }}";


        if (checkUpdatePayment(price_paid, valevidence) == true) {
            swal({
                title: "ยืนยันบันทึกข้อมูลการชำระเงิน",
                text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
                type: "warning",
                confirmButtonText: "ยืนยันบันทึกข้อมูลการชำระเงิน",
                cancelButtonText: 'แก้ไขข้อมูล',
                showCancelButton: true,
                },
                function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: '{{ route('payment.update') }}',
                        method: 'post',
                        data: {
                            _token: "{{ csrf_token() }}",
                            payment_code: $('#paymentcode_edit').html(),
                            paymenttype_id: paymenttype_id,
                            price_paid: price_paid,
                            remark: remark,
                            operator: operator,
                        },
                        success: function (response) {
                            if(response.status == "success") {
                                swal({
                                    title: "อัพเดทข้อมูลการชำระเงินเรียบร้อย",
                                    type: "success",
                                    confirmButtonText: "ตกลง",
                                },
                                function(isConfirm) {
                                    setPaymentList();
                                });
                            }
                        },
                        complete: function () {
                            $("#modal_payment_edit").modal("hide");
                            $("#payment_space").focus();

                        }
                    });
                }
            });
        }

    }


    function checkUpdatePayment(price_paid, valevidence) {
        if(price_paid == 0 || price_paid == "") {
            swal({
                title: "กรุณาระบุจำนวนเงินที่ชำระ",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) { setTimeout(() => { $('#paymentprice_edit').focus(); }, 300) });
            return false;
        } else if ($('#evidence_edit').val() == "") {
            if(valevidence == 1) {
                swal({
                    title: "กรุณาระบุหลักฐานการชำระเงิน",
                    type: "error",
                    confirmButtonText: "ตกลง",
                },
                function(isConfirm) { setTimeout(() => { $('#paymenttype_edit').focus(); }, 300) });
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
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
                                setPaymentList();
                            });
                        }
                    },
                    complete: function () {
                    }
                });
            }
        });
    }

    function resendPayment(paymentcode) {
        var operator = "{{ session()->get('session_empcode') }}";
        swal({
            title: "ยืนยันส่งอนุมัติอีกครั้ง ("+paymentcode+")",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการส่งข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันส่งอนุมัติ",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('payment.resend') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        payment_code: paymentcode,
                        operator: operator,
                    },
                    success: function (response) {
                        if(response.status == "success") {
                            swal({
                                title: "ส่งอนุมัติการชำระเงินเรียบร้อย ("+paymentcode+")",
                                type: "success",
                                confirmButtonText: "ตกลง",
                            },
                            function(isConfirm) {
                                setPaymentList();
                            });
                        }
                    },
                    complete: function () {
                    }
                });
            }
        });
    }

    </script>
@endsection
