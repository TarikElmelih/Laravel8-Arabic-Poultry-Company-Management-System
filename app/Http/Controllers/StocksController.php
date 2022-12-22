<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\user;


use App\Models\stocks;
use Illuminate\Http\Request;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stocks = stocks::all();
        return view('depot.stock',compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'substance_name' => 'required|unique:stocks|max:255',
        ],[

            'substance_name.required' =>'يرجي ادخال اسم المادة',
            'substance_name.unique' =>'اسم المادة مسجل مسبقا',


        ]);

            stocks::create([
                'substance_name' => $request->substance_name,
                'substance_amount' => $request->substance_amount,
                'description' => $request->description,
                'Created_by' => (Auth::user()->name),

            ]);


            session()->flash('Add', 'تم اضافة المادة بنجاح ');
            return redirect('/stock');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function show(stocks $stocks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function edit(stocks $stocks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, stocks $stocks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\stocks  $stocks
     * @return \Illuminate\Http\Response
     */
    public function destroy(stocks $stocks)
    {
        //
    }
}
