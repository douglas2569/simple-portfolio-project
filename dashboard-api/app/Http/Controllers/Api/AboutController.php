<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

class AboutController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> ''
    ];

    public function about(string $email){

        try {
            $user = User::where('email', $email)->get()[0];
            $about = $user->about()->get();
            $this->response['data'] = response()->json($about);

        } catch (\ErrorException $th) {
            $this->response['error'] = $th->getMessage();
        }

        return $this->response;

    }
}
