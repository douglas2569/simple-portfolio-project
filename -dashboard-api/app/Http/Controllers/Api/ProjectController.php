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
                $technologies = $project->technologies()->get();
                array_push($this->response['data'], $project);
                $project['technologies'] =  new ArrayObject(array());
                foreach($technologies as $technology){
                    $project['technologies']->append($technology);
                }

                $externalLinks = $project->externalLink()->get();
                $project['external_links'] =  new ArrayObject(array());
                foreach($externalLinks as $externalLink){
                    $project['external_links']->append($externalLink);
                }

            }



            DB::commit();
        } catch (\ErrorException $th) {
            $this->response['error'] = $th->getMessage();
            DB::rollBack();
        }

        return $this->response;

    }
}
