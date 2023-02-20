@extends('layouts.template')
@section('title','รายละเอียดบันทึกประวัติ OPD') {{-- Title --}}

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('opd') }}">บันทึกประวัติ OPD</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">
                    <div class="col-xl-3 col-md-12 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-user me-2"></i>ข้อมูลลูกค้า
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="fs-18 fw-semibold mb-0"><a href="#" id="customercode"></a><br> <span id="fullname"></span></p>
                                        <address>
                                            <b><span id="tel"></span></b><br>
                                            <span id="addr"></span>
                                        </address>
                                    </div>
                                    <div class="col-lg-12 text-start">
                                        <p class="mb-1">เลขบัตรประชาชน : <span id="idcard"></span> </p>
                                        <p class="mb-1">วันเกิด : <span id="bdate"></span></p>
                                        <p class="mb-1">อายุ : <span id="age"></span> ปี</p>
                                        <p class="mb-1">กรุ๊ปเลือด : <span id="bloodtype"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-md-12 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-file-text me-2"></i>ประวัติ OPD ทั้งหมด
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">

                                    @foreach ($opddtl as $opd)
                                    <div class="col-md-12">
                                        <div class="expanel expanel-default">
                                            <div class="expanel-body">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                            <label class="form-label">เลขที่ใบนัด</label>
                                                            <h2>{{ $opd->appointment_code }}</h2>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <div class="row mt-6">
                                                            <div class="col-md-12">
                                                                <p class="h4 fw-semibold">ข้อมูลบริการ</p>
                                                                <hr class="my-1">
                                                            </div>
                                                            <div class="col-md">
                                                                <p class="fs-14 mb-0"><span class="fw-semibold">บริการ : </span><span class="clear_dtl_t" id="dtl_service_master">{{ $opd->servicemaster_name }}</span></p>
                                                                <p class="fs-14 mb-0"><span class="clear_dtl_t" id="dtl_service">{{ $opd->service_name }}</span></p>
                                                            </div>
                                                            <div class="col-md">
                                                                <p class="fs-14 mb-0"><span class="fw-semibold">ประเภทบริการ : </span><span class="clear_dtl_t" id="dtl_service_type">{{ $opd->servicetype_name }}</span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <hr>
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-lg-auto">
                                                        <p class="h3 mt-3">ครั้งที่: <span class="text-info fs-30">{{ $opd->round_at }}</span></p>
                                                    </div>
                                                    <div class="col-lg border-bottom border-lg-0">
                                                        <h5 class="mt-3">วันที่นัด: <br> {{ $opd->appointment_date }} {{ $opd->appointment_time }}</h5>
                                                        <h5 class="mt-2">วันที่เข้ารับการรักษา: <br> {{ $opd->created_at }}</h5>
                                                    </div>
                                                    <div class="col-lg pb-3">
                                                        <div class="row mb-3">
                                                            <div class="col-12 my-auto fw-semibold fs-20">หมอ</div>
                                                            <div class="col-12 my-auto">
                                                                <p class="mb-0">{{ $opd->doctor_code.' '.$opd->doctor_name }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg pb-3">
                                                        <div class="row">
                                                            <div class="col-auto my-auto fw-semibold fs-20">พยาบาล</div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <ol class="order-list ps-4">
                                                                    <li>{{ $opd->or1_code.' '.$opd->or1_name }} </li>
                                                                    @if ($opd->or2_code)
                                                                    <li>{{ $opd->or2_code.' '.$opd->or2_name }} </li>
                                                                    @endif
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 my-auto fw-semibold fs-20 pb-3">ประวัติ OPD</div>
                                                    <div class="col-md-12">
                                                        <div class="media mb-2 overflow-visible d-block d-sm-flex">
                                                            <div class="me-3 mb-2">
                                                                <i class="fa fa-stethoscope fs-16 me-1 p-3 bg-primary-transparent text-primary bradius" aria-hidden="true"></i>
                                                            </div>
                                                            <div class="media-body overflow-visible">
                                                                <div class="border mb-2 p-4 br-5">
                                                                    <span><i class="fe fe-thumb-up text-danger"></i></span>
                                                                    <p class="font-13 text-muted">{{ $opd->note }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
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

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>


    <script>
    $( document ).ready(function() {
        setCustomerInfo();
    });

    function setCustomerInfo() {
        var filtertype = "code";
        var filtertext = "{{ $custcode->code }}";
        $.ajax({
            url: '{{ route('opd.search') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                filtertype: filtertype,
                filtertext: filtertext,
            },
            success: function (response) {
                if(response.status == "success") {
                    //Set Customer Info
                    $('#customercode').html(response.customer.code);
                    $('#fullname').html(response.customer.fname + ' ' + response.customer.lname);
                    $('#tel').html(response.customer.tel);
                    $('#addr').html(response.customer.addr);
                    $('#idcard').html(response.customer.idcard);
                    $('#bdate').html(response.customer.bdate);
                    $('#age').html(getAge(response.customer.bdate));
                    $('#bloodtype').html(response.customer.bloodtype);
                }
            },
            complete: function () {
            }
        });
    }

    function getAge(dateString) {
        var date = dateString;
        var fullage = moment(dateString, "YYYY-MM-DD").fromNow(true);
        var age = fullage.split(" ", 1);
        return age;
    }

    </script>
@endsection
