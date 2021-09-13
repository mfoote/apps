<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebCallController extends Controller
{
    public function index(){
        return view('app.web_calls.index');
    }
}
