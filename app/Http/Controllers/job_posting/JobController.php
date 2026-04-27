<?php

namespace App\Http\Controllers\job_posting;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationAssessment;
use App\Mail\ApplicationResponse;
use App\Models\Application;
use App\Models\ApplicationLog;
use App\Models\Department;
use App\Models\DepartmentEmployee;
use App\Models\Employee;
use App\Models\JobPosting;
use App\Models\Log;
use App\Models\Salary;
use App\Models\Title;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function jobPosting(Request $request)
    {
        $isSearch = $request->filled('search') || $request->filled('work_setup') || $request->filled('employment_type') || $request->filled('dept_name');

        $jobs = JobPosting::with('applicants')
            ->leftJoin('departments', 'departments.dept_no', '=', 'job_postings.dept_no')
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('job_postings.job_title', 'like', '%' . $request->search . '%')
                    ->orWhere('job_postings.description', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->filled('work_setup'), fn($q) => $q->where('job_postings.work_setup', $request->work_setup))
            ->when($request->filled('employment_type'), fn($q) => $q->where('job_postings.employment_type', $request->employment_type))
            ->when($request->filled('dept_name'), fn($q) => $q->where('departments.dept_name', $request->dept_name))
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
         $log = [
            'user_id' => Auth::id(),
            'action' => 'Add',
            'table_name' => 'JobPosting',
            'description' => 'Add a job posting',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);

        return response()->json(['Error' => 0, 'Message' => 'Successfully added the job']);
    }
    public function viewJob($id)
    {   
        $details = JobPosting::with('applicants')
            ->leftJoin('departments', 'departments.dept_no', '=', 'job_postings.dept_no')
            ->where('job_postings.id', Crypt::decryptString($id))
            ->first();

        $departments = Department::whereNull('deleted_at')->get();
        
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Details']
        ];
        
        return view('content.job_page.job-details', compact('breadcrumbs','details', 'departments', 'id'));
    }
    public function updateJob(Request $request){
        $data = [
            'dept_no' => $request->department,
            'job_title' => $request->jobTitle,
            'description' => $request->jobDescription,
            'objectives' => $request->jobObjective,
            'requirements' => $request->jobRequirements,
            'salary' => $request->salary,
            'position' => $request->jobPosition,
            'employment_type' => $request->jobType,
            'work_setup' => $request->workArrangement,
            'location' => $request->jobLocation,
            'closing_date' => $request->activeDate,
        ];

        $result = JobPosting::where('id', $request->id)->update($data);
        if(!$result){
            return response()->json(['Error' => 1, 'Message' => 'Unable to updated the job']);
        }

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Update',
            'table_name' => 'JobPosting',
            'description' => 'Update a job posting',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);

        return response()->json(['Error' => 0, 'Message' => 'Successfully updated the job']);
    }
    public function deteleJob(Request $request){
        $jobPosting = JobPosting::where('id', $request->id)->delete();

        if(!$jobPosting){
            return response()->json(['Error' => 1, 'Message' => 'Unable to delete the job']);
        }
        $log = [
            'user_id' => Auth::id(),
            'action' => 'Delete',
            'table_name' => 'JobPosting',
            'description' => 'Delete a job posting',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);

        return response()->json(['Error' => 0, 'Message' => 'Successfully deleted the job draft', 'Redirect' => route('job-posting')]);
    }
    public function openJob(Request $request){
        $jobPosting = JobPosting::where('id', $request->id)->update([
            'status' => 'open',
            'updated_at' => now()
        ]);

        if(!$jobPosting){
            return response()->json(['Error' => 0, 'Message' => 'Unable to open the job']);
        }

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Update',
            'table_name' => 'JobPosting',
            'description' => 'Open a job posting',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);
        return response()->json(['Error' => 0, 'Message' => 'Successfully open the job']);
    }
    public function closeJob(Request $request){
        $jobPosting = JobPosting::where('id', $request->id)->update([
            'status' => 'closed',
            'updated_at' => now()
        ]);

        if(!$jobPosting){
            return response()->json(['Error' => 0, 'Message' => 'Unable to close the job']);
        }

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Update',
            'table_name' => 'JobPosting',
            'description' => 'Close a job posting',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);
        return response()->json(['Error' => 0, 'Message' => 'Successfully close the job']);
    }
    public function jobApplicants($id, Request $request)
    {
        $isSearch = false;
        $search = $request->get('search');

        $decrypted_id = Crypt::decryptString($id);

        $jobPostingDetaiils = JobPosting::where('id', $decrypted_id)
            ->whereNull('deleted_at')
            ->first();

        $query = Application::with('candidate.person', 'applicationDocuments', 'latestApplicationLogs', 'applicationLogs')
            ->leftJoin('job_postings', 'job_postings.id', '=', 'applications.job_id')
            ->where('job_postings.id', $decrypted_id)
            ->where('applications.status', '!=' ,'rejected')
            ->orderBy('applications.applied_at', 'DESC')
            ->select('job_postings.*', 'applications.*', 'applications.id as application_id');
            
        if (!empty($search)) {
            $isSearch = true;

            $query->whereHas('candidate.person', function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                ->orWhere('lastname', 'like', "%{$search}%")
                ->orWhere('middlename', 'like', "%{$search}%");
            });
        }

        $jobPosting = $query->paginate(4)->appends([
            'search' => $search
        ]);
        
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting', 'link' => route('job-posting')],
            ['name' => 'Job Details', 'link' => route('job-posting-view', $id)],
            ['name' => 'Job Applicants']
        ];

        return view('content.job_page.job-applicant', compact(
            'breadcrumbs',
            'isSearch',
            'jobPosting',
            'jobPostingDetaiils',
            'id',
            'search'
        ));
    }
    public function applicationAccepted(Request $request)
    {
            
        $applicant = Application::leftjoin('job_postings', 'job_postings.id', '=', 'applications.job_id')
            ->leftjoin('candidates', 'candidates.application_id', '=' ,'applications.id')
            ->leftjoin('persons', 'persons.id', '=', 'candidates.person_id')
            ->where('applications.id', $request->id)
            ->first();
        
        $data = [
            'status' => 'accepted',
            'updated_at' => now()
        ];

        $result = Application::where('id', $request->id)->update($data);
        $mailContent = [
            'name' => $applicant->firstname . ' '. $applicant->lastname,
            'email' => $request->email,
            'position' => $request->position,
            'response' => 'accepted',
        ];
        $mail = Mail::to($request->email)->send(new ApplicationResponse($mailContent));

        $dataEmployee = [
            'person_id' => $applicant->person_id,
            'emp_id' => 'EMP-'.now()->year.'-'. $applicant->person_id,
            'hire_date' => now()->toDateString(),
            'status' => $applicant->employment_type,
            'created_at' => now(),
        ];
        $employee = Employee::create($dataEmployee);
        $dataSalary = [
            'emp_no' => $employee->id, 
            'salary' => $applicant->salary,
            'from_date' => now(),
            'created_at' => now()
        ];
        $dataTitle = [
            'emp_no' => $employee->id, 
            'title' => $applicant->position,
            'from_date' => now()
        ];
        $dataDepartmentEmp = [
            'emp_no' => $employee->id,
            'dept_no' => $applicant->dept_no,
            'status' => 'active',
            'from_date' => now(),
            'created_at' => now()
        ];
        $dept = DepartmentEmployee::insert($dataDepartmentEmp); 
        $title = Title::insert($dataTitle);
        $salary = Salary::insert($dataSalary);

        if(!$result && !$title && !$salary && !$dept){
            return response()->json(['Error' => 1, 'Message' => 'Unable to accepted the applicant']);    
        }

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Update',
            'table_name' => 'Applicants',
            'description' => 'Accept a applicant',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);
        return response()->json(['Error' => 0, 'Message' => 'Successfully accepted the applicant']);
    }
    public function applicationRejected(Request $request)
    {
        $data = [
            'status' => 'rejected',
            'updated_at' => now()
        ];

        $result = Application::where('id', $request->id)->update($data);

        $mailContent = [
            'name' => $request->firstname . " " . $request->lastname,
            'email' => $request->email,
            'position' => $request->position,
            'response' => 'rejected',
        ];

        $mail = Mail::to($request->email)->send(new ApplicationResponse($mailContent));

        if(!$result && !$mail){
            return response()->json(['Error' => 1, 'Message' => 'Unable to accepted the applicant']);    
        }

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Update',
            'table_name' => 'Applicants',
            'description' => 'Rejected a applicant',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);
        return response()->json(['Error' => 0, 'Message' => 'Successfully rejected the applicant']);
    }
    public function applicationShorlist(Request $request)
    {
        $data = [
            'status' => 'shortlist',
            'updated_at' => now()
        ];

        $result = Application::where('id', $request->id)->update($data);

        if(!$result){
            return response()->json(['Error' => 1, 'Message' => 'Unable to shortlist the applicant']);    
        }

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Update',
            'table_name' => 'Applicants',
            'description' => 'Shotlist a applicant',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];
        Log::insert($log);
        return response()->json(['Error' => 0, 'Message' => 'Successfully shorlisted the applicant']);
    }
    public function applicantFeedback(Request $request)
    {
        $data = [
            'remarks' => $request->remarks,
            'score' => $request->score,
            'comment' => $request->comment,
            'status' => 'done',
            'updated_at' => now()
        ];
        $result = ApplicationLog::whereNull('status')
            ->whereNull('remarks')
            ->whereNull('score')
            ->where('application_id', $request->applicant_id)
            ->update($data);
            
        if(!$result){
            return response()->json(['Error' => 1, 'Message' => 'Unable to feedback the applicant']);
        }
        return response()->json(['Error' => 0, 'Message' => 'Successfully feedback the applicant']);
    }
    public function assessment(Request $request)
    {
        $applicantCount = Application::where('job_id', Crypt::decryptString($request->job_id))->count();

        $assessmentProcess = Application::rightjoin('application_logs', 'application_logs.application_id', '=', 'applications.id')
            ->where('applications.job_id', Crypt::decryptString($request->job_id))
            ->whereNull('application_logs.status') 
            ->count();
   
        if ($applicantCount < 1 || $assessmentProcess > 0) {
            return response()->json([
                'Error' => 1,
                'Message' => 'Unable to set the assessment',
            ]);
        }

        try {
            $applicants = Application::with('jobposting', 'candidate.person')
                ->where('status', '!=', 'rejected')
                ->where('job_id', Crypt::decryptString($request->job_id))
                ->where('status', '=', 'shortlist')
                ->get();

            $data = [];

            foreach ($applicants as $applicant) {
                $data[] = [
                    'application_id' => $applicant->id,
                    'event_type' => $request->assessmentType,
                    'scheduled_at' => $request->schedule,
                    'assessment_tools' => $request->platform,
                    'created_at' => now(),
                ];
                $mailContent = [
                    'name' => $applicant->candidate->person->firstname . ' ' . $applicant->candidate->person->lastname,
                    'position' => $applicant->jobposting->position,
                    'assessmentType' => $request->assessmentType,
                    'schedule' => date('M. d, Y  h:i A', strtotime($request->schedule)),
                    'locationOrPlatform' => $request->platform,
                    'instructions' => $request->instruction
                ];

                Mail::to($applicant->email)->send(new ApplicationAssessment($mailContent));
            }

            DB::transaction(function () use ($data) {
                ApplicationLog::insert($data);
            });
            
            $log = [
                'user_id' => Auth::id(),
                'action' => 'Update',
                'table_name' => 'Applicants',
                'description' => 'Send the applicant a assessment',
                'ip_address' => request()->ip(),
                'created_at' => now(),
            ];
            Log::insert($log);

            return response()->json([
                'Error' => 0,
                'Message' => 'Assessment successfully sent'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'Error' => 1,
                'Message' => 'Unable to set the assessment',
            ]);
        }
    }
}
