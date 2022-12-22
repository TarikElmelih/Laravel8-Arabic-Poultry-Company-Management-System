<?php

namespace App\Http\Controllers;

use App\Models\sections;
use App\Models\products;
use App\Models\mixes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MixesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mixes = mixes::all();
        $sections = sections::all();
        return view('depot.mixes',compact('mixes','sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        if (Auth::user()->name == 'admin') {
            $products = products::all();
            $mixes = mixes::all();
        }else{
            $products = products::where('section_id',  auth::user()->id - 1)->get();
            $mixes = mixes::where('section_id',  auth::user()->id + 1)->get();
        }


        return view('depot.add_mixture',compact('mixes','products','sections'));

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
            'mix_name' => 'required|unique:mixes|max:255',
        ],[

            'mix_name.required' =>'يرجي ادخال اسم الخلطة',
            'mix_name.unique' =>'اسم الخلطة مسجل مسبقا',


        ]);

                mixes::create([
                'mix_name' => $request->mix_name,
                'section_id' => $request->section_id,
                'description' => $request->description,
                'Created_by' => (Auth::user()->name),

            ]);
            session()->flash('Add', 'تم تعريف خلطة بنجاح ');
            return redirect('/mixes');

        }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */

    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'mix_name' => 'required|max:255|unique:mixes,mix_name,'.$id,
            'description' => 'required',
        ],[

            'mix_name.required' =>'يرجي ادخال اسم الخلطة',
            'mix_name.unique' =>'اسم القسم مسجل مسبقا',
            'description.required' =>'يرجي ادخال البيان',

        ]);

        $mixes = mixes::find($id);
        $mixes->update([
            'mix_name' => $request->mix_name,
            'section_id' => $request->section_id,
            'description' => $request->description,
        ]);

        session()->flash('edit','تم تعديل الخلطة بنجاج');
        return redirect('/mixes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        mixes::find($id)->delete();
        session()->flash('delete','تم حذف الخلطة بنجاح');
        return redirect('/mixes');
    }
}
