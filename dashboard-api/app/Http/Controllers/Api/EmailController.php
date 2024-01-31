<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmailController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> [

        ]
    ];

    public function send(Request $request){

        $validated = $request->validate([
            'to' => 'required|string|max:255',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:1600'
        ]);

        try {

        } catch (\ErrorException $th) {
            $this->response['error'] = $th->getMessage();
        }

        return json_encode($this->response);

    }
}
