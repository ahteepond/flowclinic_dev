<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index() {
        return view('service.index');
    }

    public function new() {
        return view('service.new');
    }

    public function edit() {
        return view('service.edit');
    }

    public function view() {
        return view('service.view');
    }

}
