<?php

namespace App\Http\Controllers;

use App\Helpers\Messages;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $data = [
            'skills' => array(),
            'message' =>  array()
        ];

        $data['skills'] = auth()->user()->skill()->get();
        $data['message'] = Messages::noElementsRegistered('Skill')['message'];

        return view('skill.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'icon' => 'image|required|max:50',
            'name' => 'required|string|min:4',
        ]);

        $request->file('icon')->store('public/images');
        $validated['icon'] =  $validated['icon']->hashName();

        auth()->user()->skill()->create($validated);

        return redirect(route('skill.index'));

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
    public function edit(Skill $skill):View
       {
        $this->authorize('update', $skill);

        return view('skill.edit',[
           'skill' => $skill
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:4',
        ]);

        if($request->hasFile('icon')){

            $validated = Validator::make(
                ['icon' => $request->file('icon')],
                ['icon' => 'image|required|max:50'],
                ['required' => 'The :attribute field is required'],
                )->validate();

                $validated['icon']->store('public/images');
                $validated['icon'] =  $validated['icon']->hashName();
                Storage::delete('public/images/'.$skill->icon);

        }

        $this->authorize('update', $skill);
        $skill->update($validated);
        return redirect(route('skill.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill): RedirectResponse    {

        $this->authorize('delete', $skill);
        Storage::delete('public/images/'.$skill->icon);
        $skill->delete();
        return redirect(route('skill.index'));
    }
}
