@extends('layouts.template')
@section('title','แก้ไขประเภทบริการ') {{-- Title --}}


@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">

        <!-- PAGE-HEADER -->
        <div class="page-header">
            <h1 class="page-title">@yield('title')</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('employee') }}">ประเภทบริการ</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
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
                                <h3 class="card-title"><i class="fa fa-pencil me-2"></i>Edit</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">ประเภทบริการ <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" placeholder="กรุณากรอกชื่อประเภทบริการ" id="name" value="{{ $res->name_th }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6"></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="form-label">สถานะ <span class="text-red">*</span></label>
                                            <select class="form-select" id="active">
                                                <option value="1" {{ $res->active === 1 ? "Selected" : "" }}>Active</option>
                                                <option value="0" {{ $res->active === 0 ? "Selected" : "" }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-9"></div>

                                    <div class="col-12 text-end">
                                        <hr>
                                        <a href="{{ route('servicetype') }}" class="btn btn-outline-primary me-2">Back</a>
                                        <a href="javascript:void(0)" onclick="update({{ $res->id }})" class="btn btn-primary">Save</a>
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
        $('#active').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });
    });

    function update(id) {
        if (validateInput() != false) {
            $.ajax({
                url: '{{ route('servicetype.update') }}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    name: $('#name').val(),
                    active: $('#active :selected').val(),
                },
                success: function (response) {
                    if(response.status == "success") {
                        swal({
                            title: "Updated!",
                            text: "Your infomation has been succesfully update.",
                            type: "success",
                            confirmButtonText: "OK",
                            confirmButtonClass: "btn-success",
                            closeOnConfirm: false,
                            },
                            function(isConfirm) {
                            if (isConfirm) {
                                location.href = '{{ route('servicetype') }}';
                            }
                        });
                    }
                },
                complete: function () {
                }
            });
        }
        
    }

    function validateInput() {
        if ($('#name').val() == '') {
            swal("กรุณากรอกชื่อประเภทบริการ");
            return false;
        }
    }

    </script>
@endsection

