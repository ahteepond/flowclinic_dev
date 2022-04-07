<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerTypeController extends Controller
{
    public function index() {
        return view('customertype.index');
    }

    public function new() {
        return view('customertype.new');
    }

    public function edit() {
        return view('customertype.edit');
    }
}
