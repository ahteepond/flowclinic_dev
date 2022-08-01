<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AppointmentController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        return view('appointment.index');
    }

    public function new() {
        return view('appointment.new');
    }

    public function history() {
        return view('appointment.history');
    }

    public function searchorders(Request $request) {

        $customer = DB::table('customer')
        ->where($request->filtertype, $request->filtertext)
        ->get();

        if ($customer->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => false ]);
        } else {
            $res = DB::table('orders as o')
            ->join('orders_detail as od', 'o.code', '=', 'od.order_code')
            ->join('service as s', 'od.service_code', '=', 's.code')
            ->join('service_master as sm', 's.servicemaster_id', '=', 'sm.id')
            ->join('service_type as st', 'sm.servicetype_id', '=', 'st.id')
            ->select(
                'od.order_code', 'od.service_code', 'od.qty_service', 'od.price_total_service', 'o.orderdate',
                'st.name_th as servicetype_nameth',
                'sm.name_th as servicemaster_nameth',
                'sm.name_en as servicemaster_nameen',
                's.name_th as service_nameth',
                's.name_en as service_nameen',
                's.description'
            )
            ->where('o.cust_code', $customer[0]->code)
            ->get();
            return response()->json([ 'status' => 'success', 'result' => true, 'list' => $res, 'customer' => $customer[0] ]);
        }

    }

}
