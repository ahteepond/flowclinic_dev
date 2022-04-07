@extends('layouts.template')
@section('title','รายละเอียดบริการ') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('service') }}">รายการบริการ</a></li>
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
                                <h3 class="card-title"><i class="fa fa-file-text-o me-2"></i>View Detail</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อบริการ <span class="text-red">*</span></label>
                                            <p>เสริมหน้าอก (Breast Augmentation)</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อบริการย่อย <span class="text-red">*</span></label>
                                            <p>ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">รายละเอียด </label>
                                            <p>ไม่เกิน 400cc เกิน 3,000</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ราคา <span class="text-red">*</span></label>
                                            <p>45,000 บาท</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">ราคาโปรโมชั่น <span class="text-red">*</span></label>
                                            <p>26,900 บาท</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">สถานะใช้งาน <span class="text-red">*</span></label>
                                            <p>Active</p>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="{{ route('service') }}" class="btn btn-outline-primary me-2">Back</a>
                                        <a href="{{ route('service.edit') }}" onclick="edit()" class="btn btn-primary">Edit</a>
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

    function edit() {
        console.log('edit Function');
    }

    </script>
@endsection

