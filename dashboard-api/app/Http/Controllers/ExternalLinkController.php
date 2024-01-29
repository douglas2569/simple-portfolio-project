<?php

namespace App\Http\Controllers;

use App\Helpers\Messages;
use App\Models\ExternalLink;
use App\Models\ViewProjectExternalLink;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExternalLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $data = [
            'projects' => array(),
            'externalLinksProjects' => array(),
            'message' => array(),
        ];

        try {
            $data['projects'] = auth()->user()->project()->get();
            if(count($data['projects']) <= 0){
                throw new \ErrorException('');
            }

            foreach($data['projects'] as $project){
                array_push($data['externalLinksProjects'], ViewProjectExternalLink::where('project_id', $project->id)->get());
            }


            $data['message'] = Messages::noElementsRegistered('External Link')['message'];
        } catch (\ErrorException $th) {
            $data['message'] = Messages::parentElementIsMissing('Project')['message'];

        }

        return view('externallink.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {

        $validated = $request->validate([
            'project_id' => 'string|required|max:255',
            'name' => 'required|string|max:50',
            'url' => 'required|string|max:255',
        ]);

        ExternalLink::create($validated);

        return redirect(route('externallink.index'));

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
    public function edit(ExternalLink $externallink):View
       {
        $this->authorize('update', $externallink);

        return view('externallink.edit',[
            'externallink' => $externallink,
            'projects' => $data['projects'] = auth()->user()->project()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, externallink $externallink):RedirectResponse
    {
        $this->authorize('update', $externallink);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'url' => 'required|string|max:255',
            'project_id' => 'required|string|max:50',
        ]);

        $externalLink = ExternalLink::find($externallink->id);
        $externalLink->name = $validated['name'];
        $externalLink->url = $validated['url'];
        $externalLink->project_id = $validated['project_id'];

        $externalLink->save();

        return redirect(route('externallink.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExternalLink $externallink): RedirectResponse
    {
        $this->authorize('delete', $externallink);
        $externallink->delete();
        return redirect(route('externallink.index'));
    }
}
