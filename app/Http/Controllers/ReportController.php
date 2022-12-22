<?php

namespace App\Http\Controllers;

use App\Models\report;
use App\Models\sections;
use App\Models\productions;
use App\Models\addproduction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view('depot.report',compact('sections')) ;
    }




    public function search(Request $request)
    {



       $start_at = date($request->start_at);
       $end_at = date($request->end_at);

      $productionsum = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->sum('production');
      $productions = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->get();
      $sold = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->sum('sold');
      $Waste = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->sum('Waste');
      $feed = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->sum('feed');
      $sections = sections::all();
      $death = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->sum('death');
      $chfeed = addproduction::where('section_id', $request->Section)->first()->chfeed;
      $production = addproduction::where('section_id', $request->Section)->first()->chproduction;
      $chamount = addproduction::where('section_id', $request->Section)->first()->chAmount;
      $amount = addproduction::where('section_id', $request->Section)->first()->amount;
      $still = $request->still;
      $d =  Carbon::createFromFormat('Y-m-d', $end_at)->locale('fr_FR')->format('d');


      $Percentage = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->sum('Percentage');
        report::create([
            'amount' => $chamount,
            'production' => $production,
            'feed' =>$chfeed,
            'section_id' => $request->Section,
        ]);

      DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['chfeed' =>$request->still]);

      DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['feed' =>$request->still]);

      DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['production' =>$production]);

      DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['chamount' =>$amount]);


        $report = report::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->latest()->first();
        $days = productions::whereBetween('Created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->latest()->first();

       return view('depot.report',compact('Percentage','still','feed','Waste','death','chamount','d','amount','sections','productionsum','report','productions','sold'));



    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(report $report)
    {
        //
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
