<?php

namespace App\Http\Controllers;


use App\Models\products;
use App\Models\productions;
use App\Models\sections;
use App\Models\outgoings;
use App\Models\mixes;
use App\Models\incomings;
use App\Models\invoice_nums;
use App\Models\manufacturings;
use App\Models\sells;
use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;
use App\Models\sectionDetails;


class SectionDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\sectionDetails  $sectionDetails
     * @return \Illuminate\Http\Response
     */
    public function show(sectionDetails $sectionDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sectionDetails  $sectionDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {

        $products  = products::where('section_id',$id)->withsum('outgoing','amount')->withsum('incoming','amount')->withsum('manufacturing','amount')->get();
        $outgoings  = outgoings::where('section_id',$id)->get();
        $productions  = productions::where('section_id',$id)->get();
        $incomings  = incomings::where('section_id',$id)->get();
        $sells  = sells::where('section_id',$id)->get();
        $Expenses  = Expenses::where('section_id',$id)->get();
        $mixes  = mixes::where('section_id',$id)->get();
        $invoice_nums = invoice_nums::where('section_id',$id)->get();
        $manufacturings  = manufacturings::where('section_id',$id)->get();
        $outsum = outgoings::where('section_id',$id )->sum('amount');
        $insum = incomings::where('section_id',$id )->sum('amount');
        $sections = sections::where('id',$id)->first();




        return view('sections.sectionDetails',
        compact('productions','Expenses','sells','mixes','invoice_nums','manufacturings','insum','outsum','sections','products','outgoings','incomings'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sectionDetails  $sectionDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sectionDetails $sectionDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sectionDetails  $sectionDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(sectionDetails $sectionDetails)
    {
        //
    }
}
