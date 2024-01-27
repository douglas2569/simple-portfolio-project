<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoverPhoto;
use App\Models\SocialMedia;
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
            $coverPhoto = $about->coverPhoto()->get();
            $socialMedia = $about->socialMedia()->get();

            $this->response['data'] = response()->json([
                'about' => $about,
                'cover_photo' => $coverPhoto,
                'social_media' => $socialMedia
            ]);


            DB::commit();
        } catch (\ErrorException $th) {
            $this->response['error'] = $th->getMessage();
            DB::rollBack();
        }

        return $this->response;

    }
}
