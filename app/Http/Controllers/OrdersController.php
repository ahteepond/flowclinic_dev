<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class OrdersController extends Controller
{
    public function index() {
        return view('orders.index');
    }

    public function new() {
        return view('orders.new');
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('orders');
            $data = $data->join('customer', 'customer.id', '=', 'orders.cust_id');
            $data = $data->select(
                'customer.fname',
                'customer.lname',
                'orders.*'
            );
            // $data = $data->where('active', $request->active);
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('orderscode', function($row){
                    return '<a href="javascript:void(0)" onclick="detail('.$row->id.')" title="" class="text-primary">'.$row->code.'</a>';
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

    public function detail($id) {
        $res = DB::table('orders')
            ->join('customer', 'customer.id', '=', 'orders.cust_id')
            ->select(
                'customer.fname',
                'customer.lname',
                'customer.tel',
                'customer.addr',
                'orders.*'
             )
            ->first();
        return view('orders.detail', compact('res'));
    }

}
