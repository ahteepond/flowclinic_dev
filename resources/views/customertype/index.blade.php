@extends('layouts.template')
@section('title','ประเภทลูกค้า') {{-- Title --}}


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
                                    <h3 class="card-title">รายการประเภทลูกค้า</h3>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{ route('customertype.new') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus me-2"></i>New</a>
                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatableinfo" class="table table-bordered w-100 border-bottom">
                                        
                                        <thead>
                                            <tr>
                                                <th>NO.</th>
                                                <th>ประเภทลูกค้า</th>
                                                <th>สถานะใช้งาน</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>ลูกค้าใหม่</td>
                                                <td><span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Active</span></td>
                                                <td>
                                                    <a href="{{ route('customertype.edit') }}" title="แก้ไข" class="btn text-primary btn-sm"><span class="fe fe-edit"></span></a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>ลูกค้าเก่า</td>
                                                <td><span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Active</span></td>
                                                <td>
                                                    <a href="{{ route('customertype.edit') }}" title="แก้ไข" class="btn text-primary btn-sm"><span class="fe fe-edit"></span></a>
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
        $('#datatableinfo').DataTable();
    });

    function searchTable() {
        // dataTable.ajax.reload();
    }

    // function edit(id) {
    //     var url = "{{ route('customertype.edit', '')}}"+"/"+id;
    // }

    </script>
@endsection

