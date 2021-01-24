<?php

namespace App\Http\Controllers;

use App\Models\cattle;
use App\Models\pasture;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CattleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cattles = cattle::with(['pasture' => function($q) {
            $q->select('name');
        }])->paginate(20);
        $pastures = pasture::count();
        return view('adminlte::cattles.index', compact('cattles', 'pastures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pastures = pasture::all();

        return view('adminlte::cattles.create', compact('pastures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cattle_data = $request->validate([
            'gender' => 'required|in:bull,cow',
            'pasture_id' => 'required|exists:pastures,id',
            'age' => 'required|numeric|min:1',
            'color' => 'required|string|min:2|max:255',
            'weight' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1'
        ]);        

        $gender = $cattle_data['gender'].'s';
        $pasture = pasture::find($cattle_data['pasture_id']);
        unset($cattle_data['pasture_id']);

        $max_cattle_in_pasture = $pasture->$gender;
        $cattle_in_pasture = $pasture->cattles->count();

        if ($cattle_in_pasture === $max_cattle_in_pasture) {
            return redirect()
                ->back()
                ->withInput($request->input())
                ->with('error', 'The selected Pasture has already max number of '.$gender);
        }
        $serial = 'CF-'.str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        while(cattle::where('serial', '=', $serial)->exists())
        {
            $serial = 'CF-'.str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        }
        $cattle_data['serial'] = $serial;        

        $created = cattle::create($cattle_data);        

        if($created)
        {
            $pasture->cattles()->attach($created->id);
            return redirect(route('cattles.index'))->with('msg', 'Cattle created successfully');
        }
    
        return redirect(route('cattles.index'))->with('error', 'Failed to create Cattle');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cattle  $cattle
     * @return \Illuminate\Http\Response
     */
    public function show(cattle $cattle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cattle  $cattle
     * @return \Illuminate\Http\Response
     */
    public function edit(cattle $cattle)
    {
        $pastures = pasture::all('id', 'name');

        return view('adminlte::cattles.edit', compact('cattle', 'pastures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cattle  $cattle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cattle $cattle)
    {
        $cattle_data = $request->validate([
            'gender' => 'required|in:bull,cow',
            'pasture_id' => 'required|exists:pastures,id',
            'age' => 'required|numeric|min:1',
            'color' => 'required|string|min:2|max:255',
            'weight' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1'
        ]);
        if($cattle->pasture[0]->id !== intval($cattle_data['pasture_id']))
        {
            $cattle->pasture()->detach($cattle->pasture[0]->id);
            $pasture = pasture::find($cattle_data['pasture_id']);
            $pasture->cattles()->attach($cattle->id);
        }
        unset($cattle_data['pasture_id']);
        $updated = $cattle->update($cattle_data);

        if($updated)
            return redirect(route('cattles.index'))->with('msg', "Cattle $cattle->serial updated successfully");
    
        return redirect(route('cattles.index'))->with('error', "Failed to update Cattle $cattle->serial");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cattle  $cattle
     * @return \Illuminate\Http\Response
     */
    public function destroy(cattle $cattle)
    {
        $cattle->pasture()->detach($cattle->pasture[0]->id);
        $deleted = $cattle->delete();

        if($deleted)
            return redirect(route('cattles.index'))->with('msg', "Cattle $cattle->serial deleted successfully");

        return redirect(route('cattles.index'))->with('error', "Failed to delete Cattle $cattle->serial");
    }
}
