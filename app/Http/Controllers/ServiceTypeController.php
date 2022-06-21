<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ServiceTypeController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        return view('servicetype.index');
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('service_type');
            $data = $data->select('service_type.*');
            $data = $data->where('active', $request->active);
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('servicetype', function($row){
                    $servicetype = $row->name_th;
                    return $servicetype;
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
        return view('servicetype.new');
    }

    public function insert(Request $request) {
        $arr_data = array(
            "name_th" => $request->name,
            "active" => $request->active,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('service_type')
        ->insertOrIgnore($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function edit($id) {
        $res = DB::table('service_type')
            ->select('service_type.*')
            ->where('id', $id)
            ->first();
        return view('servicetype.edit', compact('res') );
    }

    public function update(Request $request) {
        $arr_data = array(
            "name_th" => $request->name,
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('service_type')
            ->where('id', $request->id)
            ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }
}
