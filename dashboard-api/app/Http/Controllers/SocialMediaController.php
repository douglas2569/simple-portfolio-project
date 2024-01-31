<?php

namespace App\Http\Controllers;

use App\Models\socialmedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Helpers\Messages;
use App\Exceptions\NoElementsRegisteredException;
use App\Exceptions\ParentElementIsMissingException;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $data = [
            'about' => array(),
            'socialmedia' => array(),
            'message' => array(),
        ];

        try {
            $data['about'] = auth()->user()->about()->get();

            $data['socialmedia'] = auth()->user()->about()->get()[0]->socialmedia()->latest()->get();
            if(count($data['socialmedia']) <= 0)
                throw new NoElementsRegisteredException();

        } catch (\ErrorException $th) {
            $data['message'] = Messages::parentElementIsMissing('About')['message'];
        }catch (NoElementsRegisteredException $th) {
            $data['message'] = Messages::noElementsRegistered('Social Media')['message'];
        }

        return view('socialmedia.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse {

        $validated = $request->validate([
            'icon' => 'image|required|max:50',
            'name' => 'required|string|min:4',
            'url' => 'required|string|min:2',
        ]);

        $request->file('icon')->store('public/images');
        $validated['icon'] =  $validated['icon']->hashName();

        auth()->user()->about()->get()[0]->socialmedia()->create($validated);

        return redirect(route('socialmedia.index'));

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
    public function edit(socialmedia $socialmedia):View
       {
        $this->authorize('update', $socialmedia);

        return view('socialmedia.edit',[
           'socialmedia' => $socialmedia
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, socialmedia $socialmedia):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:4',
            'url' => 'required|string|min:2',
        ]);

        if($request->hasFile('icon')){

            array_push($validated, Validator::make(
                ['icon' => $request->file('icon')],
                ['icon' => 'image|required|max:50'],
                ['required' => 'The :attribute field is required'],
                )->validate());

                $validated[0]['icon']->store('public/images');
                $validated['icon'] =  $validated[0]['icon']->hashName();
                Storage::delete('public/images/'.$socialmedia->icon);

        }

        $this->authorize('update', $socialmedia);
        $socialmedia->update($validated);
        return redirect(route('socialmedia.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(socialmedia $socialmedia): RedirectResponse
    {

        $this->authorize('delete', $socialmedia);
        Storage::delete('public/images/'.$socialmedia->icon);
        $socialmedia->delete();
        return redirect(route('socialmedia.index'));
    }
}
