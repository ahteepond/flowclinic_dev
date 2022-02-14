@extends('layouts.template')
@section('title','จัดการข้อมูลพนักงาน') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">จัดการข้อมูลพนักงาน</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">จัดการข้อมูลพนักงาน</li>
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
                                <h3 class="card-title">รายชื่อพนักงาน</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12 text-end">
                                        <a href="{{ route('employee.new') }}" class="btn btn-sm btn-outline-default"><i class="fa fa-plus me-2"></i>New</a>
                                    </div>
                                    <div class="col-12"><hr></div>
                                </div>
                                <div class="table-responsive">
                                    <table id="emp_datatable" class="table table-bordered w-100 border-bottom">

                                    </table>
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

    <!-- DATA TABLE JS-->
    <script src="{{ asset('assets/plugins/datatable/datatables.min.js') }}"></script>

    <script>
    $( document ).ready(function() {
        // alert( "ready!" );
    });

    var dataTable = $('#emp_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: "GET",
                url: "{{ route('employee.list') }}",
                data: function( d ) {
                    d.active = 1;
                },
            },
            columns: [
                { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { title: "รหัสพนักงาน", data: 'empcode', name: 'empcode' },
                { title: "ชื่อ-นามสกุล", data: 'empfullname', name: 'empfullname' },
                { title: "สถานะใช้งาน", data: 'active', name: 'active' },
                { title: "Action", data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
        dataTable.columns.adjust().draw();


    function edit(empcode) {
        var url = "{{ route('employee.edit', '')}}"+"/"+empcode;
        window.open(url);
    }
    </script>
@endsection

