<?php

namespace App\Http\Controllers;

use App\Models\Manufacturings;
use App\Models\mixes;
use App\Models\mixtures;
use App\Models\products;
use App\Models\sections;
use App\Models\invoice_nums;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;

class ManufacturingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Auth::user()->name == 'admin') {

            $mixes = mixes::all();
            $invoice_nums = invoice_nums::with('manufacturing')->withsum('manufacturing','amount')->withmax('manufacturing','count')->withmax('manufacturing','mix_id')->get();


        }else{
            $mixes = mixes::where('section_id',  auth::user()->id - 1)->get();
            $invoice_nums = invoice_nums::where('section_id',  auth::user()->id - 1)->with('manufacturing')->withsum('manufacturing','amount')->withmax('manufacturing','count')->withmax('manufacturing','mix_id')->get();

        }


        return view('depot.manufacturings',compact('invoice_nums','mixes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mixtures = mixtures::all();
        $mixes = mixes::all();
        $sections = sections::where('section_name',auth::user()->name)->get();
        $mixes = mixes::all();
        return view('depot.addmanufacturing',compact('mixes','mixtures','sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mixture_Date = $request->out_Date;
        $Mix = $request->Mix;
        $Section = $request->Section;
        $count = $request->count;
        $amount = $request->amount;
        $pro_id = $request->pro_id;

        $data = [
            'section_id' => $Section,
            'mix_id' => $Mix,
            'mixture_Date' => $mixture_Date,
        ];

       DB::table('invoice_nums')->insert([$data]);
       $invoice_id = invoice_nums::latest('id')->first()->id;
        for ($i=0; $i <= count($pro_id) - 1  ; $i++) {



             $data = [
                 'section_id' => $Section,
                 'mixture_Date' => $mixture_Date,
                 'invoice_id' => $invoice_id,
                 'count' => $count,
                 'mix_id' => $Mix,
                 'product_id' => $pro_id[$i],
                 'amount' => $amount[$i],
             ];
            DB::table('Manufacturings')->insert([$data]);




    }
    session()->flash('Add', 'تم اضافة المنتج بنجاح ');
            return redirect()->back();



      //  echo $mixture_Date , $Mix , $Section, $count, $amount, $pro_id;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Manufacturings  $manufacturings
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturings $manufacturings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Manufacturings  $manufacturings
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturings $manufacturings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Manufacturings  $manufacturings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = sections::where('section_name', $request->section_name)->first()->id;

        $Manufacturings = Manufacturings::findOrFail($request->id);
        dd($request->amount);
        $Manufacturings->update([
            'section_id' => $id,
            'count' => $request->count,
            'amount' => $request->amount,
        ]);

        session()->flash('edit','تم تعديل القسم بنجاج');
        return redirect('/Manufacturings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Manufacturings  $manufacturings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $Manufacturings = invoice_nums::where('id',$id)->first();
        $Manufacturings->delete();
        session()->flash('delete','تم حذف القسم بنجاح');
        return redirect('/Manufacturings');
    }
}
