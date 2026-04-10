<?php

namespace App\Http\Controllers\job_posting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function job_posting(Request $request)
    {
        $breadcrumbs = [
            ['name' => 'Dashboard', 'link' => route('dashboard-analytics')],
            ['name' => 'Job Posting'],
        ];
        return view('content.job_page.job-posting', compact('breadcrumbs'));
    }
}
