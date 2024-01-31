<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use ArrayObject;
use Illuminate\Support\Facades\DB;

class projectController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> [

        ]
    ];

    public function project(string $email){

        try {
            DB::beginTransaction();
            $user = User::where('email', $email)->get()[0];
            $projects = $user->project()->get();

            foreach($projects as $project){                                                
                $project['technologies'] = $project->technologies()->get();
				$project['external_links']= $project->externallink()->get();
				
				array_push($this->response['data'], $project);  

            }

            DB::commit();
        } catch (\ErrorException $th) {
            $this->response['error'] = $th->getMessage();
            DB::rollBack();
        }

        return json_encode($this->response);

    }
}
