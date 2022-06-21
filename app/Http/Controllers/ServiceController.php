<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function index() {
        $service_type = DB::table('service_type')
        ->where('active', 1)
        ->get();
        return view('service.index', compact('service_type'));
    }

    public function new() {
        return view('service.new');
    }

    public function edit($id) {
        $res = DB::table('service')
            ->join('service_master', 'service_master.id', '=', 'service.servicemaster_id')
            ->join('service_type', 'service_type.id', '=', 'service_master.servicetype_id')
            ->select(
                'service_type.id as servicetype_id',
                'service_type.name_th as servicetype_nameth',
                'service_type.name_en as servicetype_nameen',
                'service_master.id as servicemaster_id',
                'service_master.name_th as servicemaster_nameth',
                'service_master.name_en as servicemaster_nameen',
                'service.id',
                'service.name_th as service_nameth',
                'service.name_en as service_nameen',
                'service.description',
                'service.price',
                'service.price_promo',
                'service.active',
                'service.created_at',
                'service.updated_at' )
            ->where('service.id', $id)
            ->first();
        return view('service.edit', compact('res') );
    }

    public function view($id) {
        $res = DB::table('service')
            ->join('service_master', 'service_master.id', '=', 'service.servicemaster_id')
            ->join('service_type', 'service_type.id', '=', 'service_master.servicetype_id')
            ->select(
                'service_type.id as servicetype_id',
                'service_type.name_th as servicetype_nameth',
                'service_type.name_en as servicetype_nameen',
                'service_master.id as servicemaster_id',
                'service_master.name_th as servicemaster_nameth',
                'service_master.name_en as servicemaster_nameen',
                'service.id',
                'service.name_th as service_nameth',
                'service.name_en as service_nameen',
                'service.description',
                'service.price',
                'service.price_promo',
                'service.active',
                'service.created_at',
                'service.updated_at' )
            ->where('service.id', $id)
            ->first();
        return view('service.view', compact('res') );
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('service');
            $data = $data->join('service_master', 'service_master.id', '=', 'service.servicemaster_id');
            $data = $data->join('service_type', 'service_type.id', '=', 'service_master.servicetype_id');
            $data = $data->select(
                'service_type.name_th as servicetype_nameth',
                'service_master.name_th as servicemaster_nameth',
                'service.id',
                'service.name_th as service_nameth',
                'service.description',
                'service.price',
                'service.price_promo',
                'service.active',
                'service.created_at',
                'service.updated_at' );
            $data = $data->where('service.active', $request->active);
            if ($request->servicetype != 'A') {
                $data = $data->where('service_type.id', $request->servicetype);
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('servicetypename', function($row){
                    $servicetype = $row->servicetype_nameth;
                    return $servicetype;
                })
                ->addColumn('servicemastername', function($row){
                    $servicemaster = $row->servicemaster_nameth;
                    return $servicemaster;
                })
                ->addColumn('servicename', function($row){
                    $service = $row->service_nameth;
                    return $service;
                })
                ->addColumn('active', function($row){
                    $int_active = $row->active;
                    if ($int_active == 0) { $active = '<span class="badge bg-danger-transparent rounded-pill text-danger p-2 px-3">Inactive</span>'; }
                    if ($int_active == 1) { $active = '<span class="badge bg-success-transparent rounded-pill text-success p-2 px-3">Active</span>'; }
                    return $active;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" title="รายละเอียด" onclick="view('.$row->id.')" class="btn text-info btn-sm"><i class="ion-more"></i></a>
                    <a href="javascript:void(0)" title="แก้ไข" onclick="edit('.$row->id.')" class="btn text-primary btn-sm"><span class="fe fe-edit"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
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

    public function insert(Request $request) {

        // Gen Code -------
        $rescode = DB::table('service')
            ->orderBy('code', 'DESC')
            ->first();
        $prefix = "PRD-";
        if ($rescode) {
            $code_current = explode('-',$rescode->code)[1];
            $code_new = sprintf("%05d", (int)$code_current + 1);
            $gencode = $prefix . $code_new;
        } else {
            $gencode = $prefix . "00001";
        }

        $arr_data = array(
            "code" => $gencode,
            "servicemaster_id" => $request->servicemasterid,
            "name_th" => $request->service_nameth,
            "name_en" => $request->service_nameen,
            "description" => $request->description,
            "price" => $request->price,
            "price_promo" => $request->price_promo,
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('service')
            ->insert($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }

    public function update(Request $request) {
        $arr_data = array(
            "servicemaster_id" => $request->servicemasterid,
            "name_th" => $request->service_nameth,
            "name_en" => $request->service_nameen,
            "description" => $request->description,
            "price" => $request->price,
            "price_promo" => $request->price_promo,
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('service')
            ->where('id', $request->id)
            ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }
}
