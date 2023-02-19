@extends('layouts.template')
@section('title','แก้ไขลูกค้า') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customer') }}">รายชื่อลูกค้า</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-pencil me-2"></i>Edit</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="control-group form-group col-md-12">
                                        <label class="form-label">รหัสลูกค้า</label>
                                        <h3 class="mb-0" id="o_custcode">{{ $res->code }}</h3>
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">ชื่อ <span class="text-red">*</span></label>
                                        <input type="text" class="form-control required" id="n_fname" placeholder="กรุณากรอกชื่อ..." value="{{ $res->fname }}">
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">นามสกุล <span class="text-red">*</span></label>
                                        <input type="text" class="form-control required" id="n_lname" placeholder="กรุณากรอกนามสกุล..." value="{{ $res->lname }}">
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">วันเกิด</label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                            </div><input class="form-control fc-datepicker" id="n_birthdate" placeholder="กรุณาระบุวันเกิด..." type="text" value="{{ $res->bdate }}">
                                        </div>
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">เลขบัตรประชาชน <span class="text-red">*</span></label>
                                        <input type="text" class="form-control required numbers-only" id="n_idcard" maxlength="13" placeholder="กรุณากรอกเลขบัตรประชาชน..." value="{{ $res->idcard }}">
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">กรุ๊ปเลือด</label>
                                        <input type="text" class="form-control required" id="n_bloodtype" placeholder="กรุณากรอกกรุ๊ปเลือด..." value="{{ $res->bloodtype }}">
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">อีเมล์</label>
                                        <input type="email" class="form-control required" id="n_email" placeholder="กรุณากรอกอีเมล์..." value="{{ $res->email }}">
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">เบอร์โทรศัพท์ <span class="text-red">*</span></label>
                                        <input type="text" class="form-control required numbers-only" id="n_tel" maxlength="10" placeholder="กรุณากรอกเบอร์โทรศัพท์..." value="{{ $res->tel }}">
                                    </div>
                                    <div class="control-group form-group mb-0 col-md-12">
                                        <label class="form-label">ที่อยู่</label>
                                        <textarea class="form-control required" id="n_addr" placeholder="กรุณากรอกที่อยู่..." rows="4">{{ $res->addr }}</textarea>
                                    </div>
                                    <div class="control-group form-group col-md-6">
                                        <label class="form-label">ประเภทลูกค้า</label>
                                        <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทลูกค้า" id="n_customertype"></select>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">สถานะผู้ใช้งาน <span class="text-red">*</span></label>
                                            <select class="form-select" id="active">
                                                <option value="1" {{ $res->active === 1 ? "Selected" : "" }}>Active</option>
                                                <option value="0" {{ $res->active === 0 ? "Selected" : "" }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="{{ route('customer') }}" class="btn btn-outline-primary me-2">Back</a>
                                        <a href="javascript:void(0)" onclick="update({{ $res->id }})" class="btn btn-primary">Save</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 END -->

    </div>
    <!-- CONTAINER END -->
@endsection


@section('script')

    <script>
    $( document ).ready(function() {
        $('#n_customertype').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        $('#active').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        getdataCusttype("{{ $res->customertype_id }}");
    });

    function getdataCusttype(id) {
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
                        html += '<option value="'+response.data[i].id+'" '+(response.data[i].id == id ? 'selected' : '')+'>'+response.data[i].name+'</option>';
                    }
                    $('#n_customertype').html(html);
                }
            },
            complete: function () {
            }
        });
    }

    function update(id) {
        if (validateInput() != false) {
            $.ajax({
                url: '{{ route('customer.update') }}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    n_fname: $('#n_fname').val(),
                    n_lname: $('#n_lname').val(),
                    n_birthdate: $('#n_birthdate').val(),
                    n_idcard: $('#n_idcard').val(),
                    n_bloodtype: $('#n_bloodtype').val(),
                    n_email: $('#n_email').val(),
                    n_tel: $('#n_tel').val(),
                    n_addr: $('#n_addr').val(),
                    n_customertype: $('#n_customertype :selected').val(),
                    active: $('#active').val(),
                },
                success: function (response) {
                    if(response.status == "success") {
                        swal({
                                title: "อัพเดทลูกค้าแล้ว!",
                                text: "Your infomation has been succesfully save.",
                                type: "success",
                                confirmButtonText: "OK",
                                confirmButtonClass: "btn-success",
                                },
                            function(isConfirm) {
                                if (isConfirm) {
                                    location.href = '{{ route('customer') }}';
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
        
    }


    function validateInput() {
        if ($('#n_fname').val() == '') { swal("กรุณากรอกชื่อลูกค้า"); return false; }
        if ($('#n_lname').val() == '') { swal("กรุณากรอกนามสกุลลูกค้า"); return false; }
        if ($('#n_birthdate').val() == '') { swal("กรุณากรอกวันเกิด"); return false; }
        if ($('#n_idcard').val() == '') { swal("กรุณากรอกเลขบัตรประชาชน"); return false; }
        if ($('#n_tel').val() == '') { swal("กรุณากรอกเบอร์โทรศัพท์"); return false; }
    }


    </script>
@endsection

