<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use ArrayObject;
use Illuminate\Support\Facades\DB;

class SkillController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> [

        ]
    ];

    public function skill(string $email){

        try {
            DB::beginTransaction();
            $user = User::where('email', $email)->get()[0];
            $skills = $user->skill()->get();

            foreach($skills as $skill){
                $technologies = $skill->technologies()->get();
                array_push($this->response['data'], $skill);
                $skill['technologies'] =  new ArrayObject(array());
                foreach($technologies as $technology){
                    $skill['technologies']->append($technology);
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