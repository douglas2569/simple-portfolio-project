<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View | RedirectResponse
    {
        $about = auth()->user()->about()->get();

        if(count($about) > 0)
            return redirect(route('about.edit',$about[0]));
        else
            return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
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

        $request->file('profilePhoto')->store('public/images');
        $validated['profile_photo'] =  $validated['profilePhoto']->hashName();

        $about = $request->user()->about()->create($validated);

        return redirect(route('about.edit',['about'=> $about]));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about): View
    {
        return view('about.edit', [
            'about' => $about,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'description' => 'required|string|min:20',
        ]);

        if ($request->hasFile('profilePhoto')) {
            array_push($validated, Validator::make(
                ['profile_photo' => $request->file('profilePhoto')],
                ['profile_photo' => 'image|max:100'],
                ['required' => 'The :attribute field is required'],
                )->validate());

                $validated[0]['profile_photo']->store('public/images');
                $validated['profile_photo'] =  $validated[0]['profile_photo']->hashName();
                Storage::delete('public/images/'.$about->profile_photo);
            }

            $this->authorize('update', $about);
            $about->update($validated);

        return redirect(route('about.create'));
    }

}
