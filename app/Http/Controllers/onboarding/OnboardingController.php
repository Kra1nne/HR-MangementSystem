<?php

namespace App\Http\Controllers\onboarding;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function index(){
        return view('content.onboarding.onboarding');
    }
}
