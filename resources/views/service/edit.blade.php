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
                    <li class="breadcrumb-item"><a href="{{ route('service.view') }}">รายละเอียดบริการ</a></li>
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
                                            <label class="form-label">ชื่อบริการ <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อบริการ" id="" value="เสริมหน้าอก (Breast Augmentation)">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อบริการย่อย <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อบริการย่อย" id="" value="ซิลิโคน ซิลิเมต (Silicone Silimed) ">
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">รายละเอียด </label>
                                            <textarea class="form-control" name="" id="" rows="5" placeholder="กรุณากรอกรายละเอียด">ไม่เกิน 400cc เกิน 3,000</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ราคา <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกราคา" id="" value="45,000">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ราคาโปรโมชั่น <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกราคาโปรโมชั่น" id="" value="26,900">
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">สถานะใช้งาน <span class="text-red">*</span></label>
                                            <select class="form-select" id="active">
                                                <option value="1" selected>Active</option>
                                                <option value="0" >Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="{{ route('service') }}" class="btn btn-outline-primary me-2">Back</a>
                                        <a href="javascript:void(0)" onclick="update()" class="btn btn-primary">Save</a>
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

    function update() {
        console.log('Update Function');
    }

    </script>
@endsection

