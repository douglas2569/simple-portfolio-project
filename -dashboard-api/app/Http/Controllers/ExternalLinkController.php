<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ExternalLinkController extends Controller
{
    public function index():View
    {
        return view('externallink',[]);
    }
}
