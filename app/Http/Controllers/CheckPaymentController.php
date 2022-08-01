<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class CheckPaymentController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        return view('checkpayment.index');
    }

    public function list(Request $request) {

        if ($request->ajax()) {
            $data = DB::table('orders_payment as op');
            $data = $data->join('orders as o', 'o.code', '=', 'op.order_code');
            $data = $data->join('employee as e', 'e.emp_code', '=', 'op.creator');
            $data = $data->join('customer as c', 'c.code', '=', 'o.cust_code');
            $data = $data->select('op.*', 'o.cust_code as customercode', 'c.fname as customerfname', 'c.lname as customerlname', 'e.emp_fname_th as employeefname', 'e.emp_lname_th as employeelname');
            if($request->status != '') {
                $data = $data->where('op.payment_status', $request->status);
            }
            if($request->searchorderno != '') {
                $data = $data->where('op.order_code', $request->searchorderno);
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('paymentscode', function($row){
                    $paymentscode = '<a href="javascript:void(0)" onclick="detail('."'".$row->code."'".')" title="" class="text-primary">'.$row->code.'</a>';
                    return $paymentscode;
                })
                ->addColumn('orderscode', function($row){
                    $orderscode = '<a href="javascript:void(0)" onclick="gotoOrderCode('."'".$row->order_code."'".')" title="" class="text-primary">'.$row->order_code.'</a>';
                    return $orderscode;
                })
                ->addColumn('customerfullname', function($row){
                    $customerfullname = $row->customerfname.' '.$row->customerlname;
                    return $customerfullname;
                })
                ->addColumn('empfullname', function($row){
                    $empfullname = $row->employeefname.' '.$row->employeelname;
                    return $empfullname;
                })
                ->addColumn('pricepaid', function($row){
                    $pricepaid = $row->price_paid;
                    return number_format($pricepaid, 2);
                })
                ->addColumn('paymentstatus', function($row){
                    $status = $row->payment_status;
                    if ($status == 0) { $res_status = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ยกเลิก</span>'; }
                    if ($status == 1) { $res_status = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รออนุมัติ</span>'; }
                    if ($status == 2) { $res_status = '<span class="badge bg-primary-transparent rounded-pill text-primary p-2 px-3">ไม่อนุมัติ/รอแก้ไข</span>'; }
                    if ($status == 3) { $res_status = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">อนุมัติแล้ว</span>'; }
                    return $res_status;
                })
                ->addColumn('paymentdate', function($row){
                    $paymentdate = $row->paymentdate;
                    return $paymentdate;
                })
                ->addColumn('action', function($row){
                    $action = '<a href="javascript:void(0)" onclick="detail('."'".$row->code."'".')" title="" class="text-primary">ตรวจสอบการชำระเงิน</a>';;;
                    return $action;
                })
                ->rawColumns(['paymentscode', 'orderscode', 'customerfullname', 'empfullname', 'pricepaid', 'paymentstatus', 'action'])
                ->make(true);
        }
    }

    public function view($paymentcode) {
        $res = DB::table('orders_payment as op')
            ->join('orders as o', 'o.code', '=', 'op.order_code')
            ->join('employee as e', 'e.emp_code', '=', 'op.creator')
            ->join('customer as c', 'c.code', '=', 'o.cust_code')
            ->join('payment_type as pt', 'pt.id', '=', 'op.paymenttype_id')
            ->select('op.*', 'o.cust_code as customercode', 'c.fname as customerfname', 'c.lname as customerlname', 'c.tel', 'c.addr', 'e.emp_fname_th as employeefname', 'e.emp_lname_th as employeelname', 'pt.name as paymenttypename', 'pt.evidence')
        ->where('op.code', $paymentcode)
        ->first();
        return view('checkpayment.view', compact('res'));
    }

}
