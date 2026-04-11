<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\JobPosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class HomePagesController extends Controller
{
    public function home()
    {
        return view('content.homepage.home');
    }
    public function about()
    {
        return view('content.homepage.about');
    }
   public function services(Request $request)
    {
        $isSearch = $request->filled('search') || $request->filled('work_setup') || $request->filled('employment_type') || $request->filled('dept_name');

        $jobs = JobPosting::leftJoin('departments', 'departments.dept_no', '=', 'job_postings.dept_no')
            ->where('job_postings.closing_date', '>=', now())
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('job_postings.job_title', 'like', '%' . $request->search . '%')
                    ->orWhere('job_postings.description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('work_setup'), fn($q) => $q->where('job_postings.work_setup', $request->work_setup))
            ->when($request->filled('employment_type'), fn($q) => $q->where('job_postings.employment_type', $request->employment_type))
            ->when($request->filled('dept_name'), fn($q) => $q->where('departments.dept_name', $request->dept_name))
            ->select('job_postings.*', 'departments.dept_name')
            ->paginate(8);

        $departments = Department::all();

        return view('content.homepage.services', compact('isSearch', 'jobs', 'departments'));
    }
    public function viewJob($id)
    {   $jobID = $id;
        $details = JobPosting::leftJoin('departments', 'departments.dept_no', '=', 'job_postings.dept_no')
            ->where('job_postings.id', Crypt::decryptString($id))
            ->first();
        
        return view('content.homepage.job_page.job-details', compact('details', 'jobID'));
    }
    public function jobForm($id)
    {
        return view('content.homepage.job_page.job-form');
    }
    public function contact()
    {
        return view('content.homepage.contact');
    }
}
