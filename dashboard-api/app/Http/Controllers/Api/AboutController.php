<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> ''
    ];

    public function about(string $email){

        try {
            DB::beginTransaction();
            $user = User::where('email', $email)->get()[0];
            $about = $user->about()->get()[0];                        
			$about['social_media'] = $about->socialMedia()->get();
			
            $this->response['data'] = $about;


            DB::commit();
        } catch (\ErrorException $th) {
            $this->response['error'] = $th->getMessage();
            DB::rollBack();
        }

        return json_encode($this->response);

    }
}
