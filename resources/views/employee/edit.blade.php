@extends('layouts.template')
@section('title','แก้ไขพนักงาน') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">แก้ไขพนักงาน</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee') }}">จัดการข้อมูลพนักงาน</a></li>
                    <li class="breadcrumb-item active" aria-current="page">แก้ไขพนักงาน</li>
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
                                        <a href="javascript:void(0)" onclick="updateEmp({{ $res->id }}, {{ $res->emp_code }})" class="btn btn-info">Save</a>
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
                active: $('#active :selected').val(),
            },
            success: function (response) {
                if(response.status == "success") {
                    alert('Updated!');
                    window.location.href = '{{ route('employee') }}';
                }
            },
            complete: function () {
            }
        });
    }

    </script>
@endsection

