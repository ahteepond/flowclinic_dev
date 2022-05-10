@extends('layouts.template')
@section('title','ประเภทส่วนลด') {{-- Title --}}


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
                                <h3 class="card-title"><i class="fa fa-filter" aria-hidden="true"></i> ตัวกรอง</h3>
                            </div>
                            <div class="card-body py-2">
                                <div class="row">
                                    <div class="col-12 text-start">
                                        <div class="row align-items-end">
                                            <div class="form-group col-auto">
                                                <label class="form-label">สถานะ</label>
                                                <select name="status" id="status" class="form-control form-select" data-bs-placeholder="Select Status">
                                                    <option value="1" selected>Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button"onclick="searchTable()" class="btn btn-outline-primary mb-4 btn-block"><i class="fa fa-search me-2"></i>ค้นหา</button>
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
        <!-- ROW END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                <div class="row">

                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-8 text-start">
                                    <h3 class="card-title">รายการประเภทส่วนลด</h3>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{ route('discounttype.new') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>New</a>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatableinfo" class="table table-bordered w-100 border-bottom">

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
        $('#datatableinfo').DataTable();
    });

    var dataTable = $('#datatableinfo').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            type: "GET",
            url: "{{ route('discounttype.list') }}",
            data: function( d ) {
                d.active = $('#status :selected').val()
            },
        },
        columns: [
            { title: "No.", data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { title: "วิธีการชำระเงิน", data: 'discounttypename', name: 'discounttypename' },
            { title: "สถานะใช้งาน", data: 'active', name: 'active' },
            { title: "Action", data: 'action', name: 'action', orderable: false, searchable: false },
        ],
        'columnDefs': [
            { "className": "text-center", "targets": [0,2,3] },
        ]
    });
    dataTable.columns.adjust().draw();

    function searchTable() {
        dataTable.ajax.reload();
    }

    function edit(id) {
        var url = "{{ route('discounttype.edit', '')}}"+"/"+id;
        location.href = url;
    }

    </script>
@endsection

