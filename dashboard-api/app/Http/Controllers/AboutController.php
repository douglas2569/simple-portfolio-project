<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        return view('about.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('profilePhoto')) {
            return redirect(route('about.index',[]));
        }

        $validated = $request->validate([
            'profilePhoto' => 'image|required|max:100',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'description' => 'required|string|min:20',
        ]);

        $validated['profile_photo'] =  $request->file('profilePhoto')?->store('public/images');
        $validated['profile_photo'] =  $validated['profilePhoto']?->hashName();

        $request->user()->about()->create($validated);

        return redirect(route('about.index'));
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
