<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    public function index($id)
    {
        $data = Employee::with(['person', 'latestSalary', 'latestTitle'])
            ->leftjoin('users', 'employees.person_id', '=', 'users.person_id')
            ->where('emp_no', Crypt::decryptString($id))
            ->first();
        
        return view('content.accounts.profile', compact('data'));
    }
}
