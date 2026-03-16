<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        return view('content.employee.employee');
    }
    public function registerFace(){
        return view('content.employee.face-registration');
    }
}
