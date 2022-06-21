<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmittedController extends Controller
{

    public function __construct() {
        $this->middleware('checksession');
    }

    public function index() {
        return view('admitted.index');
    }

    public function process() {
        return view('admitted.process');
    }
}
