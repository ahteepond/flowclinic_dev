<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class OrdersController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        return view('orders.index');
    }

    public function new() {
        return view('orders.new');
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('orders');
            $data = $data->join('customer', 'customer.code', '=', 'orders.cust_code');
            $data = $data->select(
                'customer.fname',
                'customer.lname',
                'orders.*'
            );
            if($request->f_orderno != '') { $data = $data->where('code', $request->f_orderno); }

            if($request->f_orderdate != '') { $data = $data->where('orderdate', $request->f_orderdate); }
            if($request->f_statusorders != '') { $data = $data->where('status_order', $request->f_statusorders); }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('orderscode', function($row){
                    return '<a href="javascript:void(0)" onclick="detail('."'".$row->code."'".')" title="" class="text-primary">'.$row->code.'</a>';
                })
                ->addColumn('pricenettotal', function($row){
                    $pricenettotal = $row->price_nettotal;
                    return number_format($pricenettotal, 2);
                })
                ->addColumn('custname', function($row){
                    $sty = ' ';
                    return $row->fname.' '.$row->lname;
                })
                ->addColumn('statusorder', function($row){
                    $status_o = $row->status_order;
                    if ($status_o == 0) { $res_o = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">ยกเลิก</span>'; }
                    if ($status_o == 1) { $res_o = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอชำระเงิน</span>'; }
                    if ($status_o == 2) { $res_o = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">อยู่ระหว่างการชำระเงิน</span>'; }
                    if ($status_o == 3) { $res_o = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">สำเร็จ</span>'; }
                    return $res_o;
                })
                ->addColumn('created', function($row){
                    $created = $row->created_at;
                    return $created;
                })
                ->rawColumns(['orderscode', 'custname', 'statusorder'])
                ->make(true);
        }
    }

    public function detail($ordercode) {
        $res = DB::table('orders as o')
            ->join('customer as c', 'c.code', '=', 'o.cust_code')
            ->select(DB::raw('o.*, c.fname, c.lname, c.tel, c.addr, (SELECT CONCAT(emp_fname_th, " ", emp_lname_th) FROM employee e WHERE e.emp_code=o.sale_1) AS n_sale_1, (SELECT CONCAT(emp_fname_th, " ", emp_lname_th) FROM employee e WHERE e.emp_code=o.sale_2) AS n_sale_2'))
            ->where('o.code', $ordercode)
            ->first();

        $list = DB::table('orders_detail as od')
        ->join('service as s', 's.code', '=', 'od.service_code')
        ->join('service_master as sm', 'sm.id', '=', 's.servicemaster_id')
        ->select(
            's.name_th as service_name_th',
            's.name_en as service_name_en',
            'sm.name_th as servicemaster_name_th',
            'sm.name_en as servicemaster_name_en',
            'od.*'
        )
        ->where('od.order_code', $ordercode)
        ->get();

        $paymenttype = DB::table('payment_type')
        ->where('active', 1)
        ->get();

        return view('orders.detail', compact('res', 'list', 'paymenttype', 'ordercode'));
    }

    public function selectcustomer(Request $request) {
        $res = DB::table('customer')
        ->where('code', $request->customercode)
        ->get();
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function searchcustomer(Request $request) {
        $res = DB::table('customer')
        ->join('customer_type', 'customer_type.id', '=', 'customer.customertype_id')
        ->select(
            'customer_type.name',
            'customer.*'
        )
        ->where($request->filtertype, $request->filtertext)
        ->get();
        if (!$res->isEmpty()) {
            return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
        } else {
            return response()->json([ 'status' => 'failed', 'result' => false, 'param' => $res ]);
        }
    }

    public function getdiscountlist(Request $request) {
        $res = DB::table('discount_type')
        ->where('active', 1)
        ->get();
        return response()->json([ 'status' => 'success', 'result' => true, 'data' => $res ]);
    }

    public function getempsale(Request $request) {
        $res = DB::table('employee')
        ->join('employee_position', 'employee.emp_posi_id', '=', 'employee_position.emp_posi_id')
        ->select(
            'employee_position.emp_posi_name',
            'employee.*'
        )
        ->where('employee.emp_posi_id', 1) //Sale = 1
        ->where('employee.active', 1)
        ->get();
        return response()->json([ 'status' => 'success', 'result' => true, 'data' => $res ]);
    }

    public function insert(Request $request) {

        $arrorder = $request->arr_order[0];
        $arrorderdetail = $request->arr_orderdetail;

        //Check Running Order No
        $rescode = DB::table('orders')
            ->orderBy('code', 'DESC')
            ->first();
        $prefix = "ODR".Carbon::now()->format('ym')."-";
        if ($rescode) {
            if (Carbon::parse($rescode->orderdate)->format('Y-m') != Carbon::now()->format('Y-m')) {
                $gencode = $prefix . "00001";
            } else {
                $code_current = explode('-',$rescode->code)[1];
                $code_new = sprintf("%05d", (int)$code_current + 1);
                $gencode = $prefix . $code_new;
            }
        } else {
            $gencode = $prefix . "00001";
        }

        $arr_order = array(
            "code" => $gencode,
            "status_order" => $arrorder['status_order'],
            "cust_code" => $arrorder['cust_code'],
            "price_paid" => $arrorder['price_paid'],
            "price_balance" => $arrorder['price_balance'],
            "price_discount" => $arrorder['price_discount'],
            "discounttype_id" => $arrorder['discounttype_id'],
            "price_total" =>$arrorder['price_total'],
            "price_nettotal" => $arrorder['price_nettotal'],
            "remark" => $arrorder['remark'],
            "sale_1" => $arrorder['sale_1'],
            "sale_2" => $arrorder['sale_2'],
            "orderdate" => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res_order = DB::table('orders')
        ->insertOrIgnore($arr_order);

        if ($res_order) {
            for ($i=0; $i < count($arrorderdetail); $i++) {
                $res_orderdetail = array(
                    "order_code" => $gencode,
                    "service_code" => $arrorderdetail[$i]['servicecode'],
                    "price_service" => $arrorderdetail[$i]['price_promo'],
                    "qty_service" => $arrorderdetail[$i]['qty'],
                    "price_total_service" => $arrorderdetail[$i]['totalprice'],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                );
                $res_order = DB::table('orders_detail')
                ->insertOrIgnore($res_orderdetail);
            }
        }
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res_order, 'ordercode' => $gencode ]);
    }

    public function getevidence(Request $request) {
        $res = DB::table('payment_type')
            ->where('id', $request->id)
            ->first();
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res->evidence ]);
    }

    public function checkvoidpayment(Request $request) {
        $totalpayment = DB::table('orders_payment')
        ->where('order_code', $request->ordercode)
        ->get();
        $totalpaymentCount = $totalpayment->count();

        $totalvoid = DB::table('orders_payment')
        ->where('order_code', $request->ordercode)
        ->where('payment_status', '0')
        ->get();
        $totalvoidCount = $totalvoid->count();

        if ($totalpaymentCount != $totalvoidCount) {
            $param = false;
        } else {
            $param = true;
        }

        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $param ]);
    }


    public function void(Request $request) {
        $arr_data = array(
            "status_order" => 0,
            "void_reason" => $request->voidreason,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('orders')
            ->where('code', $request->ordercode)
            ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true ]);
    }

}
