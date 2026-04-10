<?php

namespace App\Http\Controllers\homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function services()
    {
        $isSearch = '';
        return view('content.homepage.services', compact('isSearch'));
    }
    public function contact()
    {
        return view('content.homepage.contact');
    }
}
