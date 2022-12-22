<?php

namespace App\Http\Controllers;

use App\Models\sells;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->name == 'admin') {
            $sells = sells::all();
        }else{
            $sells = sells::where('section_id',  auth::user()->id - 1)->get();
        }

        $sections = sections::where('section_name',auth::user()->name)->get();

        return view('depot.sells',compact('sections','sells'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('depot.addsells', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        if ($request->hasFile('pic')) {


            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $number = $request->number;
            $section =  $request->Section;
            $currency = $request->currency;
            $price = $request->price;
            $production = $request->production;
            $box = $request->production / 12;
            $Weight = $request->Weight;
            $note = $request->note;

            $attachments = new sells();
            $attachments->file_name = $file_name;
            $attachments->number = $number;
            $attachments->section_id = $section;
            $attachments->price = $price;
            $attachments->production = $production;
            $attachments->box = $box;
            $attachments->Weight = $Weight;
            $attachments->note = $note;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $number), $imageName);
        }
        else{
            sells::create([
            'section_id' => $request->Section,
            'number' => $request->number,
            'production' => $request->production,
            'box' => $request->production /12,
            'price' => $request->price,
            'Weight' => $request->Weight,
            'name' => $request->name,
            'note' => $request->note,
            ]);
        }
        session()->flash('Add', 'تم اضافة المنتج بنجاح ');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sells  $sells
     * @return \Illuminate\Http\Response
     */
    public function show(sells $sells)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sells  $sells
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sells = sells::where('id', $id)->first();
        $sections = sections::all();
        return view('depot.edit_sells', compact('sections', 'sells'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sells  $sells
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $sells = sells::findOrFail($request->sells_id);


        $sells->update([
            'section_id' => $request->Section,
            'number' => $request->number,
            'production' => $request->production,
            'box' => $request->production /12,
            'price' => $request->price,
            'Weight' => $request->Weight,
            'name' => $request->name,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect('/sells');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sells  $sells
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sells = sells::where('id',$request->sells_id)->first();
        $sells->Delete();
        session()->flash('delete_sells');
        return redirect('/sells');
    }

    public function get_file($number,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($number.'/'.$file_name);
        return response()->download( $contents);
    }



    public function open_file($number,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($number.'/'.$file_name);
        return response()->file($files);
    }
}
