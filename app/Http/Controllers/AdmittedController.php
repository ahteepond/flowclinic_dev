<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdmittedController extends Controller
{
    public function index() {
        return view('admitted.index');
    }

    public function process() {
        return view('admitted.process');
    }
}
