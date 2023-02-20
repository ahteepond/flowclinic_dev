@extends('layouts.template')
@section('title','บันทึกประวัติ OPD') {{-- Title --}}


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
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-search me-2"></i>ค้นหา OPD
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-auto">
                                        <label class="form-label">ค้นหาด้วย</label>
                                        <select name="filter_type" id="filter_type" class="form-control form-select">
                                            <option value="code" selected>รหัสลูกค้า</option>
                                            <option value="idcard">เลขบัตรประชาชน</option>
                                            <option value="tel">เบอร์โทรศัพท์</option>
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <div class="form-group">
                                            <label class="form-label">คำที่ค้นหา</label>
                                            <input type="text" class="form-control" id="filter_text">
                                        </div>
                                    </div>
                                    <div class="col-auto mt-auto">
                                        <button type="button"onclick="searchOrderByCustomer()" id="searcholdcust" class="btn btn-outline-primary mb-4 ms-2"><i class="fa fa-search me-2"></i>ค้นหา</button>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12 col-md-12">
                        <div class="card" id="orderspace_ls" style="display: none;">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-file-text me-2"></i>รายการคำสั่งซื้อ
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12"><p class="h3">ข้อมูลลูกค้า:</p></div>
                                    <div class="col-lg-6">
                                        <p class="fs-18 fw-semibold mb-0"><a href="#" id="customercode"></a> <span id="fullname"></span></p>
                                        <address>
                                            <b><span id="tel"></span></b><br>
                                            <span id="addr"></span>
                                        </address>
                                    </div>
                                    <div class="col-lg-6 text-end">
                                        <p class="mb-1">เลขบัตรประชาชน : <span id="idcard"></span> </p>
                                        <p class="mb-1">วันเกิด : <span id="bdate"></span></p>
                                        <p class="mb-1">อายุ : <span id="age"></span> ปี</p>
                                        <p class="mb-1">กรุ๊ปเลือด : <span id="bloodtype"></span></p>
                                        <div class="my-3" id="v_btn"></div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-5">
                                    <table id="datatable_opd" class="table table-bordered w-100 table-hover border-bottom">

                                    </table>
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



@section('other')

@endsection




@section('script')

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
    });

    function searchOrderByCustomer() {
        $('#orderspace_ls').fadeOut();
        var filtertype = $('#filter_type :selected').val();
        var filtertext = $('#filter_text').val();
        if (filtertext == "") {
            swal({
                title: "กรุณากรอกคำค้นหา",
                text: "",
                type: "warning",
                confirmButtonText: "OK",
                closeOnConfirm: true,
            },
            function(isConfirm) {
                if (isConfirm) {
                    $('#orderspace_ls').fadeOut();
                }
            });
            return false;
        }
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
                    var spc_btn = '<button type="button" class="btn btn-success" onclick="viewmoreOPD(`'+response.customer.code+'`)"><i class="zmdi zmdi-open-in-new me-2"></i>ดูรายละเอียด OPD ทั้งหมด</button>';
                    $('#v_btn').html(spc_btn);
                    //Set OPD List
                    OPDList(response.customer.code);
                    //Show
                    $('#orderspace_ls').fadeIn();
                }
                if(response.status == "failed") {
                    swal({
                        title: "ไม่พบข้อมูล",
                        text: "",
                        type: "error",
                        confirmButtonText: "OK",
                        closeOnConfirm: true,
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $('#orderspace_ls').fadeOut();
                        }
                    });
                    return false;
                }
            },
            complete: function () {
            }
        });

    }

    function viewmoreOPD(custcode) {
        var url = "{{ route('opd.detail', '')}}"+"/"+custcode;
        window.open(url,'_blank');
    }

    function getAge(dateString) {
        var date = dateString;
        var fullage = moment(dateString, "YYYY-MM-DD").fromNow(true);
        var age = fullage.split(" ", 1);
        return age;
    }

    function OPDList(customercode) {
        var dataTable = $('#datatable_opd').DataTable({
            "bDestroy": true,
            processing: true,
            serverSide: true,
            ajax: {
                type: "GET",
                url: "{{ route('opd.list') }}",
                data: function( d ) {
                    d.customercode = customercode
                },
            },
            columns: [
                { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { title: "วันที่บันทึก OPD", data: 'created', name: 'created' },
                { title: "เลขที่ใบสั่งซื้อ", data: 'orderscode', name: 'orderscode' },
                { title: "เลขที่ใบนัด", data: 'aptcode', name: 'aptcode' },
                { title: "บริการ", data: 'service_name', name: 'service_name' },
                { title: "บริการหลัก", data: 'servicemaster_name', name: 'servicemaster_name' },
                { title: "ประเภทบริการ", data: 'servicetype_name', name: 'servicetype_name' },
                { title: "รักษาครั้งที่", data: 'round_at', name: 'round_at' },
                { title: "บันทึก OPD", data: 'note', name: 'note' },
                // { title: "ผู้บันทึก OPD", data: 'doctor', name: 'doctor' },
            ],
            'columnDefs': [
                // { "className": "text-center", "targets": [0,1,2,3] },
            ]
        });
        dataTable.columns.adjust().draw();
    }


    </script>
@endsection

