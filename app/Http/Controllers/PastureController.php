<?php

namespace App\Http\Controllers;

use App\Models\cattle;
use App\Models\pasture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PastureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pastures = pasture::withCount('cattles')->paginate(20);
        return view('adminlte::pastures.index', compact('pastures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminlte::pastures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pasture_data = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:pastures,name',
            'grass' => 'required|in:short,medium,long',
            'weather' => 'required|in:dry,hot,cool,noraml,windy,rainy',
            'temperature' => 'required|numeric',
            'bulls' => 'required|numeric|min:0',
            'cows' => 'required|numeric|min:0'
        ]);

        $pasture = pasture::create($pasture_data);

        if($pasture)
            return redirect(route('pastures.index'))->with('msg', "pasture created successfully");
    
        return redirect(route('pastures.index'))->with('error', "Failed to create pasture");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pasture  $pasture
     * @return \Illuminate\Http\Response
     */
    public function show(pasture $pasture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pasture  $pasture
     * @return \Illuminate\Http\Response
     */
    public function edit(pasture $pasture)
    {
        return view('adminlte::pastures.edit', compact('pasture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pasture  $pasture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pasture $pasture)
    {
        $pasture_data = $request->validate([
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('pastures')->ignore($pasture->id)
            ],
            'grass' => 'required|in:short,medium,long',
            'weather' => 'required|in:dry,hot,cool,noraml,windy,rainy',
            'temperature' => 'required|numeric',
            'bulls' => 'required|numeric|min:0',
            'cows' => 'required|numeric|min:0'
        ]);

        $updated = $pasture->update($pasture_data);

        if($updated)
            return redirect(route('pastures.index'))->with('msg', "Pasture $pasture->name updated successfully");
    
        return redirect(route('pastures.index'))->with('error', "Failed to update Pasture $pasture->name");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pasture  $pasture
     * @return \Illuminate\Http\Response
     */
    public function destroy(pasture $pasture)
    {
        if($pasture->cattles->count() > 0)
            return redirect()->back()->with('error', "Pasture $pasture->name has cattles. Please reassign them to other pasture first");
        
        $deleted = $pasture->delete();

        if($deleted)
            return redirect(route('pastures.index'))->with('msg', "Pasture $pasture->name deleted successfully");

        return redirect(route('pastures.index'))->with('error', "Failed to delete Pasture $pasture->name");
    }
}
