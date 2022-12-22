<?php

namespace App\Http\Controllers;
use DB;
use App\Models\mixtures;
use App\Models\products;
use App\Models\sections;
use App\Models\mixes;
use Illuminate\Http\Request;

class MixturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::all();
        $sections = sections::all();
        $mixtures = mixtures::all();
        $mixes = mixes::all();



        return view('depot.mixtures',compact('sections','mixes','products','mixtures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = products::all();
        $sections = sections::all();
        $mixtures = mixtures::all();
        $mixes = mixes::all();



        return view('depot.mixtures',compact('sections','mixes','products','mixtures'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {


        $product =  $request->product;
        $amount = $request->amount;
        $Section =  $request->Section;
        $Mix =  $request->Mix;



            for ($i=0; $i <=count($product)-1  ; $i++) {
                if (!($product[$i] == null)) {
                    $data = [
                        'product_id' => $product[$i],
                        'amount' => $amount[$i],
                        'section_id' => $Section,
                        'mix_id' => $Mix,

                    ];
                    //dd($data);

                    DB::table('mixtures')->insert([$data]);

                }







        }
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
                return redirect()->back();



    }
    public function getproducts($id)
    {
        $mixes = DB::table("mixes")->where("section_id", $id)->get();
        return json_encode($mixes);
    }
    public function getmixes($id)
    {
        $mixes = DB::table("mixtures")->where("mix_id", $id)->get();
        return json_encode($mixes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\mixtures  $mixtures
     * @return \Illuminate\Http\Response
     */
    public function show(mixtures $mixtures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\mixtures  $mixtures
     * @return \Illuminate\Http\Response
     */
    public function edit(mixtures $mixtures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\mixtures  $mixtures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mixtures $mixtures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\mixtures  $mixtures
     * @return \Illuminate\Http\Response
     */
    public function destroy(mixtures $mixtures)
    {
        //
    }
}
