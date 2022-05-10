@extends('layouts.template')
@section('title','แก้ไขพนักงาน') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee') }}">ข้อมูลพนักงาน</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.view', '')}}/{{ $res->emp_code }}">รายละเอียดพนักงาน</a></li>
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
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">รหัสพนักงาน <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกรหัสพนักงาน" id="empcode" value="{{ $res->emp_code }}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อ <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ" id="fname" value="{{ $res->emp_fname_th }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">นามสกุล <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกนามสกุล" id="lname" value="{{ $res->emp_lname_th }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">ตำแหน่ง <span class="text-red">*</span></label>
                                            <select name="position" id="position" class="form-control form-select" data-bs-placeholder="Select Position">
                                                @foreach($res_empposi as $psi)
                                                    <option value="{{ $psi->emp_posi_id }}" {{ $psi->emp_posi_id === $res->emp_posi_id ? "Selected" : "" }}>{{ $psi->emp_posi_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกเบอร์โทรศัพท์" id="tel" value="{{ $res->emp_tel }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">อีเมล์ </label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกอีเมล์" id="email" value="{{ $res->emp_email }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
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
                                        <a href="{{ route('employee') }}" class="btn btn-outline-primary me-2">Back</a>
                                        <a href="javascript:void(0)" onclick="updateEmp({{ $res->emp_id }}, {{ $res->emp_code }})" class="btn btn-primary">Save</a>
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
        $('#position').select2({
            minimumResultsForSearch: '',
            width: '100%'
        });
        $('#active').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
    });

    function updateEmp(id, empcode) {
        $.ajax({
            url: '{{ route('employee.update') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                empcode: empcode,
                empfname: $('#fname').val(),
                emplname: $('#lname').val(),
                empposi: $('#position :selected').val(),
                emptel: $('#tel').val(),
                empemail: $('#email').val(),
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
                            location.href = '{{ route('employee') }}';
                        }
                    });
                }
            },
            complete: function () {
            }
        });
    }


    </script>
@endsection

