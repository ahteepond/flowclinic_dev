@extends('layouts.template')
@section('title','Dashboard') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">

                    <div class="col-xl-3 col-md-12 col-lg-6">
                        <div class="card overflow-hidden">
                            <div class="card-body text-center">
                                <h6 class=""><span class="text-secondary"><i class="fe fe-users mx-2 fs-20 text-secondary-shadow"></i></span>Total Employees</h6>
                                <h3 class="text-dark counter mt-0 mb-3 number-font">2,897</h3>
                                <div class="progress h-1 mt-0 mb-2">
                                    <div class="progress-bar progress-bar-striped  bg-secondary" style="width: 50%;" role="progressbar"></div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col text-center"> <span class="text-muted">Male</span>
                                        <h4 class="fw-normal mt-2 mb-0 number-font1">378</h4>
                                    </div>
                                    <div class="col text-center"> <span class="text-muted">Female</span>
                                        <h4 class="fw-normal mt-2 mb-0 number-font1">689</h4>
                                    </div>
                                    <div class="col text-center"> <span class="text-muted">Total</span>
                                        <h4 class="fw-normal mt-2 mb-0 number-font1">1,069</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-12 col-lg-6">
                        <div class="card overflow-hidden">
                            <div class="card-body text-center">
                                <h6 class=""><span class="text-info"><i class="fe fe-tag mx-2 fs-20 text-info-shadow"></i></span>Total Tasks</h6>
                                <h3 class="text-dark counter mt-0 mb-3 number-font">4,293</h3>
                                <div class="progress h-1 mt-0 mb-2">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" style="width: 40%;" role="progressbar"></div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col text-center"> <span class="text-muted">Weekly</span>
                                        <h4 class="fw-normal mt-2 mb-0 number-font1">35</h4>
                                    </div>
                                    <div class="col text-center"> <span class="text-muted">Monthly</span>
                                        <h4 class="fw-normal mt-2 mb-0 number-font1">56</h4>
                                    </div>
                                    <div class="col text-center"> <span class="text-muted">Total</span>
                                        <h4 class="fw-normal mt-2 mb-0 number-font1">91</h4>
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
    </script>
@endsection

