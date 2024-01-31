<?php

namespace App\Http\Controllers;

use App\Exceptions\NoElementsRegisteredException;
use App\Exceptions\ParentElementIsMissingException;
use App\Helpers\Messages;
use App\Models\Project;
use App\Models\ProjectTechnology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $data = [
            'projects' => array(),
            'message' =>  array(),
            'technologies'=> array(),
        ];

        try {
            $data['technologies'] = auth()->user()->technology()->get();
            if(count($data['technologies']) <= 0)
                throw new ParentElementIsMissingException();

            $data['projects'] = auth()->user()->project()->get();
            if(count($data['projects']) <= 0)
                throw new NoElementsRegisteredException();

        } catch (ParentElementIsMissingException $th) {
            $data['message'] = Messages::parentElementIsMissing('Technology')['message'];
        }catch (NoElementsRegisteredException $th) {
            $data['message'] = Messages::noElementsRegistered('Project')['message'];
        }

        return view('project.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'thumbnail' => 'image|required|max:600',
            'name' => 'required|string|min:4',
            'video_youtube_id' => 'required|string|min:4',
            'description' => 'required|string|min:4',
            'technologiesIds' => 'required',
        ]);

        $request->file('thumbnail')->store('public/images');
        $validated['thumbnail'] =  $validated['thumbnail']->hashName();

        try {
            DB::beginTransaction();
            auth()->user()->project()->create($validated);

            $lastProjectId = (auth()->user()->project()->latest()->get())[0]->id;
            foreach($validated['technologiesIds'] as $technologyId){
                ProjectTechnology::create(['project_id'=>$lastProjectId, 'technology_id'=>$technologyId]);
            }
            DB::commit();
        } catch (\Exception $th) {
            echo $th->getMessage();
            DB::rollBack();
        }


        return redirect(route('project.index'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project):View
       {
        $this->authorize('update', $project);
        $myTechnologies = ProjectTechnology::where('project_id', $project->id)->get();
        $myTechnologiesIds = array();
        foreach($myTechnologies as $myTechnology){
            array_push($myTechnologiesIds ,  $myTechnology->technology_id);
        }

        return view('project.edit',[
           'project' => $project,
           'technologies'=> auth()->user()->technology()->get(),
           'myTechnologies'=> $myTechnologiesIds,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:4',
            'video_youtube_id' => 'required|string|min:4',
            'description' => 'required|string|min:4',
            'technologiesIds' => 'required',
        ]);

        if($request->hasFile('thumbnail')){

            $validated = Validator::make(
                ['thumbnail' => $request->file('thumbnail')],
                ['thumbnail' => 'image|required|max:600'],
                ['required' => 'The :attribute field is required'],
                )->validate();

                $validated['thumbnail']->store('public/images');
                $validated['thumbnail'] =  $validated['thumbnail']->hashName();
                Storage::delete('public/images/'.$project->thumbnail);

        }

        try {
            DB::beginTransaction();

            $this->authorize('update', $project);
            $project->update($validated);

            if(count($validated['technologiesIds']) > 0){
                ProjectTechnology::where(['project_id'=>$project->id])->delete();

                foreach($validated['technologiesIds'] as $technologyId){
                    ProjectTechnology::create(['project_id'=>$project->id, 'technology_id'=>$technologyId]);
                }
            }
            DB::commit();
        } catch (\Exception $th) {
            echo $th->getMessage();
            DB::rollBack();
        }
        die();
        return redirect(route('project.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): RedirectResponse    {

        $this->authorize('delete', $project);
        Storage::delete('public/images/'.$project->thumbnail);
        $project->delete();
        return redirect(route('project.index'));
    }
}
