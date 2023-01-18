@extends('layouts.template')
@section('title','แก้ไขรายการบริการ') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('service') }}">รายการบริการ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('service.view', '')}}{{ '/'.$res->id }}">รายละเอียดบริการ</a></li>
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
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label"> ประเภทบริการ <span class="text-red">*</span></label>
                                            <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทบริการ" id="servicetype" onchange="selectServiceType()">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">บริการหลัก <span class="text-red">*</span></label>
                                            <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทบริการ" id="servicemaster" onchange="">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">บริการย่อย (TH) <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อบริการย่อย" id="service_nameth" value="{{ $res->service_nameth }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">บริการย่อย (EN) </label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อบริการย่อย" id="service_nameen" value="{{ $res->service_nameen }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">รายละเอียด </label>
                                            <textarea class="form-control" rows="5" placeholder="กรุณากรอกรายละเอียด" id="description">{{ $res->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ราคา <span class="text-red">*</span></label>
                                            <input type="number" min="1" step="any" class="form-control price" placeholder="กรุณากรอกราคา" id="price" value="{{ $res->price }}" onclick="$(this).select();">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ราคาโปรโมชั่น <span class="text-red">*</span></label>
                                            <input type="number" min="1" step="any" class="form-control price" placeholder="กรุณากรอกราคาโปรโมชั่น" id="price_promo" value="{{ $res->price_promo }}" onclick="$(this).select();">
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">สถานะใช้งาน <span class="text-red">*</span></label>
                                            <select class="form-select" id="active">
                                                <option value="1" {{ $res->active === 1 ? "Selected" : "" }}>Active</option>
                                                <option value="0" {{ $res->active === 0 ? "Selected" : "" }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="{{ route('service') }}" class="btn btn-outline-primary me-2">Back</a>
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
        $('#servicetype').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('#servicemaster').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('#active').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
        getdataServicetype("{{ $res->servicetype_id }}", "{{ $res->servicemaster_id }}");
    });

    function selectServiceType() {
        var id = $('#servicetype :selected').val();
        getdataServicetype(id);
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
                    var html = '<option label="กรุณาเลือกประเภทบริการ"></option>';
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
                    var html = '<option label="กรุณาเลือกบริการหลัก"></option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].id+'" '+(response.data[i].id == fload ? 'selected' : '')+' >'+response.data[i].name_th+' ('+response.data[i].name_en+')'+'</option>';
                    }
                    $('#servicemaster').html(html);
                    console.log(response);
                }
            },
            complete: function () {

            }
        });
    }

    function update(id) {
        if (validateInput() != false) {
            $.ajax({
                url: '{{ route('service.update') }}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    servicetypeid: $('#servicetype :selected').val(),
                    servicemasterid: $('#servicemaster :selected').val(),
                    service_nameth: $('#service_nameth').val(),
                    service_nameen: $('#service_nameen').val(),
                    description: $('#description').val(),
                    price: $('#price').val(),
                    price_promo: $('#price_promo').val(),
                    active: $('#active :selected').val(),
                },
                success: function (response) {
                    if(response.status == "success") {
                        swal({
                            title: "Updated!",
                            text: "Your infomation has been succesfully update.",
                            type: "success",
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn-success",
                            closeOnConfirm: false,
                            },
                            function(isConfirm) {
                            if (isConfirm) {
                                location.href = '{{ route('service') }}';
                            }
                        });
                    }
                },
                complete: function () {
                }
            });
        }
    }


    function validateInput() {
        if ($('#servicetype :selected').val() == '') {
            swal("กรุณาเลือกประเภทบริการ");
            return false;
        }
        if ($('#servicemaster :selected').val() == '') {
            swal("กรุณาเลือกบริการหลัก");
            return false;
        }
        if ($('#service_nameth').val() == '') {
            swal("กรุณากรอกชื่อบริการย่อย (TH)");
            return false;
        }
        if ($('#price').val() == 0) {
            swal("กรุณากรอกราคา");
            return false;
        }
        if ($('#price_promo').val() == 0) {
            swal("กรุณากรอกราคาโปรโมชั่น");
            return false;
        }
    }

    </script>
@endsection

