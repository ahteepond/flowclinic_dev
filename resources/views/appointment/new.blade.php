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
                                        <p class="fs-18 fw-semibold mb-0"><a href="#">CUS-0001</a><br> พงศกร เหล่านิยมไทย</p>
                                        <address>
                                            <span><b>081 234 5678</b></span><br>
                                            เลขที่ 1/2 แขวงลาดพร้าว เขตลาดพร้าว
                                            กรุงเทพมหานคร, 10230
                                        </address>
                                    </div>
                                    <div class="col-lg-12 text-start">
                                        <p class="mb-1">เลขบัตรประชาชน : 1234567898765</p>
                                        <p class="mb-1">วันเกิด : 01/01/2500</p>
                                        <p class="mb-1">อายุ : 65 ปี</p>
                                        <p class="mb-1">กรุ๊ปเลือด : โอ</p>
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
                                    <div class="col-md-6">
                                        <p class="h3">ข้อมูลบริการ:</p>
                                        <p class="fs-16 fw-semibold mb-0">ประเภทบริการ: ศัลยกรรมใหญ่</p>
                                        <p class="fs-18 fw-semibold mb-0">บริการ: เสริมหน้าอก (Breast Augmentation)</p>
                                        <p class="fs-16 fw-semibold mb-0">บริการย่อย: ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                        <p class="fs-16 fw-semibold mb-0">จำนวนครั้งที่นัดแล้ว: <span class="fs-20">0 ครั้ง</span></p>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p class="pt-5">สินค้าจากใบสั่งซื้อ <a href="#"><b>ORD-0001</b></a></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12"><hr></div>
                                    <div class="col-12">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto"><span class="fs-25">นัดครั้งที่</span></div>
                                            <div class="col-2"><input class="form-control fs-25 text-center" type="text" value="1" readonly></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto"><span class="fs-20">เลือกหมอ</span></div>
                                            <div class="col">
                                                <select class="form-control select2-show-search form-select fs-20" data-placeholder="กรุณาเลือกหมอ...">
                                                    <option value="0" selected disabled>กรุณาเลือกหมอ...</option>
                                                    <option value="1">EMP-D001 คุณหมอ คนที่หนึ่ง</option>
                                                    <option value="2">EMP-D002 คุณหมอ คนที่สอง</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mb-3">
                                            <div class="col-auto my-auto"><span class="fs-20">เลือกวันที่นัด</span></div>
                                            <div class="col">
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <div class="input-group-text">
                                                            <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                                                        </div>
                                                        <input onchange="checkAppointmentDate(this.value)" class="form-control fc-datepicker" name="order_date" id="order_date" placeholder="กรุณาระบุวันที่ต้องการนัด..." type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-5" id="res_queue" style="display: none;">
                                    <div class="col-12">
                                        <div class="expanel expanel-default">
                                            <div class="expanel-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h3 class="mb-2 mt-5 px-3 fw-bold">Queue Result</h3>
                                                        <h4 class="my-1 px-3 fw-semibold">วันที่: 08/04/2022</h4>
                                                        <h4 class="mb-5 px-3 fw-semibold">ชื่อหมอ: EMP-D001 คุณหมอ คนที่หนึ่ง</h4>
                                                        <hr>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="vtimeline">
                                                            <div class="timeline-wrapper timeline-wrapper-danger">
                                                                <div class="avatar avatar-md timeline-badge">
                                                                    <span class="timeline-icon"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                                <div class="timeline-panel">
                                                                    <div class="timeline-heading">
                                                                        <h6 class="timeline-title">เวลา 09:00 - 10:00</h6>
                                                                    </div>
                                                                    <div class="timeline-body">
                                                                        <p class="mb-0">เลขที่ใบนัด: APT-0095</p>
                                                                        <p class="mb-0">ประเภทบริการ: ศัลยกรรมใหญ่</p>
                                                                        <p class="mb-0">บริการ: เสริมหน้าอก (Breast Augmentation)</p>
                                                                        <p class="mb-0">บริการย่อย: ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                                                        <p class="mb-4">ชื่อลูกค้า: นายกอ กอสกุล</p>
                                                                    </div>
                                                                    <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                                        <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>08/04/2022</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">
                                                                <div class="avatar avatar-md timeline-badge">
                                                                    <span class="timeline-icon"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                                <div class="timeline-panel">
                                                                    <div class="timeline-heading">
                                                                        <h6 class="timeline-title">เวลา 10:00 - 11:00</h6>
                                                                    </div>
                                                                    <div class="timeline-body">
                                                                        <p class="mb-0">เลขที่ใบนัด: APT-0096</p>
                                                                        <p class="mb-0">ประเภทบริการ: ศัลยกรรมใหญ่</p>
                                                                        <p class="mb-0">บริการ: เสริมหน้าอก (Breast Augmentation)</p>
                                                                        <p class="mb-0">บริการย่อย: ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                                                        <p class="mb-4">ชื่อลูกค้า: นายกอ กอสกุล</p>
                                                                    </div>
                                                                    <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                                        <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>08/04/2022</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-wrapper timeline-wrapper-danger">
                                                                <div class="avatar avatar-md timeline-badge">
                                                                    <span class="timeline-icon"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                                <div class="timeline-panel">
                                                                    <div class="timeline-heading">
                                                                        <h6 class="timeline-title">เวลา 11:00 - 12:00</h6>
                                                                    </div>
                                                                    <div class="timeline-body">
                                                                        <p class="mb-0">เลขที่ใบนัด: APT-0097</p>
                                                                        <p class="mb-0">ประเภทบริการ: ศัลยกรรมใหญ่</p>
                                                                        <p class="mb-0">บริการ: เสริมหน้าอก (Breast Augmentation)</p>
                                                                        <p class="mb-0">บริการย่อย: ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                                                        <p class="mb-4">ชื่อลูกค้า: นายกอ กอสกุล</p>
                                                                    </div>
                                                                    <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                                        <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>08/04/2022</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">
                                                                <div class="avatar avatar-md timeline-badge">
                                                                    <span class="timeline-icon"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                                <div class="timeline-panel">
                                                                    <div class="timeline-heading">
                                                                        <h6 class="timeline-title">เวลา 13:00 - 14:00</h6>
                                                                    </div>
                                                                    <div class="timeline-body">
                                                                        <p class="mb-0">เลขที่ใบนัด: APT-0098</p>
                                                                        <p class="mb-0">ประเภทบริการ: ศัลยกรรมใหญ่</p>
                                                                        <p class="mb-0">บริการ: เสริมหน้าอก (Breast Augmentation)</p>
                                                                        <p class="mb-0">บริการย่อย: ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                                                        <p class="mb-4">ชื่อลูกค้า: นายกอ กอสกุล</p>
                                                                    </div>
                                                                    <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                                        <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>08/04/2022</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-wrapper timeline-wrapper-success" role="button" onclick="confirmMakeAppointment()">
                                                                <div class="avatar avatar-md timeline-badge">
                                                                    <span class="timeline-icon"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                                <div class="timeline-panel">
                                                                    <div class="timeline-heading">
                                                                        <h6 class="timeline-title">เวลา 14:00 - 15:00</h6>
                                                                    </div>
                                                                    <div class="timeline-body">
                                                                        <p class="mb-0">ว่าง</p>
                                                                    </div>
                                                                    <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                                        <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>08/04/2022</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">
                                                                <div class="avatar avatar-md timeline-badge">
                                                                    <span class="timeline-icon"><i class="fa fa-clock-o"></i></span>
                                                                </div>
                                                                <div class="timeline-panel">
                                                                    <div class="timeline-heading">
                                                                        <h6 class="timeline-title">เวลา 16:00 - 17:00</h6>
                                                                    </div>
                                                                    <div class="timeline-body">
                                                                        <p class="mb-0">เลขที่ใบนัด: APT-0099</p>
                                                                        <p class="mb-0">ประเภทบริการ: ศัลยกรรมใหญ่</p>
                                                                        <p class="mb-0">บริการ: เสริมหน้าอก (Breast Augmentation)</p>
                                                                        <p class="mb-0">บริการย่อย: ซิลิโคน ซิลิเมต (Silicone Silimed)</p>
                                                                        <p class="mb-4">ชื่อลูกค้า: นายกอ กอสกุล</p>
                                                                    </div>
                                                                    <div class="timeline-footer d-flex align-items-center flex-wrap">
                                                                        <span class="ms-auto"><i class="fe fe-calendar text-muted me-1"></i>08/04/2022</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row mt-5">
                                    <div class="col-md-12">
                                        <div id='mycalendar'></div>
                                    </div>
                                </div> --}}



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


    //Full Calendar
    // document.addEventListener('DOMContentLoaded', function() {
    //     var calendarEl = document.getElementById('mycalendar');
    //     var calendar = new FullCalendar.Calendar(calendarEl, {
    //         timeZone: 'Asia/Bangkok',
    //         initialView: 'dayGridMonth',
    //         headerToolbar: {
    //             left: 'prev,next today',
    //             center: 'title',
    //             right: 'dayGridMonth,timeGridDay'
    //             },
    //         defaultView: 'month',
    //         navLinks: true, // can click day/week names to navigate views
    //         businessHours: true, // display business hours
    //         editable: true,
    //         selectable: true,
    //         selectMirror: true,
    //         droppable: true, // this allows things to be dropped onto the calendar
    //         dayMaxEvents: true, // allow "more" link when too many events
    //         select: function(arg) {
    //             var title = prompt('Event Title:');
    //             if (title) {
    //                 calendar.addEvent({
    //                     title: title,
    //                     start: arg.start,
    //                     end: arg.end,
    //                     allDay: arg.allDay
    //                 })
    //             }
    //             calendar.unselect()
    //         },
    //         eventClick: function(arg) {
    //             if (confirm('Are you sure you want to delete this event?')) {
    //                 arg.event.remove()
    //             }
    //         },
    //         events: [{
    //                 title: 'Business Lunch',
    //                 start: '2022-04-03T13:00:00',
    //                 constraint: 'businessHours'
    //             }, {
    //                 title: 'Meeting',
    //                 start: '2022-04-13T11:00:00',
    //                 constraint: 'availableForMeeting', // defined below
    //                 color: '#f35e90'
    //             }, {
    //                 title: 'Conference',
    //                 start: '2022-04-18',
    //                 end: '2021-07-20',
    //                 color: '#e67e22'
    //             },
    //             // areas where "Meeting" must be dropped
    //             {
    //                 id: 'availableForMeeting',
    //                 start: '2022-04-11T10:00:00',
    //                 end: '2021-03-11T16:00:00',
    //                 rendering: 'background',
    //                 color: '#5e72e4'
    //             }, {
    //                 id: 'availableForMeeting',
    //                 start: '2022-04-13T10:00:00',
    //                 end: '2021-03-13T16:00:00',
    //                 rendering: 'background'
    //             },
    //             // red areas where no events can be dropped
    //             {
    //                 start: '2022-04-24',
    //                 end: '2021-03-28',
    //                 overlap: false,
    //                 rendering: 'background',
    //                 color: 'rgba(0,0,0,0.1)'
    //             }, {
    //                 start: '2022-04-06',
    //                 end: '2021-03-11',
    //                 overlap: false,
    //                 rendering: 'background',
    //                 color: 'rgba(0,0,0,0.1)'
    //             }
    //         ]
    //     });
    //     calendar.render();
    // });

    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        width: '100%'
    });

    var dataTable = $('#datatable').DataTable({});
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    </script>
@endsection

