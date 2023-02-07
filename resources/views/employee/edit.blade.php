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
                                <div class="row mb-2">
                                    <div class="col-auto m-auto">
                                        <label class="form-label text-center">รูปโปรไฟล์</label>
                                        <img src="{{ empty($res->emp_img) ? asset('assets/images/prv_img.jpg') : $res->emp_img }}" alt="profile-user" id="prv_img" class="avata-xxl profile-user brround cover-image" style="height: 180px; width:180px; object-fit: cover;">
                                        <i class="fa fa-trash trash-profile-btn" id="clear_img" onclick="clearimgProfile()" style="display: none;"></i>
                                        <div class="form-group text-center mt-3">
                                            <label class="btn btn-sm btn-outline-primary mb-0"><i class="fas fa-file-import"></i> เลือกรูปภาพ...
                                                <input hidden type="file" id="inpt_person_img" accept=".png, .jpg" onchange="preview_image()">
                                            </label>
                                        </div>
                                    </div>
                                </div>
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
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">นามสกุล <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกนามสกุล" id="lname" value="{{ $res->emp_lname_th }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ตำแหน่ง <span class="text-red">*</span></label>
                                            <select name="position" id="position" class="form-control form-select" data-bs-placeholder="Select Position" disabled>
                                                @foreach($res_empposi as $psi)
                                                    <option value="{{ $psi->emp_posi_id }}" {{ $psi->emp_posi_id === $res->emp_posi_id ? "Selected" : "" }}>{{ $psi->emp_posi_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">วันเกิด <span class="text-red">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                </div>
                                                <input class="form-control fc-datepicker" name="birthdate" id="birthdate" placeholder="กรุณากรอกวันเกิด" type="text" value="{{ date('Y-m-d', strtotime($res->emp_birthdate)) }}">
                                            </div>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">สถานะผู้ใช้งาน <span class="text-red">*</span></label>
                                            <select class="form-select" id="active">
                                                <option value="1" {{ $res->active === 1 ? "Selected" : "" }}>Active</option>
                                                <option value="0" {{ $res->active === 0 ? "Selected" : "" }}>Inactive</option>
                                            </select>
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
                                        <a href="javascript:void(0)" onclick="updateEmp({{ $res->emp_id }}, '{{ $res->emp_code }}')" class="btn btn-primary">Save</a>
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
        var empimg = document.getElementById("prv_img").src;
        if (empimg.startsWith("data:")) {
            $('#clear_img').fadeIn(200);
        } else {
            $('#clear_img').fadeOut(200);
        }

    });

    function updateEmp(id, empcode) {
        var empimg = document.getElementById("prv_img").src;
        if (empimg.startsWith("data:")) {
            var valempimg = empimg;
        } else {
            var valempimg = null;
        }
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
                empimg: valempimg,
                empbirthdate: $('#birthdate').val(),
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

    async function preview_image() {
        const file = document.getElementById('inpt_person_img');
        const image = await process_image(file.files[0]);
        // console.log(image);
        document.getElementById("prv_img").src = image;
        $('#clear_img').fadeIn(200);
    }

    async function process_image(file, min_image_size = 300) {
        const res = await image_to_base64(file);
        if (res) {
            const old_size = calc_image_size(res);
            if (old_size > min_image_size) {
                const resized = await reduce_image_file_size(res);
                const new_size = calc_image_size(resized)
                console.log('new_size=> ', new_size, 'KB');
                console.log('old_size=> ', old_size, 'KB');
                return resized;
            } else {
                console.log('image already small enough')
                return res;
            }

        } else {
            console.log('return err')
            return null;
        }
    }

    async function image_to_base64(file) {
        let result_base64 = await new Promise((resolve) => {
            let fileReader = new FileReader();
            fileReader.onload = (e) => resolve(fileReader.result);
            fileReader.onerror = (error) => {
                console.log(error)
                alert('An Error occurred please try again, File might be corrupt');
            };
            fileReader.readAsDataURL(file);
        });
        return result_base64;
    }

    function calc_image_size(image) {
        let y = 1;
        if (image.endsWith('==')) {
            y = 2
        }
        const x_size = (image.length * (3 / 4)) - y
        return Math.round(x_size / 1024)
    }

    async function reduce_image_file_size(base64Str, MAX_WIDTH = 400, MAX_HEIGHT = 400) {
        let resized_base64 = await new Promise((resolve) => {
            let img = new Image()
            img.src = base64Str
            img.onload = () => {
                let canvas = document.createElement('canvas')
                let width = img.width
                let height = img.height

                if (width > height) {
                    if (width > MAX_WIDTH) {
                        height *= MAX_WIDTH / width
                        width = MAX_WIDTH
                    }
                } else {
                    if (height > MAX_HEIGHT) {
                        width *= MAX_HEIGHT / height
                        height = MAX_HEIGHT
                    }
                }
                canvas.width = width
                canvas.height = height
                let ctx = canvas.getContext('2d')
                ctx.drawImage(img, 0, 0, width, height)
                resolve(canvas.toDataURL()) // this will return base64 image results after resize
            }
        });
        return resized_base64;
    }


    function clearimgProfile() {
        $('#inpt_person_img').val('');
        document.getElementById('prv_img').src = "{{asset('assets/images/prv_img.jpg')}}";
        $('#clear_img').fadeOut(200);
    }


    </script>
@endsection

