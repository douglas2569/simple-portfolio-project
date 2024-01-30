<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CoverphotoController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> ''
    ];

    public function coverphoto(string $email){

        try {
            DB::beginTransaction();
            $user = User::where('email', $email)->get()[0];
            $about = $user->about()->get()[0];
            $coverPhoto = $about->coverPhoto()->get();

            $this->response['data'] = $coverPhoto;


            DB::commit();
        } catch (\ErrorException $th) {
            $this->response['error'] = $th->getMessage();
            DB::rollBack();
        }

        return json_encode($this->response);

    }
}
