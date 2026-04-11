<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\ApplicationDocument;
use App\Models\Candidate;
use App\Models\Department;
use App\Models\JobPosting;
use App\Models\Person;
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
        $JobId = $id;
        return view('content.homepage.job_page.job-form', compact('JobId'));
    }
    public function message($id)
    {
        return view('content.homepage.job_page.job-message');
    }
    public function application(Request $request)
    {
        $encrypted_email = Crypt::encryptString($request->email);

        $application = [
            'job_id' => Crypt::decryptString($request->job_id),
            'status' => 'apply',
            'applied_at' => now()->toDateString(),
            'created_at' => now(),
        ];
        $person = [
            'firstname' => $request->first_name,
            'middlename' => $request->middle_name,
            'lastname' => $request->last_name,
            'address' => $request->address,
            'phone_number' => $request->phone,
            'birth_date' => $request->dob,
            'sex' => $request->sex,
            'blood_type' => $request->blood_type,
            'created_at' => now(),
        ];
        $applicationData = Application::create($application);
        $personData = Person::create($person);

        $candidate = [
            'application_id' => $applicationData->id,
            'person_id' => $personData->id,
            'created_at' => now(),
        ];
        Candidate::insert($candidate);

        $path_resume = $request->resume->store('uploads', 'public');
        $resume = [
            'application_id' => $applicationData->id,
            'type' => 'Resume',
            'file_path' => $path_resume,
            'created_at' => now(),
        ];
        $isApplication = ApplicationDocument::insert($resume);

        if($request->hasFile('certificates')){
            foreach($request->file('certificates') as $images){
                $path_certificate = $images->store('uploads', 'public');
                ApplicationDocument::insert([
                    'application_id' => $applicationData->id,
                    'type' => 'Certificate',
                    'file_path' => $path_certificate,
                    'created_at' => now(),
                ]);
            }
        }
        
        if(!$isApplication || !$applicationData || !$personData){
            return response()->json(['Error' => 1, 'Message' => 'Application invalid']);
        }
        return response()->json(['Error' => 0, 'Message' => 'Application successfully submitted', 'Redirect' => route('job-form-message', $encrypted_email)]);
    }
    public function contact()
    {
        return view('content.homepage.contact');
    }
}
