<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Employee'],
        ];
        return view('content.employee.employee', compact('breadcrumbs'));
    }
    public function registerFace(){
        return view('content.employee.face-registration');
    }
}
