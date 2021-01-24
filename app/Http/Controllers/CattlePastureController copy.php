<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\pasture;
use App\Models\cattle;
use App\Models\CattlePasture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CattlePastureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = [];
        // $dates = Carbon::now()->subDays(30)->daysUntil(Carbon::now());
        // foreach($dates as $date)
        // {
            $day = '2021-01-23';
            // $day = $date->isoFormat('Y/M/D');
            $records[] = DB::table('reports')->select(
                    'reports.day',
                    'reports.pasture_id',
                    // 'pastures.name',
                    DB::raw('COUNT(reports.cattle_id) as cattles_count')
                )
                // ->join('pastures', 'pastures.id', '=', 'reports.pasture_id')
                ->where('day', '=', $day)
                ->get();
        // }
        dd($records);
        $pastures = pasture::count();
        
        return view('adminlte::reports.index', compact('records', 'pastures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pastures = pasture::all();
        $cattles = cattle::all();

        return view('adminlte::reports.create', compact('pastures', 'cattles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pasture_id' => 'required|exists:pastures,id',
            'cattle_ids' => 'required|array',
            'cattle_ids.*' => 'exists:cattles,id'
        ]);
        
        $ids = $data['cattle_ids'];
        $data['day'] = Carbon::now()->isoFormat('Y/M/D');
        unset($data['cattle_ids']);
        
        foreach($ids as $id)
        {
            $data['cattle_id'] = $id;

            if(report::where([['day', '=', $data['day']],['cattle_id', '=', $id]])->exists())        
            {
                Session::flash('error', 'Cattle '.cattle::find($id)->serial.' already assigned today'); 
                continue;
            }    
            
            $created = report::create($data);
            if($created)
                Session::flash('msg', 'Report created successfully');
            else
                Session::flash('error', 'Failed to created report for '.cattle::find($id)->serial);
        }

        return redirect(route('reports.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(report $report)
    {
        return view('adminlte::reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(report $report)
    {
        //
    }
}
