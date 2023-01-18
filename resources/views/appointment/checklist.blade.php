@extends('appointment.list')
@section('title','ตรวจสอบการนัดหมาย') {{-- Title --}}

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


@section('detail_button')
<button class="btn btn-primary my-2 ms-2" onclick="updateAPT(3, 'ยืนยันการส่งใบนัดให้ OR')" id="btn_apt_send">ส่งใบนัดให้ OR</button>
@endsection


@section('js_detail')
<script>
    $("#dtlapt_modal").on('show.bs.modal', function(){
        setTimeout(() => { 
            if ($('#tmp_status').val() == 3) {
                $('#btn_apt_send').hide();
                $('#btn_apt_cancle').hide();
                $('#space_note').hide();
            }
            if ($('#tmp_status').val() == 5) {
                $('#btn_apt_send').hide();
                $('#btn_apt_cancle').hide();
                $('#space_note').hide();
            }
            if ($('#tmp_status').val() == 6) {
                $('#btn_apt_send').hide();
                $('#btn_apt_recall').hide();
                $('#space_emp').hide();
                $('#space_note').hide();
            }
        }, 150)
    });
</script>
@endsection




