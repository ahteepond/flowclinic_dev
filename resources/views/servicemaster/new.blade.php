@extends('layouts.template')
@section('title','เพิ่มบริการหลัก') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('servicemaster') }}">บริการหลัก</a></li>
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
                                <h3 class="card-title"><i class="fa fa-plus me-2"></i>New</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label"> ประเภทบริการ <span class="text-red">*</span></label>
                                            <select class="form-control form-select" data-placeholder="กรุณาเลือกประเภทบริการ" id="servicetype" onchange="selectServiceType()">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">บริการหลัก (TH) <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อบริการหลัก" id="servicemaster_nameth" value="">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">บริการหลัก (EN)</label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อบริการหลัก" id="servicemaster_nameen" value="">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">สถานะ <span class="text-red">*</span></label>
                                            <select class="form-select" id="active">
                                                <option value="1" selected>Active</option>
                                                <option value="0" >Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="{{ route('servicemaster') }}" class="btn btn-outline-primary me-2">Back</a>
                                        <a href="javascript:void(0)" onclick="insert()" class="btn btn-primary">Save</a>
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
        getdataServicetype();
    });

    function selectServiceType() {
        var id = $('#servicetype :selected').val();
        getdataServicetype(id);
    }

    function getdataServicetype(id, fload) {
        $.ajax({
            url: '{{ route('servicemaster.getdata') }}',
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
            }
        });
    }


    function insert() {
        if (validateInput() != false) {
            $.ajax({
                url: '{{ route('servicemaster.insert') }}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    servicetypeid: $('#servicetype :selected').val(),
                    servicemaster_nameth: $('#servicemaster_nameth').val(),
                    servicemaster_nameen: $('#servicemaster_nameen').val(),
                    active: $('#active :selected').val(),
                },
                success: function (response) {
                    if(response.status == "success") {
                        swal({
                            title: "Saved!",
                            text: "Your infomation has been succesfully save.",
                            type: "success",
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn-success",
                            closeOnConfirm: false,
                            },
                            function(isConfirm) {
                            if (isConfirm) {
                                location.href = '{{ route('servicemaster') }}';
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
        if ($('#servicemaster_nameth').val() == '') {
            swal("กรุณากรอกชื่อบริการหลัก (TH)");
            return false;
        }
    }

    </script>
@endsection

