<?php

namespace App\Http\Controllers\recruitment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index(){
        return view('content.recruitment.job');
    }
    public function details(){
        return view('content.recruitment.job-details');
    }
    public function recruitmentcandidates(){
        return view('content.recruitment.job-candidates');
    }
}
