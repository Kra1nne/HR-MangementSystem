<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data = Employee::with(['person', 'latestSalary', 'latestTitle', 'latestDepartment.department'])
            ->where('emp_no', Crypt::decryptString($id))
            ->first();

        $employee_id = $id;

        return view('content.accounts.profile', compact('data', 'employee_id'));
    }
    public function updateEmployee()
    {

    }
}
