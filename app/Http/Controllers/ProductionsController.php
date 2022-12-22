<?php

namespace App\Http\Controllers;

use App\Models\productions;
use App\Models\addproduction;
use App\Models\sections;
use App\Models\products;
use App\Models\outgoings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ProductionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        if (Auth::user()->name == 'admin') {
            $productions = productions::all();
        }else{
            $productions = productions::where('section_id',  auth::user()->id - 1)->get();
        }

        $productions11 = productions::whereMonth('created_at', date('m'))->latest()
        ->first();


        return view('depot.productions' ,compact('productions11','sections','productions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('depot.addProduction', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $chicken0 = addproduction::where('section_id', $request->Section)->first()->amount;
        $chicken = addproduction::where('section_id', $request->Section)->first()->amount - $request->death;
        $chAmount = addproduction::where('section_id', $request->Section)->first()->chAmount;
        //////////////////////////////////////////////////
        $feed0 = addproduction::where('section_id', $request->Section)->first()->feed;
        $feed = addproduction::where('section_id', $request->Section)->first()->feed + $request->feed;
        $chfeed = addproduction::where('section_id', $request->Section)->first()->chfeed;
        /////////////////////////////////////////////////
        /////////////////////////////////////////////////
        $production0 = addproduction::where('section_id', $request->Section)->first()->production;
        $production = addproduction::where('section_id', $request->Section)->first()->production + $request->production - $request->sold - $request->debris;
        $chproduction = addproduction::where('section_id', $request->Section)->first()->chproduction;
        ////////////////////////////////////////////////
        $product = addproduction::where('section_id', $request->Section)->first()->id;

        DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['amount' =>$chicken]);

        DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['feed' =>$feed]);

        DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['production' => $production]);


        productions::create([
            'pro_number' => $request->pro_number,
            'pro_Date' => $request->pro_Date,
            'section_id' => $request->Section,
            'product_id' => $product ,
            'production' => $request->production,
            'Percentage' => (($request->production * 30 +  $request->debris *30) /$chicken ) * 100,
            'death_store' => $chicken,
            'ch_store' => $chicken0,
            'debris' => $request->debris,
            'sold' => $request->sold,
            'death' => $request->death,
            'feed' => $request->feed,
            'feed_store' =>$feed,
            'debris_store' =>$production,
            'Waste' => $request->Waste,
            'note' => $request->note,
        ]);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\productions  $productions
     * @return \Illuminate\Http\Response
     */
    public function show(productions $productions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\productions  $productions
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productions = productions::where('id', $id)->first();
        $sections = sections::all();
        return view('depot.edit_production', compact('sections', 'productions'));
    }


    public function update(Request $request)
    {
        $productions = productions::findOrFail($request->productions_id);


        $chicken0 = addproduction::where('section_id', $request->Section)->first()->amount;
        $chicken = addproduction::where('section_id', $request->Section)->first()->amount - $request->death;
        $chAmount = addproduction::where('section_id', $request->Section)->first()->chAmount;
        //////////////////////////////////////////////////
        $feed0 = addproduction::where('section_id', $request->Section)->first()->feed;
        $feed = addproduction::where('section_id', $request->Section)->first()->feed + $request->feed;
        $chfeed = addproduction::where('section_id', $request->Section)->first()->chfeed;
        /////////////////////////////////////////////////
        //////////////////////////////////////////////////
        $production0 = addproduction::where('section_id', $request->Section)->first()->production;
        $production = addproduction::where('section_id', $request->Section)->first()->chproduction + $request->production - $request->sold;
        $chproduction = addproduction::where('section_id', $request->Section)->first()->chproduction;
        /////////////////////////////////////////////////
        $product = addproduction::where('section_id', $request->Section)->first()->id;

        DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['amount' =>$chicken]);

        DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['feed' =>$feed]);

        DB::table('addproductions')
        ->where('section_id', $request->Section)
        ->update(['production' => $production]);


        $productions->update([
            'pro_number' => $request->pro_number,
            'pro_Date' => $request->pro_Date,
            'section_id' => $request->Section,
            'product_id' => $product ,
            'production' => $request->production,
            'Percentage' => (($request->production * 30 +  $request->debris *30) /$chicken ) * 100,
            'death_store' => $chicken,
            'ch_store' => $chicken0,
            'debris' => $request->debris,
            'sold' => $request->sold,
            'death' => $request->death,
            'feed' => $request->feed,
            'feed_store' =>$feed,
            'debris_store' =>$production,
            'Waste' => $request->Waste,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect('/productions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\productions  $productions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $productions = productions::where('id',$request->productions_id)->first();
        $productions->Delete();
        session()->flash('delete_productions');
        return redirect('/productions');
    }
}
