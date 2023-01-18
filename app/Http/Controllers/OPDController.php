<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class OPDController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }
    
    public function index() {
        return view('opd.index');
    }

    public function process() {
        return view('opd.process');
    }

    public function history() {
        return view('opd.history');
    }

    public function detail() {
        return view('opd.detail');
    }

    public function searchorders(Request $request) {
        $customer = DB::table('customer')
        ->where($request->filtertype, $request->filtertext)
        ->get();

        if ($customer->isEmpty()) {
            return response()->json([ 'status' => 'failed', 'result' => false ]);
        } else {
            return response()->json([ 'status' => 'success', 'result' => true, 'customer' => $customer[0] ]);
        }
    }


    public function orderlist(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('appointment')
            ->where('cust_code', $request->customercode)
            ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('orderscode', function($row){
                    return $row->order_code;
                })
                ->addColumn('aptcode', function($row){
                    return $row->code;
                })
                ->addColumn('servicemaster_name', function($row){
                    return $row->servicemaster_name;
                })
                ->addColumn('service_name', function($row){
                    return $row->service_name;
                })
                ->addColumn('selectservice', function($row){
                    return '<a class="btn btn-sm btn-primary" data-bs-effect="effect-scale" onclick="serviceList('."'".$row->code."'".')">OPD</a>';
                })
                ->rawColumns(['aptcode','selectservice'])
                ->make(true);
        }
    }
}
