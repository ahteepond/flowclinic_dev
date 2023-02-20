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
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <i class="fa fa-search me-2"></i>ค้นหาบริการของลูกค้า
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
                                    </div>
                                </div>
                                <div class="table-responsive mt-5">
                                    <table id="datatable_order" class="table table-bordered w-100 table-hover border-bottom">

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
<div class="modal fade" id="modal_servicelist">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
                <div class="row">
                    <div class="col-md-6">
                        <p class="fs-18 fw-semibold mb-0" id="ordercode_hmodal">

                        </p>
                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive mt-5">
                            <table id="datatable_service" class="table table-bordered w-100 table-hover border-bottom">

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
@endsection




@section('script')

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <script>
    $( document ).ready(function() {

        $("#modal_servicelist").on('hidden.bs.modal', function(){
            $('#ordercode_hmodal').html('');
        });
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
            url: '{{ route('appointment.searchorders') }}',
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
                    //Set Orders List
                    ordersList(response.customer.code);
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

    function getAge(dateString) {
        var date = dateString;
        var fullage = moment(dateString, "YYYY-MM-DD").fromNow(true);
        var age = fullage.split(" ", 1);
        return age;
    }


    function ordersList(customercode) {
        var dataTable = $('#datatable_order').DataTable({
            "bDestroy": true,
            processing: true,
            serverSide: true,
            ajax: {
                type: "GET",
                url: "{{ route('appointment.orderlist') }}",
                data: function( d ) {
                    d.customercode = customercode
                },
            },
            columns: [
                { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { title: "เลขที่ใบสั่งซื้อ", data: 'orderscode', name: 'orderscode' },
                { title: "วันที่สั่งซื้อ", data: 'ordersdate', name: 'ordersdate' },
                { title: "ออกใบนัด", data: 'selectservice', name: 'selectservice' },
            ],
            'columnDefs': [
                { "className": "text-center", "targets": [0,1,2,3] },
            ]
        });
        dataTable.columns.adjust().draw();
    }


    function serviceList(ordercode) {
        $('#ordercode_hmodal').html('<h3 class="text-primary mt-5">'+ordercode+'</h3>');
        var dataTable = $('#datatable_service').DataTable({
            "bDestroy": true,
            processing: true,
            serverSide: true,
            ajax: {
                type: "GET",
                url: "{{ route('appointment.servicelist') }}",
                data: function( d ) {
                    d.ordercode = ordercode
                },
            },
            columns: [
                { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { title: "เลขที่บริการ", data: 'servicecode', name: 'servicecode' },
                { title: "บริการ", data: 'service', name: 'service' },
                { title: "บริการย่อย", data: 'servicemaster', name: 'servicemaster' },
                { title: "ประเภทบริการ", data: 'servicetype', name: 'servicetype' },
                { title: "จำนวน", data: 'qty', name: 'qty' },
                { title: "ออกใบนัด", data: 'selectservice', name: 'selectservice' },
            ],
            'columnDefs': [
                { "className": "text-center", "targets": [0,5,6] },
            ]
        });
        dataTable.columns.adjust().draw();
    }

    function takeAppointment(ordercode, servicecode, id) {
        // console.log(ordercode);
        // console.log(servicecode);
        // console.log(id);
        var url = "{{ route('appointment.new', '')}}"+"/"+id;
        location.href = url;
    }

    </script>
@endsection

