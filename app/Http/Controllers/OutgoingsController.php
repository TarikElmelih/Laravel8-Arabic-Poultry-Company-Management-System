<?php

namespace App\Http\Controllers;

use App\Models\outgoings;
use App\Models\sections;
use App\Models\user;
use App\Models\warehouse;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OutgoingsController extends Controller
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
            $outgoings = outgoings::all();
        }else{
            $outgoings = outgoings::where('section_id',  auth::user()->id - 1)->get();
        }

        //$outgo = outgoings::where('section_id',1 )->sum('amount');    هاد للمستودع
        //$proout  = products::where('depot','الصادر')->get('product_amount');

        return view('depot.outgoings' ,compact('sections','outgoings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::where('section_name',auth::user()->name)->get();

        return view('depot.addOut', compact('sections'));

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
            $out_number = $request->out_number;
            $product = $request->product;
            $section =  $request->Section;
            $amount =  $request->amount;
            $received =  $request->received;
            $note =  $request->note;
            $price =  $request->price;
            $out_Date =  $request->out_Date;
            $product_id =  $request->product;

            $attachments = new outgoings();
            $attachments->file_name = $file_name;
            $attachments->out_number = $out_number;
            $attachments->product = $product;
            $attachments->section_id = $section;
            $attachments->amount = $amount;
            $attachments->received = $received;
            $attachments->note = $note;
            $attachments->price = $price;
            $attachments->out_Date = $out_Date;
            $attachments->product_id = $product;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $out_number), $imageName);
        }
        else{
            outgoings::create([
                'out_number' => $request->out_number,
                'out_Date' => $request->out_Date,
                'product' => $request->product,
                'product_id' => $request->product,
                'section_id' => $request->Section,
                'price' => $request->price,
                'amount' => $request->amount,
                'received' => $request->received,
                'note' => $request->note,
            ]);
        }



  /*      $proout  = products::where('section_id',$request->Section)->where('depot','الصادر')->latest()->first()->product_amount;

        if ($proout >= $request->amount) {
            DB::table('products')
            ->where('section_id', $request->Section)
            ->where('Product_name',$request->product)
            ->update(['product_amount' =>$proout - $request->amount]);
             return redirect()->back();
        }
        else {
            session()->flash('Add', 'لا يوجد رصيد كافي');

        }
        */
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\outgoings  $outgoings
     * @return \Illuminate\Http\Response
     */
    public function show(outgoings $outgoings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\outgoings  $outgoings
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outgoings = outgoings::where('id', $id)->first();
        $sections = sections::all();
        return view('depot.edit_out', compact('sections', 'outgoings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\outgoings  $outgoings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $outgoings = outgoings::findOrFail($request->outgoings_id);


        $outgoings->update([
                'out_number' => $request->out_number,
                'out_Date' => $request->out_Date,
                'product' => $request->product,
                'product_id' => $request->product,
                'section_id' => $request->Section,
                'price' => $request->price,
                'amount' => $request->amount,
                'received' => $request->received,
                'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect('/outgoings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\outgoings  $outgoings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $outgoings = outgoings::where('id',$request->outgoings_id)->first();
        $outgoings->Delete();
        session()->flash('delete_outgoings');
        return redirect('/outgoings');
    }

    public function get_file($out_number,$file_name)

    {
        $contents= Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($out_number.'/'.$file_name);
        return response()->download( $contents);
    }



    public function open_file($out_number,$file_name)

    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($out_number.'/'.$file_name);
        return response()->file($files);
    }
}
