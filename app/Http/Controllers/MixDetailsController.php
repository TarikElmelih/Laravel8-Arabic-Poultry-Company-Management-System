<?php

namespace App\Http\Controllers;

use App\Models\mixDetails;
use App\Models\sections;
use App\Models\products;
use App\Models\mixes;
use App\Models\mixtures;
use Illuminate\Http\Request;

class MixDetailsController extends Controller
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
     * @param  \App\Models\mixDetails  $mixDetails
     * @return \Illuminate\Http\Response
     */
    public function show(mixDetails $mixDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mixDetails  $mixDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id,mixDetails $mixDetails)
    {
        $mixes = mixes::where('id',$id)->first();
        $sections = mixes::where('id',$id)->first();
        $mixtures = mixtures::where('mix_id',$id)->get();
        $products = products::all();
        $mixturesum  = mixtures::where('mix_id',$id)->sum('amount');


        return view('depot.mixDetails', compact('mixturesum','sections','mixes','products','mixtures'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mixDetails  $mixDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $mixtures = mixtures::findOrFail($request->mixtures_id);


        $mixtures->update([
                'out_number' => $request->out_number,
                'out_Date' => $request->out_Date,
                'product' => $request->product,
                'product_id' => $request->product,
                'section_id' => $request->Section,
                'price' => $request->price,
                'amount' => $request->amount,
                'received' => $request->received,
                'file_name' => $request->pic,
                'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect('/mixtures');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mixDetails  $mixDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(mixDetails $mixDetails)
    {
        //
    }
}
