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
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('orderscode', function($row){
                    return '<a href="javascript:void(0)" onclick="detail('."'".$row->code."'".')" title="" class="text-primary">'.$row->code.'</a>';
                })
                ->addColumn('pricenettotal', function($row){
                    $pricenettotal = $row->price_nettotal;
                    return $pricenettotal;
                })
                ->addColumn('custname', function($row){
                    $sty = ' ';
                    return $row->fname.' '.$row->lname;
                })
                ->addColumn('statusorder', function($row){
                    $status_o = $row->status_order;
                    if ($status_o == 0) { $res_o = '<span class="badge bg-secondary-transparent rounded-pill text-secondary p-2 px-3">ยกเลิก</span>'; }
                    if ($status_o == 1) { $res_o = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอชำระเงิน</span>'; }
                    if ($status_o == 3) { $res_o = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">สำเร็จ</span>'; }
                    return $res_o;
                })
                ->addColumn('statusorderpayment', function($row){
                    $status_op = $row->status_orderpayment;
                    if ($status_op == 0) { $res_op = '<span class="badge bg-secondary-transparent rounded-pill text-secondary p-2 px-3">ยกเลิก</span>'; }
                    if ($status_op == 1) { $res_op = '<span class="badge bg-info-transparent rounded-pill text-info p-2 px-3">รอชำระเงิน</span>'; }
                    if ($status_op == 2) { $res_op = '<span class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">อยู่ระหว่างการชำระเงิน</span>'; }
                    if ($status_op == 3) { $res_op = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">สำเร็จ</span>'; }
                    return $res_op;
                })
                ->addColumn('created', function($row){
                    $created = $row->created_at;
                    return $created;
                })
                ->rawColumns(['orderscode', 'custname', 'statusorder', 'statusorderpayment'])
                ->make(true);
        }
    }

    public function detail($ordercode) {
        $res = DB::table('orders')
            ->join('customer', 'customer.code', '=', 'orders.cust_code')
            ->select(
                'customer.fname',
                'customer.lname',
                'customer.tel',
                'customer.addr',
                'orders.*'
             )
             ->where('orders.code', $ordercode)
            ->first();
        return view('orders.detail', compact('res'));
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
            if (Carbon::parse($rescode->orderdate)->format('Y-m-d') != Carbon::now()->format('Y-m-d')) {
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
            "status_orderpayment" => $arrorder['status_orderpayment'],
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

}
