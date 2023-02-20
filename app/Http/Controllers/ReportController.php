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



    public function productandservice() {
        return view('report.productandservice');
    }

    public function dailysalesreceipt() {
        return view('report.dailysalesreceipt');
    }

    public function dailysalesproductandservice() {
        return view('report.dailysalesproductandservice');
    }

}
