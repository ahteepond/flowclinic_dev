@extends('layouts.template')
@section('title','เพิ่มพนักงาน') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">เพิ่มพนักงาน</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee') }}">จัดการข้อมูลพนักงาน</a></li>
                    <li class="breadcrumb-item active" aria-current="page">เพิ่มพนักงาน</li>
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
                                    <div class="col-sm-12 col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">รหัสพนักงาน <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกรหัสพนักงาน" id="empcode">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อ <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อ" id="fname">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">นามสกุล <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกนามสกุล" id="lname">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">สถานะผู้ใช้งาน <span class="text-red">*</span></label>
                                            <select class="form-select" id="active">
                                                <option value="1" selected>Active</option>
                                                <option value="0" >Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="javascript:void(0)" onclick="insertEmp()" class="btn btn-info">Save</a>
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

    function insertEmp() {
        $.ajax({
            url: '{{ route('employee.insert') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                empcode: $('#empcode').val(),
                empfname: $('#fname').val(),
                emplname: $('#lname').val(),
                active: $('#active :selected').val(),
            },
            success: function (response) {
                if(response.status == "success") {
                    alert('Saved!');
                    window.location.href = '{{ route('employee') }}';
                }
            },
            complete: function () {
            }
        });
    }

    </script>
@endsection

