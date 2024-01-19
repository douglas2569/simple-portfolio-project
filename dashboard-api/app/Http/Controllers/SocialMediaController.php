<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SocialMediaController extends Controller
{

    public function index(Request $request):View
    {
        echo $request;
        return view('socialmedia',[]);
    }
}
