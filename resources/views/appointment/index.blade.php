@extends('layouts.template')
@section('title','ออกใบนัด') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">

                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <div class="card  bg-success img-card box-success-shadow">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="text-white">
                                        <h2 class="mb-0 number-font">ออกใบนัด</h2>
                                        <p class="text-white mb-0">New Appointment</p>
                                    </div>
                                    <div class="ms-auto"> <i class="fa fa-plus text-white fs-30 me-2 mt-2"></i> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-8 text-start">
                                    <h3 class="card-title"><i class="fa fa-search me-2"></i>ค้นหารายละเอียดการนัดหมาย</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">ชื่อลูกค้า</label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อวิธีการชำระเงิน" id="">
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-primary">ตกลง</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- ROW END -->

    </div>
    <!-- CONTAINER END -->
@endsection


@section('script')

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
        $('#datatableinfo').DataTable();
    });

    function searchTable() {
        // dataTable.ajax.reload();
    }

    </script>
@endsection

