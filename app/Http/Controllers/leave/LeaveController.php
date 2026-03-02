<?php

namespace App\Http\Controllers\leave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(){
        return view('content.leave.leave');
    }
}
