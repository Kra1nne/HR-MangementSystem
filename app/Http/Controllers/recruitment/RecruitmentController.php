<?php

namespace App\Http\Controllers\recruitment;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Departments;
use App\Models\Job;
use App\Models\Log;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class RecruitmentController extends Controller
{
    public function index(Request $request){
        $query = Job::whereNull('deleted_at');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $jobs = $query->orderBy('id', 'desc')->paginate(9);

        $jobs->getCollection()->transform(function ($job) {
            $job->encrypted_id = Crypt::encryptString($job->id);
            return $job;
        });

        $departments = Departments::whereNull('deleted_at')
            ->orderBy('dept_no', 'desc')
            ->get();
    
        return view('content.recruitment.job', compact('jobs', 'departments'));
    }
    public function details(Request $request, $id){
        $encrypted_id = $id;
        $jobDetails = Job::whereNull('deleted_at')
            ->where('id',Crypt::decryptString($id))
            ->orderBy('created_at', 'desc')
            ->first();
        $search = $request->search;

        $candidates = Candidate::with('person')
        ->when($search, function ($query) use ($search) {
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('firstname', 'like', "%{$search}%")
                  ->orWhere('lastname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        })
        ->paginate(8)
        ->withQueryString();

        return view('content.recruitment.job-details', compact('jobDetails','candidates','encrypted_id'));
    }
    public function recruitmentcandidates(){
        return view('content.recruitment.job-candidates');
    }
    public function addJob(Request $request){
        $data = [
            'dept_no' => $request->dept,
            'title' => $request->title,
            'description'=> $request->description,
            'position' => $request->position,
            'salary_range' => $request->salary_range,
            'job_objective' => $request->objective,
            'job_requirements' => $request->requirements,
            'work_arrangement' => $request->workArrangement,
            'job_type' => $request->jobType,
            'active_date' => $request->date,
            'location' => $request->location,
            'created_at' => now(),
        ];

        $log = [
            'user_id' => Auth::id(),
            'action' => 'Add',
            'table_name' => 'Job',
            'description' => 'Added a Job',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];

        $isDone = Job::insert($data);
        $logResult = Log::insert($log);

        if($isDone && $logResult){
            return response()->json(['Error' => 0, 'Message' => 'Successfuly Created a Job.']);
        } 
    }
    public function addCanditate(Request $request){
        $dataPerson = [
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'sex' => $request->sex,
            'birth_date' => $request->birthdate,
            'created_at' => now()
        ];
        $person = Person::create($dataPerson);
        
        $dataCandidate = [
            'job_id' => $request->job_id,
            'person_id' => $person->id,
            'status' => "In Progress",
            'email' => $request->email,
            'created_at' => now()
        ];
        $log = [
            'user_id' => Auth::id(),
            'action' => 'Add',
            'table_name' => 'Candidate',
            'description' => 'Added a Candidate',
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ];

        $candidate = Candidate::insert($dataCandidate);
        $log = Log::insert($log);

        if($log && $candidate){
            return response()->json(['Error' => 0, 'Message' => 'Successfuly added a new candidate.']);
        }
    }
}
