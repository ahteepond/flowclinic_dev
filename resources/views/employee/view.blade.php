@extends('layouts.template')
@section('title','รายละเอียดพนักงาน') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee') }}">ข้อมูลพนักงาน</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-file-text-o me-2"></i>View Detail</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-auto m-auto">
                                        <label class="form-label text-center">รูปโปรไฟล์</label>
                                        <img src="{{ empty($res->emp_img) ? asset('assets/images/prv_img.jpg') : $res->emp_img }}" alt="profile-user" id="prv_img" class="avata-xxl profile-user brround cover-image" style="height: 180px; width:180px; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">รหัสพนักงาน</label>
                                            <p>{{ $res->emp_code }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อ</label>
                                            <p>{{ $res->emp_fname_th }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">นามสกุล</label>
                                            <p>{{ $res->emp_lname_th }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ตำแหน่ง</label>
                                            <p>{{ $res->emp_posi_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">วันเกิด</label>
                                            <p>{{ date('Y-m-d', strtotime($res->emp_birthdate)) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">เบอร์โทรศัพท์</label>
                                            <p>{{ $res->emp_tel }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">อีเมล์ </label>
                                            <p>{{ $res->emp_email != "" ? $res->emp_email : "-" }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label">สถานะใช้งาน</label>
                                                @if ($res->active === 1)
                                                    <p><span class="badge rounded-pill bg-success-gradient badge-sm me-1 mb-1 mt-1 py-2 px-3">Active</span></p>
                                                @endif
                                                @if ($res->active === 0)
                                                    <p><span class="badge rounded-pill bg-default-gradient badge-sm me-1 mb-1 mt-1 py-2 px-3">Inactive</span></p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label class="form-label">รหัสผ่าน</label>
                                                <button class="btn btn-sm btn-outline-danger" onclick="resetPwd('{{ $res->emp_id }}', '{{ $res->emp_code }}', '{{ $res->emp_fname_th }} {{ $res->emp_lname_th }}')"><i class="mdi mdi-account-key me-2"></i>รีเซ็ตรหัสผ่าน</button> <cite class="text-primary ms-1" style="font-size: 0.8rem">รีเซ็ตรหัสผ่านเป็น 88888888</cite>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="{{ route('employee') }}" class="btn btn-outline-primary me-2">Back</a>
                                        <a href="javascript:void(0)" onclick="edit('{{ $res->emp_code }}')" class="btn btn-primary">Edit</a>
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
        // alert( "ready!" );
    });

    function edit(empcode) {
        var url = "{{ route('employee.edit', '')}}"+"/"+empcode;
        location.href = url;
    }

    function resetPwd(id, empcode, fname) {
        swal({
            title: "คำเตือน!",
            text: "หากยืนยันการรีเซ็ตรหัสผ่าน ผู้ใช้จะต้องทำการตั้งรหัสผ่านใหม่เมื่อเข้าสู่ระบบครั้งถัดไป ("+empcode+" : "+fname+")",
            type: "warning",
            confirmButtonText: "ยืนยันรีเซ็ตรหัสผ่าน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            closeOnConfirm: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('user.resetpassword') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        empcode: empcode,
                    },
                    success: function (response) {
                        if(response.status == "success") {
                            swal({
                                title: "รีเซ็ตรหัสผ่านเรียบร้อย!",
                                text: "",
                                type: "success",
                                confirmButtonText: "OK",
                                confirmButtonClass: "btn-success",
                                closeOnConfirm: true,
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

