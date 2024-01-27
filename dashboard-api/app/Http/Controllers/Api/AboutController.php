<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\User;
use Illuminate\Http\Request;


class AboutController extends Controller
{
    public function about(Request $request, string $email)
    {
        if($request->filled('email'))
            $email = $request->input('email');

        $user = User::where('email', $email)->get()[0];
        $about = About::where('user_id',$user->id)->get();

        return response()->json($about);

    }
}
