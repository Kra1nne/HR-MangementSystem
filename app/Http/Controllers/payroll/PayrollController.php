<?php

namespace App\Http\Controllers\payroll;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PayrollController extends Controller
{
     public function index(Request $request){
        
        $data = Employee::with(['person', 'latestSalary', 'latestTitle']);
        $isSearch = false;

        if($request->search){
            $data->where('emp_id', 'like', '%'.$request->search.'%');
            $isSearch = true;
        }
        

        $employees = $data->whereNull('deleted_at')
            ->paginate(7);

        $employees->getCollection()->transform(function ($employee) {
            $employee->encrypted_id = Crypt::encryptString($employee->emp_no);
            return $employee;
        });
        
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Payroll'],
        ];
        return view('content.payroll.payroll', compact('breadcrumbs','employees', 'isSearch'));
    }
}
