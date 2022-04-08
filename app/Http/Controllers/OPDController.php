<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OPDController extends Controller
{
    public function index() {
        return view('opd.index');
    }

    public function process() {
        return view('opd.process');
    }

    public function history() {
        return view('opd.history');
    }
}
