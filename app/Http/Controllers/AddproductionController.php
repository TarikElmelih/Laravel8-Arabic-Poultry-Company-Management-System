<?php

namespace App\Http\Controllers;

use App\Models\addproduction;
use App\Models\sections;
use Illuminate\Http\Request;

class AddproductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        $addproduction = addproduction::all();
        return view('depot.addpro', compact('sections','addproduction'));
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


        addproduction::create([
            'amount' => $request->amount,
            'chAmount' => $request->amount,
            'production' => $request->production,
            'chproduction' => $request->production,
            'Waste' => $request->Waste,
            'feed' => $request->feed,
            'chfeed' => $request->feed,
            'section_id' => $request->section_id,
        ]);
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\addproduction  $addproduction
     * @return \Illuminate\Http\Response
     */
    public function show(addproduction $addproduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\addproduction  $addproduction
     * @return \Illuminate\Http\Response
     */
    public function edit(addproduction $addproduction)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\addproduction  $addproduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = sections::where('section_name', $request->section_name)->first()->id;

        $addproduction = addproduction::findOrFail($request->id);

        $addproduction->update([
        'section_id' => $id,
        'amount' => $request->amount,
        'production' => $request->production,
        'feed' => $request->feed,
        'Waste' => $request->Waste,
        ]);

        session()->flash('Edit', 'تم تعديل المنتج بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\addproduction  $addproduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(addproduction $addproduction)
    {
        $Products = Products::findOrFail($request->pro_id);
         $Products->delete();
         session()->flash('delete', 'تم حذف المنتج بنجاح');
         return back();
    }
}
