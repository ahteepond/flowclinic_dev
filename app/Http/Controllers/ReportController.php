<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct() {
        $this->middleware('checksession');
    }



    //______ รายงานข้อมูลลูกค้า

    public function customer() {
        $customer_type = DB::table('customer_type')
        ->where('active', 1)
        ->get();
        return view('report.customer', compact('customer_type'));
    }

    public function customerSearch(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('customer');
            $data = $data->join('customer_type', 'customer_type.id', '=', 'customer.customertype_id');
            $data = $data->select(
                'customer.*',
                'customer_type.name as customertype_name'
            );
            $data = $data->where('customer.active', $request->active);
            if ($request->customertype != 'A') {
                $data = $data->where('customer.customertype_id', $request->customertype);
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('custcode', function($row){
                    return $row->code;
                })
                 ->addColumn('custtype', function($row){
                    return $row->customertype_name;
                })
                ->addColumn('custname', function($row){
                    return $row->fname.' '.$row->lname;
                })
                ->addColumn('custtel', function($row){
                    return $row->tel;
                })
                ->addColumn('custemail', function($row){
                    return $row->email;
                })
                ->addColumn('custaddr', function($row){
                    return $row->addr;
                })
                ->addColumn('custbdate', function($row){
                    return $row->bdate;
                })
                ->addColumn('custbidcard', function($row){
                    return $row->idcard;
                })
                ->addColumn('custbblood', function($row){
                    return $row->bloodtype;
                })
                ->addColumn('active', function($row){
                    $int_active = $row->active;
                    if ($int_active == 0) { $active = 'Inactive'; }
                    if ($int_active == 1) { $active = 'Active'; }
                    return $active;
                })
                ->rawColumns(['active'])
                ->make(true);
        }
    }


    
    //______ รายงานข้อมูลการรักษารายคน (OPD)

    public function individualopd() {
        return view('report.individualopd');
    }

    public function individualopdSearch(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('opd');
            $data = $data->join('appointment', 'appointment.code', '=', 'opd.appointment_code');
            $data = $data->join('customer', 'customer.code', '=', 'appointment.cust_code');
            $data = $data->join('employee', 'employee.emp_code', '=', 'opd.emp_session');
            $data = $data->select(
                'opd.*', 
                'appointment.service_name',
                'appointment.servicemaster_name',
                'appointment.servicetype_name',
                'appointment.round_at',
                'appointment.cust_code',
                'customer.fname',
                'customer.lname',
                'employee.emp_fname_th as doctor_fname',
                'employee.emp_lname_th as doctor_lname'
            );

            if ($request->custcode == '' && $request->ordercode == '' && $request->appointmentcode == '') {
                $data = $data->where('appointment.cust_code', '');
            } else {
                if ($request->custcode != '') {
                    $data = $data->where('appointment.cust_code', $request->custcode);
                }
                if ($request->ordercode != '') {
                    $data = $data->where('opd.order_code', $request->ordercode);
                } 
                if ($request->appointmentcode != '') {
                    $data = $data->where('opd.appointment_code', $request->appointmentcode);
                } 
            }

            $data = $data->orderBy('opd.created_at', 'ASC');
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('created', function($row){
                    return $row->created_at;
                })
                ->addColumn('orderscode', function($row){
                    return $row->order_code;
                })
                ->addColumn('aptcode', function($row){
                    return $row->appointment_code;
                })
                ->addColumn('custcode', function($row){
                    return $row->cust_code;
                })
                ->addColumn('custname', function($row){
                    return $row->fname. ' ' .$row->lname ;
                })
                ->addColumn('service_name', function($row){
                    return $row->service_name;
                })
                ->addColumn('servicemaster_name', function($row){
                    return $row->servicemaster_name;
                })
                ->addColumn('servicetype_name', function($row){
                    return $row->servicetype_name;
                })
                ->addColumn('round_at', function($row){
                    return $row->round_at;
                })
                ->addColumn('note', function($row){
                    return $row->note;
                })
                ->addColumn('doctor', function($row){
                    return $row->doctor_fname. ' ' .$row->doctor_lname ;
                })
                ->rawColumns(['doctor'])
                ->make(true);
        }
    }



    //______ รายงานสินค้าและบริการ

    public function productandservice() {
        $service_type = DB::table('service_type')
        ->where('active', 1)
        ->get();
        return view('report.productandservice', compact('service_type'));
    }

    public function productandserviceSearch(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('service as s');
            $data = $data->join('service_master as sm', 'sm.id', '=', 's.servicemaster_id');
            $data = $data->join('service_type as st', 'st.id', '=', 'sm.servicetype_id');
            $data = $data->select(
                's.code as service_code',
                's.name_th as service_nameth',
                's.name_en as service_nameen',
                's.description as service_description',
                'sm.name_th as servicemaster_nameth',
                'sm.name_en as servicemaster_nameen',
                'st.name_th as servicetype_nameth',
                's.active'
            );
            $data = $data->where('s.active', $request->active);
            if ($request->servicetype != 'A') {
                $data = $data->where('st.id', $request->servicetype);
            }
            $data = $data->orderBy('service_nameth', 'ASC');
            $data = $data->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('service_code', function($row){
                    return $row->service_code;
                })
                ->addColumn('service_name', function($row){
                    return $row->service_nameth.' ('.$row->service_nameen.')';
                })
                ->addColumn('service_description', function($row){
                    return $row->service_description;
                })
                ->addColumn('servicemaster_name', function($row){
                    return $row->servicemaster_nameth.' ('.$row->servicemaster_nameen.')';
                })
                ->addColumn('servicetype_name', function($row){
                    return $row->servicetype_nameth;
                })
                ->addColumn('active', function($row){
                    $int_active = $row->active;
                    if ($int_active == 0) { $active = 'Inactive'; }
                    if ($int_active == 1) { $active = 'Active'; }
                    return $active;
                })
                ->rawColumns(['service_code','servicetype_name'])
                ->make(true);
        }
    }



    //______ รายงานยอดขายรายวัน (ใบเสร็จ)

    public function dailysalesreceipt() {
        return view('report.dailysalesreceipt');
    }

    public function dailysalesreceiptSearch(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('orders_payment as op');
            $data = $data->join('payment_type as pt', 'pt.id', '=', 'op.paymenttype_id');
            $data = $data->select(
                'op.*',
                'pt.name as paymenttype_name'
            );
            if ($request->payment_status != 'A') {
                $data = $data->where('op.payment_status', $request->payment_status);
            }
            if ($request->payment_sdate != '') {
                $fulldatetime_s = $request->payment_sdate.' 00:00:00';
                $fulldatetime_e = $request->payment_edate.' 23:59:59';
                if ($request->payment_edate != '') {
                    $data = $data->whereBetween('op.paymentdate', [$fulldatetime_s, $fulldatetime_e]);
                } 
                if ($request->payment_edate == '') {
                    $data = $data->whereBetween('op.paymentdate', [$request->payment_sdate.' 00:00:00', $request->payment_sdate.' 23:59:59']);
                }
            }
            $data = $data->orderBy('op.paymentdate', 'DESC');
            $data = $data->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('payment_code', function($row){
                    $paymentscode = '<a href="javascript:void(0)" onclick="detail('."'".$row->code."'".')" title="" class="text-primary">'.$row->code.'</a>';
                    return $paymentscode;
                })
                ->addColumn('order_code', function($row){
                    $orderscode = '<a href="javascript:void(0)" onclick="gotoOrderCode('."'".$row->order_code."'".')" title="" class="text-primary">'.$row->order_code.'</a>';
                    return $orderscode;
                })
                ->addColumn('paymenttype_name', function($row){
                    return $row->paymenttype_name;
                })
                ->addColumn('evidence_file', function($row){
                    return ($row->evidence_file == '' ? 'N/A' : 'มี');
                })
                ->addColumn('remark', function($row){
                    return $row->remark;
                })
                ->addColumn('price_paid', function($row){
                    return number_format($row->price_paid, 2);
                })
                ->addColumn('payment_date', function($row){
                    return $row->paymentdate;
                })
                ->addColumn('payment_status', function($row){
                    switch ($row->payment_status) {
                        case '0': $status_name = 'ยกเลิก'; break;
                        case '1': $status_name = 'รออนุมัติ'; break;
                        case '2': $status_name = 'ไม่อนุมัติ/รอแก้ไข'; break;
                        case '3': $status_name = 'อนุมัติแล้ว'; break;
                    }
                    return $status_name;
                })
                ->rawColumns(['payment_code','order_code','evidence_file'])
                ->make(true);
        }
    }

    

    //______ รายงานยอดขายรายวัน (สินค้าและบริการ)

    public function dailysalesproductandservice() {
        return view('report.dailysalesproductandservice');
    }

    public function dailysalesproductandserviceSearch(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('orders as o');
            $data = $data->join('appointment as a', 'o.code', '=', 'a.order_code');
            $data = $data->join('customer as c', 'o.cust_code', '=', 'c.code');
            $data = $data->select(
                'o.*',
                'c.fname as cust_fname',
                'c.lname as cust_lname',
                'a.status as apt_status'
            );
            // Where เข้ารับการรักษาแล้ว
            $data->where('a.status', 7);
            if ($request->paid_status != 'A') {
                $data = $data->where('o.status_order', $request->paid_status);
            }
            if ($request->paid_sdate != '') {
                $fulldatetime_s = $request->paid_sdate.' 00:00:00';
                $fulldatetime_e = $request->paid_edate.' 23:59:59';
                if ($request->paid_edate != '') {
                    $data = $data->whereBetween('o.updated_at', [$fulldatetime_s, $fulldatetime_e]);
                } 
                if ($request->paid_edate == '') {
                    $data = $data->whereBetween('o.updated_at', [$request->paid_sdate.' 00:00:00', $request->paid_sdate.' 23:59:59']);
                }
            }
            $data = $data->orderBy('o.orderdate', 'DESC');
            $data = $data->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('order_code', function($row){
                    $orderscode = '<a href="javascript:void(0)" onclick="gotoOrderCode('."'".$row->code."'".')" title="" class="text-primary">'.$row->code.'</a>';
                    return $orderscode;
                })
                ->addColumn('status_order', function($row){
                    switch ($row->status_order) {
                        case '0': $status_name = 'ยกเลิก'; break;
                        case '1': $status_name = 'รอชำระเงิน'; break;
                        case '2': $status_name = 'อยู่ระหว่างการชำระเงิน'; break;
                        case '3': $status_name = 'ชำระเงินครบแล้ว'; break;
                    }
                    return $status_name;
                })
                ->addColumn('cust_name', function($row){
                    return $row->cust_fname.' '.$row->cust_lname;
                })
                ->addColumn('price_nettotal', function($row){
                    return number_format($row->price_nettotal, 2);
                })
                ->addColumn('paiddate', function($row){
                    return $row->updated_at;
                })
                ->rawColumns(['order_code','status_order'])
                ->make(true);
        }
    }

}
