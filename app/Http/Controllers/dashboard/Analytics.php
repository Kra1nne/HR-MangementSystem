<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Department;
use App\Models\Employee;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
   $applicants = Application::selectRaw('count(*) as total, applied_at')
      ->groupBy('applied_at')
      ->orderBy('applied_at')
      ->get();
    $listOfApplicant = Application::all();

    $statusData = Application::selectRaw('status, count(*) as total')
        ->groupBy('status')
        ->get();
    
    $listOfDepartment = Department::whereNull('deleted_at')
      ->get();
    
    $jobList = JobPosting::where('status', '!=', 'closed')
      ->whereNull('deleted_at');
    
    $applicantsList = Application::with(['candidate.person', 'jobposting'])
      ->orderBy('created_at', 'desc')
      ->limit(5)
      ->get();
    //dd($applicantsList);
    $employeeList = Employee::where('deleted_at')->get();
        
    return view('content.dashboard.dashboards-analytics', compact('applicants', 'applicantsList','employeeList','jobList', 'statusData','listOfDepartment','listOfApplicant'));
  }
}
