@extends('layouts.template')
@section('title','ทำใบนัดใหม่') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('customertype') }}">ออกใบนัด</a></li>
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
                                        <p class="fs-18 fw-semibold mb-0"><a href="javascript:void(0)">{{ $info->cust_code }}</a><br> {{ $info->cust_fname }} {{ $info->cust_lname }}</p>
                                        <address>
                                            <span><b>{{ $info->cust_tel }}</b></span><br>
                                            {{ $info->cust_addr }}
                                        </address>
                                    </div>
                                    <div class="col-lg-12 text-start">
                                        <p class="mb-1">เลขบัตรประชาชน : {{ $info->cust_idcard }}</p>
                                        <p class="mb-1">วันเกิด : {{ $info->cust_bdate }}</p>
                                        <p class="mb-1">อายุ : {{ $info->cust_bdate }} ปี</p>
                                        <p class="mb-1">กรุ๊ปเลือด : {{ $info->cust_bloodtype }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-md-12 col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-plus me-2"></i>ข้อมูลใบนัดใหม่
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 text-end">
                                        <p class="">สินค้าจากใบสั่งซื้อ <a href="#"><b>{{ $info->order_code }}</b></a></p>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="h3">ข้อมูลบริการ</p>
                                        <p class="fs-16 mb-2">ประเภทบริการ: {{ $info->servicetype_nameth }}</p>
                                        <p class="fs-18 fw-semibold mb-0">บริการ: {{ $info->servicemaster_nameth }} ({{ $info->servicemaster_nameen }})</p>
                                        <p class="fs-16 fw-semibold mb-2">{{ $info->service_nameth }} ({{ $info->service_nameen }})</p>
                                        <p class="fs-16  mb-0">จำนวนครั้งที่นัดแล้ว: <span class="fs-20">{{ $round }} ครั้ง</span></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12"><hr></div>
                                    <div class="col-md-5">
                                        <div class="row mb-4">
                                            <div class="col-auto my-auto"><span class="fs-25">นัดครั้งที่</span></div>
                                            <div class="col"><input class="form-control fs-25 text-center" id="round_at" type="text" value="{{ $round+1 }}" readonly></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto"><span class="fs-20">วันที่นัด</span></div>
                                            <div class="col-auto">
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                        <input class="form-control fc-datepicker" id="appt_date" placeholder="กรุณาระบุวันที่..." type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto"><span class="fs-20">เวลานัด</span></div>
                                            <div class="col-auto">
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-clock-o tx-16 lh-0 op-6"></i>
                                                        </div>
                                                        <input class="form-control" id="appt_time" placeholder="กรุณาระบุเวลา..." type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12"><hr></div>
                                    <div class="col-12"><label class="form-label mb-3 h4 fw-semibold">บันทึก</label></div>
                                    <div class="col-12"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-floating floating-label1">
                                                <textarea class="form-control" placeholder="Comments" id="note_newapt" style="height: 100px"></textarea>
                                                <label for="note_newapt"><i class="fa fa-sticky-note-o me-2 text-azure"></i>บันทึกใบนัด</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5">
                                    <div class="col-md-12 text-center">
                                        <hr>
                                        <button class="btn btn-primary my-2 ms-2"  onclick="newAppointment('')">บันทึกใบนัด</button>
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

    <!-- SELECT2 JS -->
    <script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- Internal Timeline js-->
    <script src="{{ asset('assets/plugins/timeline/js/timeline.min.js') }}"></script>

    <!-- FULL CALENDAR JS -->
    <script src="{{ asset('assets/plugins/fullcalendar/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/fullcalendar/fullcalendar.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
        $('#appt_time').timepicker({
            'timeFormat': 'H:i'
        });
    });

    function checkAppointmentDate(val) {
        if (val != "") {
            $('#res_queue').fadeIn();
        } else {
            $('#res_queue').fadeOut();
        }
    }

    function confirmMakeAppointment() {
        swal({
            title: "ยืนยันการนัด",
            type: "warning",
            confirmButtonText: "ยืนยัน",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {

            }
        });
    }

    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        width: '100%'
    });

    var dataTable = $('#datatable').DataTable({});
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    function newAppointment() {
        if ($('#appt_date').val() == "") {
            swal({
                title: "กรุณาระบุวันที่นัด",
                type: "error",
                confirmButtonText: "OK",
                confirmButtonClass: "btn-success",
            });
            return false;
        }
        if ($('#appt_time').val() == "") {
            swal({
                title: "กรุณาระบุเวลานัด",
                type: "error",
                confirmButtonText: "OK",
                confirmButtonClass: "btn-success",
            });
            return false;
        }
        var orderdetail_id = '{{ $info->id }}';
        var order_code = '{{ $info->order_code }}';
        var service_name = '{{ $info->service_nameth }} ({{ $info->service_nameen }})';
        var servicemaster_name = '{{ $info->servicemaster_nameth }} ({{ $info->servicemaster_nameen }})';
        var servicetype_name = '{{ $info->servicetype_nameth }}';
        var cust_code = '{{ $info->cust_code }}';
        var round_at = $('#round_at').val();
        var appointment_date = $('#appt_date').val();
        var appointment_time = $('#appt_time').val();
        var note = $('#note_newapt').val();
        var creator = "{{ session()->get('session_empcode') }}";
        swal({
            title: "ยืนยันข้อมูลใบนัด",
            text: "กรุณาตรวจสอบข้อมูลให้ถูกต้อง หลังจากกดยืนยันแล้ว ระบบจะทำการบันทึกข้อมูล",
            type: "warning",
            confirmButtonText: "ยืนยันข้อมูลถูกต้อง",
            cancelButtonText: 'ยกเลิก',
            showCancelButton: true,
            },
            function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: '{{ route('appointment.insert') }}',
                    method: 'post',
                    data: {
                        _token: "{{ csrf_token() }}",
                        orderdetail_id: orderdetail_id,
                        order_code: order_code,
                        service_name : service_name,
                        servicemaster_name : servicemaster_name,
                        servicetype_name : servicetype_name,
                        cust_code : cust_code,
                        round_at : round_at,
                        appointment_date : appointment_date,
                        appointment_time : appointment_time,
                        note : note,
                        creator : creator
                    },
                    success: function (response) {
                        console.log(response.status);
                        if(response.status == "success") {
                            swal({
                                title: "สร้างใบนัดแล้ว!",
                                text: "Your infomation has been succesfully save.",
                                type: "success",
                                confirmButtonText: "OK",
                                confirmButtonClass: "btn-success",
                                },
                            function(isConfirm) {
                                if (isConfirm) {
                                    var url = "{{ route('appointment.checklist')}}";
                                    location.href = url;
                                }
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

