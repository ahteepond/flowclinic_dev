<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index() {
        return view('employee.index');
    }

    public function list(Request $request) {
        if ($request->ajax()) {
            $data = DB::table('employee');
            $data = $data->where('active', $request->active);
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                 ->addColumn('empcode', function($row){
                    $empcode = $row->emp_code;
                    return $empcode;
                })
                ->addColumn('empfullname', function($row){
                    $empfullname = $row->emp_fname_th . " " . $row->emp_lname_th;
                    return $empfullname;
                })
                ->addColumn('active', function($row){
                    $int_active = $row->active;
                    if ($int_active == 0) { $active = '<span class="badge badge-pill bg-success">Active</span>'; }
                    if ($int_active == 1) { $active = '<span class="badge badge-pill bg-secondary">Inactive</span>'; }
                    return $active;
                })
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" onclick="edit('.$row->emp_code.')" class="text-muted me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-label="Edit" data-bs-original-title="Edit"><span class="fe fe-edit"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action', 'active'])
                ->make(true);
        }
    }

    public function new() {
        return view('employee.new');
    }

    public function insert(Request $request) {
        $arr_data = array(
            "emp_code" => $request->empcode,
            "emp_fname_th" => $request->empfname,
            "emp_lname_th" => $request->emplname,
            "active" => $request->active,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $res = DB::table('employee')
        ->insert($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $res ]);
    }

    public function edit($empcode) {
        $res = DB::table('employee')
            ->where('emp_code', $empcode)
            ->first();
        return view('employee.edit', compact('res') );
    }

    public function update(Request $request) {
        $arr_data = array(
            "emp_fname_th" => $request->empfname,
            "emp_lname_th" => $request->emplname,
            "active" => $request->active,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        );
        $update = DB::table('employee')
            ->where('id', $request->id)
            ->where('emp_code', $request->empcode)
            ->update($arr_data);
        return response()->json([ 'status' => 'success', 'result' => true, 'param' => $update ]);
    }
}
