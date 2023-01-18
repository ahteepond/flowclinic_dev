<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ServiceMasterController extends Controller
{
    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        $service_type = DB::table('service_type')
        ->where('active', 1)
        ->get();
        return view('servicemaster.index', compact('service_type'));
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('service_master');
            $data = $data->join('service_type', 'service_type.id', '=', 'service_master.servicetype_id');
            $data = $data->select(
                'service_type.name_th as servicetype_nameth',
                'service_master.*');
            $data = $data->where('service_master.active', $request->active);
            if ($request->servicetype != 'A') {
                $data = $data->where('service_type.id', $request->servicetype);
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('servicetype', function($row){
                    $servicetype = $row->servicetype_nameth;
                    return $servicetype;
                })
                 ->addColumn('servicemaster_th', function($row){
                    $servicemaster = $row->name_th;
                    return $servicemaster;
                })
                ->addColumn('servicemaster_en', function($row){
                    $servicemaster = $row->name_en;
                    return $servicemaster;
                })
                ->addColumn('active', function($row){
                    $int_active = $row->active;
                    if ($int_active == 0) { $active = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Inactive</span>'; }
                    if ($int_active == 1) { $active = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Active</span>'; }
                    return $active;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" title="แก้ไข" onclick="edit('.$row->id.')" class="btn text-primary btn-sm"><span class="fe fe-edit"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
    }

    public function new() {
        return view('servicemaster.new');
    }

    public function insert(Request $request) {
        $arr_data = array(
            "servicetype_id" => $request->servicetypeid,
            "name_th" => $request->servicemaster_nameth,
            "name_en" => $request->servicemaster_nameen,
            "active" => $request->active,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('service_master')
        ->insertOrIgnore($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function edit($id) {
        $res = DB::table('service_master')
            ->join('service_type', 'service_type.id', '=', 'service_master.servicetype_id')
            ->select('service_type.name_th as servicetype_nameth','service_master.*')
            ->where('service_master.id', $id)
            ->first();
        return view('servicemaster.edit', compact('res') );
    }

    public function update(Request $request) {
        $arr_data = array(
            "servicetype_id" => $request->servicetypeid,
            "name_th" => $request->servicemaster_nameth,
            "name_en" => $request->servicemaster_nameen,
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('service_master')
            ->where('id', $request->id)
            ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }

    public function getdata(Request $request) {
        switch ($request->val) {
            case 'servicetype':
                $data = DB::table('service_type')
                ->where('active', 1)
                ->get();
                return response()->json([ 'status' => 'success', 'data' => $data, 'param' => $request->val ]);
                break;
            case 'servicemaster':
                $data = DB::table('service_master')
                ->where('servicetype_id', $request->id)
                ->where('active', 1)
                ->get();
                return response()->json([ 'status' => 'success', 'data' => $data, 'param' => $request->val ]);
                break;
            case 'servicesub' :
                $data = DB::table('service')
                ->where('servicemaster_id', $request->id)
                ->where('active', 1)
                ->get();
                return response()->json([ 'status' => 'success', 'data' => $data, 'param' => $request->val ]);
                break;
            case 'service' :
                $data = DB::table('service')
                ->where('code', $request->code)
                ->where('active', 1)
                ->get();
                return response()->json([ 'status' => 'success', 'data' => $data, 'param' => $request->val ]);
                break;
        }
    }
}
