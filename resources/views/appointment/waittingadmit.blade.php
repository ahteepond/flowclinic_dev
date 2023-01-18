@extends('appointment.list')
@section('title','รอรับการรักษา') {{-- Title --}}

@section('all_list')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            รายการการนัดหมาย
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <table id="datatable" class="table table-bordered w-100 border-bottom">

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('detail_waittingadmit')
<style>
    .select2-container { margin-bottom: 10px; }
</style>
<div class="row mt-6" id="space_emp">
    <div class="col-12"><p class="h4 fw-semibold">เลือกหมอและOR</p></div>
    <hr class="my-1">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">หมอ :</label>
            <select class="form-control select2-show-search form-select" id="empdoctor"></select>
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-label">OR :</label>
            <select class="form-control select2-show-search form-select mb-2" id="empor1"></select>
            <select class="form-control select2-show-search form-select" id="empor2"></select>
        </div>
    </div>
</div>
@endsection


@section('detail_button')
<button class="btn btn-primary my-2 ms-2" onclick="updateAPT(5, 'ยืนยันการบันทึกใบนัดให้ OR')" id="btn_apt_savedraf">บันทึก</button>
<button class="btn btn-primary my-2 ms-2" onclick="preUpdateAPT()" id="btn_apt_send">บันทึกและส่งใบนัดให้หมอ</button>
<button class="btn btn-warning my-2 ms-2" onclick="updateAPT(1, 'ยืนยันการส่งบันทึกใบนัดกลับไปให้ Sale')" id="btn_apt_recall">ส่งกลับ</button>
@endsection


@section('js_detail')
<script>
    $("#dtlapt_modal").on('show.bs.modal', function(){
        setTimeout(() => { 
            if ($('#tmp_status').val() == 6) {
                $('#btn_apt_send').hide();
                $('#btn_apt_recall').hide();
                $('#space_emp').hide();
                $('#space_note').hide();
            }
            if ($('#tmp_status').val() == 1) {
                $('#btn_apt_send').hide();
                $('#btn_apt_cancle').hide();
                $('#space_emp').hide();
                $('#space_note').hide();
            }
            if ($('#tmp_status').val() == 2) {
                $('#btn_apt_send').hide();
                $('#btn_apt_cancle').hide();
                $('#space_note').hide();
                $('#space_nextapt').hide();
                $('#space_opd').hide();
                $('#space_note').hide();
                $('#space_emp').hide();
            }
        }, 150)
        getEmpList();
        // $('#empdoctor').select2({
        //     dropdownParent: $("#dtlapt_modal"),
        //     minimumResultsForSearch: '',
        //     width: '100%'
        // });
        // $('#empor1').select2({
        //     dropdownParent: $("#dtlapt_modal"),
        //     minimumResultsForSearch: '',
        //     width: '100%'
        // });
        // $('#empor2').select2({
        //     dropdownParent: $("#dtlapt_modal"),
        //     minimumResultsForSearch: '',
        //     width: '100%'
        // });
    });


    function checkEmpSelected() {
        if ($('#empdoctor :selected').val() == "") {
            swal({
                title: "กรุณาเลือกหมอ",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) {
                 setTimeout(() => { $('#empdoctor :selected').focus(); }, 300)
            });
            return false;
        }
        
        if ($('#empor1 :selected').val() == "") {
            swal({
                title: "กรุณาเลือก OR",
                type: "error",
                confirmButtonText: "ตกลง",
            },
            function(isConfirm) {
                 setTimeout(() => { $('#empor1 :selected').focus(); }, 300)
            });
            return false;
        } else {
            if ($('#empor1 :selected').val() == $('#empor2 :selected').val()) {
                swal({
                    title: "OR ซ้ำ กรุณาตรวจสอบการเลือก OR",
                    type: "error",
                    confirmButtonText: "ตกลง",
                },
                function(isConfirm) {
                    setTimeout(() => { $('#empor2 :selected').focus(); }, 300)
                });
                return false;
            }
        }
    }

    function preUpdateAPT() {
        if (checkEmpSelected() != false) {
            updateAPT(6, 'ยืนยันการส่งใบนัดให้หมอ');
        }
    }

    function getEmpList() {
        $.ajax({
            url: '{{ route('appointment.waittingadmit.getemplist') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                prefix: 'D'
            },
            success: function (response) {
                if(response.status == "success") {
                    var html = '<option value="" selected disabled>กรุณาเลือกหมอ...</option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].emp_code+'" >'+response.data[i].emp_code+' - '+response.data[i].emp_fname_th+' '+response.data[i].emp_lname_th+'</option>';
                    }
                    $('#empdoctor').html(html);
                }
            },
            complete: function () {
            }
        });
        $.ajax({
            url: '{{ route('appointment.waittingadmit.getemplist') }}',
            method: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                prefix: 'O'
            },
            success: function (response) {
                if(response.status == "success") {
                    var html = '<option value="" selected disabled>กรุณาเลือก OR คนที่ 1...</option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html += '<option value="'+response.data[i].emp_code+'" >'+response.data[i].emp_code+' - '+response.data[i].emp_fname_th+' '+response.data[i].emp_lname_th+'</option>';
                    }
                    $('#empor1').html(html);
                    var html2 = '<option value="" selected disabled>กรุณาเลือก OR คนที่ 2...</option>';
                    html2 += '<option value="0">ไม่ระบุ</option>';
                    for (var i = 0; i < response.data.length; i++) {
                        html2 += '<option value="'+response.data[i].emp_code+'" >'+response.data[i].emp_code+' - '+response.data[i].emp_fname_th+' '+response.data[i].emp_lname_th+'</option>';
                    }
                    $('#empor2').html(html2);
                }
            },
            complete: function () {
            }
        });
    }
    

    
</script>
@endsection


