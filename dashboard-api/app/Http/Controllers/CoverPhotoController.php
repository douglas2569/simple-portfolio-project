<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CoverPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('coverphoto.index',
        [ 'coverPhotos'=> auth()->user()->about()->get()[0]->coverPhoto()->latest()->get()]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        if(count(auth()->user()->about()->get()[0]->coverPhoto()->get()) >= 2
            || !$request->hasFile('image'))
            return redirect('coverphoto.index');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
