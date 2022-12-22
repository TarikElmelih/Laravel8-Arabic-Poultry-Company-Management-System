<?php

namespace App\Http\Controllers;


use App\Models\mixDetails;
use App\Models\sections;
use App\Models\products;
use App\Models\mixes;
use App\Models\mixtures;
use App\Models\manufacturingDetails;
use App\Models\manufacturings;
use App\Models\invoice_nums;
use Illuminate\Http\Request;

class ManufacturingDetailsController extends Controller
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
     * @param  \App\Models\manufacturingDetails  $manufacturingDetails
     * @return \Illuminate\Http\Response
     */
    public function show(manufacturingDetails $manufacturingDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\manufacturingDetails  $manufacturingDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id,manufacturingDetails $manufacturingDetails)
    {


        $manufacturings = manufacturings::where('invoice_id',$id)->get();
        $products = products::all();
        $invoice_id = invoice_nums::where('id',$id)->get();
        $manufacturingsum  = manufacturings::where('invoice_id',$id)->sum('amount');


        return view('depot.manufacturingDetails', compact('invoice_id','manufacturingsum','products','manufacturings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\manufacturingDetails  $manufacturingDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, manufacturingDetails $manufacturingDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\manufacturingDetails  $manufacturingDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(manufacturingDetails $manufacturingDetails)
    {
        //
    }
}
