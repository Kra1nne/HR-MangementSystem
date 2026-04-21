<?php

namespace App\Http\Controllers\job_posting;

use App\Http\Controllers\Controller;
use App\Mail\ApplicationResponse;
use App\Models\Application;
use App\Models\ApplicationLog;
use App\Models\Department;
use App\Models\JobPosting;
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
        return response()->json(['Error' => 0, 'Message' => 'Successfully updated the job']);
    }
    public function deteleJob(Request $request){
        $jobPosting = JobPosting::where('id', $request->id)->delete();

        if(!$jobPosting){
            return response()->json(['Error' => 1, 'Message' => 'Unable to delete the job']);
        }
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
        return response()->json(['Error' => 0, 'Message' => 'Successfully open the job']);
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
    public function applicantLogs($id)
    {
        return response()->json(['Error' => 0, 'Message' => 'Successfully open the job']);
    }
    public function applicationAccepted(Request $request)
    {
        $data = [
            'status' => 'accepted',
            'updated_at' => now()
        ];

        $result = Application::where('id', $request->id)->update($data);

        $mailContent = [
            'name' => $request->firstname . " " . $request->lastname,
            'email' => $request->email,
            'position' => $request->position,
            'response' => 'accepted',
        ];

        $mail = Mail::to($request->email)->send(new ApplicationResponse($mailContent));

        // add employee

        if(!$result && !$mail){
            return response()->json(['Error' => 1, 'Message' => 'Unable to accepted the applicant']);    
        }
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
            $applicants = Application::where('status', '!=', 'rejected')
                ->where('job_id', Crypt::decryptString($request->job_id))
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
            }

            DB::transaction(function () use ($data) {
                ApplicationLog::insert($data);
            });

            // add a send mail

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
