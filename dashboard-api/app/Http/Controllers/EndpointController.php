<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\View\View;

class EndpointController extends Controller
{
    public $response = [
        'error'=>'',
        'data'=> ''
    ];

    public function index():View
    {
        $about = auth()->user()->about()->get()[0];

        $about['social_media'] = $about->socialMedia()->get();
        $this->response['data'] = $about;
        $aboutData = json_encode($this->response);

        $coverPhoto = $about->coverPhoto()->get();
        $this->response['data'] = $coverPhoto;
        $coverphotoData = json_encode($this->response);

        $this->response['data'] = [];

        $projects = auth()->user()->project()->get();

        foreach($projects as $project){
            $project['technologies'] = $project->technologies()->get();
            $project['external_links']= $project->externallink()->get();

            array_push($this->response['data'], $project);
        }
        $projectsData = json_encode($this->response);

        $this->response['data'] = [];

        $skills = auth()->user()->skill()->get();

        foreach($skills as $skill){
            $skill['technologies'] = $skill->technologies()->get();
            array_push($this->response['data'], $skill);
        }

        $skillsData = json_encode($this->response);

        $project = Project::where(['user_id'=>auth()->user()->id, 'id'=>auth()->user()->project()->get()[0]->id])->get()[0];

        $project['technologies'] = $project->technologies()->get();
        $project['external_links']= $project->externallink()->get();

        $this->response['data']= $project;
        $projectIdData = json_encode($this->response);


        return view('endpoint.index', [
            'endpoints' => [
                'about' => [
                    'endpoint'=> asset('api/about/'.auth()->user()->email),
                    'data'=> $aboutData,
                ],
                'coverphoto' => [
                    'endpoint'=> asset('api/coverphoto/'.auth()->user()->email),
                    'data'=> $coverphotoData,
                ],
                'skill' => [
                    'endpoint'=> asset('api/skill/'.auth()->user()->email),
                    'data'=> $skillsData,
                ],
                'project' => [
                    'endpoint'=> asset('api/project/'.auth()->user()->email),
                    'data'=> $projectsData,
                ],
                'projectId' => [
                    'endpoint'=> asset('api/project/project_id/'.auth()->user()->email),
                    'data'=> $projectIdData,
                ],
                // 'email' => asset('api/email/'.auth()->user()->email),
            ]
        ]);


    }

}
