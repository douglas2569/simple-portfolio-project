<?php

namespace App\Http\Controllers;

use App\Exceptions\NoElementsRegisteredException;
use App\Exceptions\ParentElementIsMissingException;
use App\Helpers\Messages;
use App\Models\Skill;
use App\Models\SkillTechnology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'message' =>  array(),
            'technologies'=> array(),
        ];

        try {
            $data['technologies'] = auth()->user()->technology()->get();
            if(count($data['technologies']) <= 0)
                throw new ParentElementIsMissingException();

            $data['skills'] = auth()->user()->skill()->get();
            if(count($data['skills']) <= 0)
                throw new NoElementsRegisteredException();

        } catch (ParentElementIsMissingException $th) {
            $data['message'] = Messages::parentElementIsMissing('Technology')['message'];
        }catch (NoElementsRegisteredException $th) {
            $data['message'] = Messages::noElementsRegistered('Skill')['message'];
        }

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
            'technologiesIds' => 'required',
        ]);

        $request->file('icon')->store('public/images');
        $validated['icon'] =  $validated['icon']->hashName();

        try {
            DB::beginTransaction();

            auth()->user()->skill()->create($validated);

            $lastSkillId = (auth()->user()->skill()->latest()->get())[0]->id;
            foreach($validated['technologiesIds'] as $technologyId){
                SkillTechnology::create(['skill_id'=>$lastSkillId, 'technology_id'=>$technologyId]);
            }

            DB::commit();
        } catch (\Exception $th) {
            echo $th->getMessage();
            DB::rollBack();
        }
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

        $myTechnologies = SkillTechnology::where('skill_id', $skill->id)->get();
        $myTechnologiesIds = array();
        foreach($myTechnologies as $myTechnology){
            array_push($myTechnologiesIds ,  $myTechnology->technology_id);
        }

        $data = [
            'skill' => $skill,
            'technologies'=> auth()->user()->technology()->get(),
            'myTechnologies'=> $myTechnologiesIds,
        ];

        return view('skill.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Skill $skill):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:4',
            'technologiesIds' => 'required',
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

        try {
            DB::beginTransaction();

            $this->authorize('update', $skill);
            $skill->update($validated);
            if(count($validated['technologiesIds']) > 0){
                SkillTechnology::where(['skill_id'=>$skill->id])->delete();

                foreach($validated['technologiesIds'] as $technologyId){
                    SkillTechnology::create(['skill_id'=>$skill->id, 'technology_id'=>$technologyId]);
                }
            }

            DB::commit();
         } catch (\Exception $th) {
            echo $th->getMessage();
            DB::rollBack();
        }


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
