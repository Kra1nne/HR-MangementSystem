<?php

namespace App\Http\Controllers\department;

use App\Http\Controllers\Controller;
use App\Models\Departments;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class DepartmentController extends Controller
{
    public function index(){
        $departments = Departments::whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($department) {
                $department->dept_no = Crypt::encryptString($department->dept_no);
                return $department;
            });

        return view('content.department.department-list', compact('departments'));
    }
    public function details($id){
        $departmentDetails = Departments::whereNull('deleted_at')
            ->where('dept_no', Crypt::decryptString($id))
            ->orderBy('created_at', 'desc')
            ->first();
        
        return view('content.department.department-details', compact('departmentDetails'));
    }
    public function addDepartment(Request $request){
        $data = [
            'dept_name' => $request->name,
            'details' => $request->details,
            'icon' => $request->departmentIcon,
            'created_at' => now()
        ];
        $log = [
            'user_id' => Auth::id(),
            'action' => 'Add',
            'table_name' => 'Departments',
            'description' => 'Added a department',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        
        $isCreated = Departments::insert($data);
        $logData = Log::insert($log);

        if($isCreated && $logData){
            return response()->json(['Error' => 0, 'Message' => 'Successfulyy added a new Department']);
        }
    }
}
