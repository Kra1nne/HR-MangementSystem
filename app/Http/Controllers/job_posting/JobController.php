<?php

namespace App\Http\Controllers\job_posting;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class JobController extends Controller
{
    public function jobPosting(Request $request)
    {
        $isSearch = $request->filled('search') || $request->filled('work_setup') || $request->filled('employment_type') || $request->filled('dept_name');

        $jobs = JobPosting::leftJoin('departments', 'departments.dept_no', '=', 'job_postings.dept_no')
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('job_postings.job_title', 'like', '%' . $request->search . '%')
                    ->orWhere('job_postings.description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('work_setup'), fn($q) => $q->where('job_postings.work_setup', $request->work_setup))
            ->when($request->filled('employment_type'), fn($q) => $q->where('job_postings.employment_type', $request->employment_type))
            ->when($request->filled('dept_no'), fn($q) => $q->where('departments.dept_name', $request->dept_name))
            ->orderBy('job_postings.id', 'Desc')
            ->select('job_postings.*', 'departments.dept_name')
            ->paginate(8);
        
        $departments = Department::whereNull('deleted_at')->get();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting'],
        ];
        return view('content.job_page.job-posting', compact('breadcrumbs', 'departments', 'jobs', 'isSearch'));
    }
    public function addJob(Request $request)
    {
        $data = [
            'dept_no' => $request->department,
            'created_by' => Auth::id(),
            'job_title' => $request->jobTitle,
            'description' => $request->jobDescription,
            'objectives' => $request->jobObjective,
            'requirements' => $request->jobRequirements,
            'salary' => $request->salary,
            'position' => $request->jobPosition,
            'employment_type' => $request->jobType,
            'work_setup' => $request->workArrangement,
            'location' => $request->jobLocation,
            'posted_at' => now(),
            'created_at' => now(),
            'closing_date' => $request->activeDate,
        ];
        $result = JobPosting::insert($data);

        if(!$result){
            return response()->json(['Error' => 0, 'Message' => 'Job failed to save']);
        }
        return response()->json(['Error' => 0, 'Message' => 'Successfully added a job']);
    }
    public function viewJob($id)
    {   
        $details = JobPosting::leftJoin('departments', 'departments.dept_no', '=', 'job_postings.dept_no')
            ->where('job_postings.id', Crypt::decryptString($id))
            ->first();
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Details']
        ];

  
        return view('content.job_page.job-details', compact('breadcrumbs','details'));
    }
    
}
