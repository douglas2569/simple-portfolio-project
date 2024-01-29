<?php

namespace App\Http\Controllers;

use App\Helpers\Messages;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'message' =>  array()
        ];

        $data['projects'] = auth()->user()->project()->get();
        $data['message'] = Messages::noElementsRegistered('project')['message'];

        return view('project.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'thumbnail' => 'image|required|max:500',
            'name' => 'required|string|min:4',
            'video_youtube_id' => 'required|string|min:4',
            'description' => 'required|string|min:4',
        ]);

        $request->file('thumbnail')->store('public/images');
        $validated['thumbnail'] =  $validated['thumbnail']->hashName();

        auth()->user()->project()->create($validated);

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

        return view('project.edit',[
           'project' => $project
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
        ]);

        if($request->hasFile('thumbnail')){

            $validated = Validator::make(
                ['thumbnail' => $request->file('thumbnail')],
                ['thumbnail' => 'image|required|max:500'],
                ['required' => 'The :attribute field is required'],
                )->validate();

                $validated['thumbnail']->store('public/images');
                $validated['thumbnail'] =  $validated['thumbnail']->hashName();
                Storage::delete('public/images/'.$project->thumbnail);

        }

        $this->authorize('update', $project);
        $project->update($validated);
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
