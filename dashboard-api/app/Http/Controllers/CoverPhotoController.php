<?php

namespace App\Http\Controllers;

use App\Models\CoverPhoto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class CoverPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('coverphoto.index',
        [ 'coverphotos'=> auth()->user()->about()->get()[0]->coverPhoto()->latest()->get()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        if(count(auth()->user()->about()->get()[0]->coverPhoto()->get()) >= 2
            || !$request->hasFile('image'))
            return redirect(route('coverphoto.index'));

            $validated = $request->validate([
                'image' => 'image|required|max:1024',
                'name' => 'required|string|min:4',
                'size' => 'required|string|min:2',
            ]);

            $request->file('image')->store('public/images');
            $validated['image'] =  $validated['image']->hashName();

            auth()->user()->about()->get()[0]->coverPhoto()->create($validated);

            return redirect(route('coverphoto.index'));

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
    public function edit(CoverPhoto $coverphoto):View
       {
        $this->authorize('update', $coverphoto);

        return view('coverphoto.edit',[
           'coverphoto' => $coverphoto
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoverPhoto $coverphoto):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:4',
            'size' => 'required|string|min:2',
        ]);

        if($request->hasFile('image')){

            $validated = Validator::make(
                ['image' => $request->file('image')],
                ['image' => 'image|required|max:1024'],
                ['required' => 'The :attribute field is required'],
                )->validate();

                $validated['image']->store('public/images');
                $validated['image'] =  $validated['image']->hashName();
                Storage::delete('public/images/'.$coverphoto->image);

        }

        $this->authorize('update', $coverphoto);
        $coverphoto->update($validated);
        return redirect(route('coverphoto.index'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoverPhoto $coverphoto): RedirectResponse
    {

        $this->authorize('delete', $coverphoto);
        Storage::delete('public/images/'.$coverphoto->image);
        $coverphoto->delete();
        return redirect(route('coverphoto.index'));
    }
}
