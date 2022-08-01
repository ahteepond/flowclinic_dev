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
                                    <table id="datatable" class="table table-bordered w-100 table-hover border-bottom">
                                        <thead>
                                            <tr class=" ">
                                                <th>No.</th>
                                                <th class="text-center">เลขที่ใบสั่งซื้อ</th>
                                                <th class="text-center">วันที่สั่งซื้อ</th>
                                                <th class="text-center">ออกใบนัด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td><p class="font-w600 mb-1">ODR2206-00001</p></td>
                                                <td class="text-start">2022-06-25 04:19:32</td>
                                                <td class="text-center">
                                                    <a id="" href="#" class="btn btn-sm btn-primary">
                                                        เลือกบริการ
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">2</td>
                                                <td><p class="font-w600 mb-1">ODR2206-00002</p></td>
                                                <td class="text-start">2022-06-25 04:19:32</td>
                                                <td class="text-center">
                                                    <a id="" href="#" class="btn btn-sm btn-primary">
                                                        เลือกบริการ
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
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


@section('script')

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <script>
    $( document ).ready(function() {

    });

    var dataTable = $('#datatable').DataTable({});
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    function searchOrderByCustomer() {
        var filtertype = $('#filter_type :selected').val();
        var filtertext = $('#filter_text').val();
        if (filtertext == "") {
            swal({
                title: "กรุณากรอกคำค้นหา",
                text: "",
                type: "warning",
                confirmButtonText: "OK",
                closeOnConfirm: true,
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
                    //Log
                    console.log(response.customer);
                    console.log(response.list);
                    //Set Customer Info
                    $('#customercode').html(response.customer.code);
                    $('#fullname').html(response.customer.fname + ' ' + response.customer.lname);
                    $('#tel').html(response.customer.tel);
                    $('#addr').html(response.customer.addr);
                    $('#idcard').html(response.customer.idcard);
                    $('#bdate').html(response.customer.bdate);
                    $('#age').html(getAge(response.customer.bdate));
                    $('#bloodtype').html(response.customer.bloodtype);

                    $('#orderspace_ls').fadeIn();
                    // setTimeout(() => {
                    //     $('#o_custcode').html(response.param[0].code);
                    //     $('#o_fname').html(response.param[0].fname);
                    //     $('#o_lname').html(response.param[0].lname);
                    //     $('#o_birthdate').html(response.param[0].bdate);
                    //     $('#o_idcard').html(response.param[0].idcard);
                    //     $('#o_bloodtype').html(response.param[0].bloodtype);
                    //     $('#o_email').html(response.param[0].email);
                    //     $('#o_tel').html(response.param[0].tel);
                    //     $('#o_addr').html(response.param[0].addr);
                    //     $('#o_custtype').html(response.param[0].name);

                    //     $('#rescustinfo').fadeIn();
                    //     $('#btnselectcust').removeClass('disabled');
                    // }, 400)
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
                            // $('#rescustinfo').fadeOut();
                            // $('#btnselectcust').addClass('disabled');
                            // setTimeout(() => {
                            //     $('#filter_text').focus();
                            //     $('#filter_text').select();
                            // }, 400)
                        }
                    });
                }
            },
            complete: function () {
            }
        });

    }


    function getAge(dateString) {
        var ageInMilliseconds = new Date() - new Date(dateString);
        return Math.floor(ageInMilliseconds/1000/60/60/24/365); // convert to years
    }

    </script>
@endsection

