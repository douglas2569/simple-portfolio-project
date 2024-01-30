<?php

namespace App\Http\Controllers;

use App\Exceptions\NoElementsRegisteredException;
use App\Helpers\Messages;
use App\Models\Technology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class technologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index():View
    {
        $data = [
            'technologies' => array(),
            'message' =>  array(),
        ];

        try {
            $data['technologies'] = auth()->user()->technology()->get();
            if(count($data['technologies']) <= 0)
                throw new NoElementsRegisteredException();

        }catch (NoElementsRegisteredException $th) {
            $data['message'] = Messages::noElementsRegistered('technology')['message'];
        }

        return view('technology.index', $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request):RedirectResponse
    {
        $validated = $request->validate([
            'color' => 'required|string|min:2',
            'name' => 'required|string|min:2',
        ]);

        auth()->user()->technology()->create($validated);

        return redirect(route('technology.index'));

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
    public function edit(Technology $technology):View
       {
        $this->authorize('update', $technology);

        return view('technology.edit',[
           'technology' => $technology
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technology $technology):RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2',
            'color' => 'required|string|min:2',
        ]);

        $this->authorize('update', $technology);
        $technology->update($validated);
        return redirect(route('technology.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology): RedirectResponse    {

        $this->authorize('delete', $technology);
        $technology->delete();
        return redirect(route('technology.index'));
    }
}
