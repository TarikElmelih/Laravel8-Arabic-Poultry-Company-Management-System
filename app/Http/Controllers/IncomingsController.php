<?php

namespace App\Http\Controllers;

use App\Models\incomings;
use App\Models\sections;
use App\Models\warehouse;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class incomingsController extends Controller
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
            $incomings = incomings::all();
        }else{
            $incomings = incomings::where('section_id',  auth::user()->id - 1)->get();
        }

        return view('depot.incomings' ,compact('sections','incomings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::where('section_name',auth::user()->name)->get();
        return view('depot.addIn', compact('sections'));

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
            $source =  $request->source;
            $note =  $request->note;
            $price =  $request->price;
            $out_Date =  $request->out_Date;
            $product_id =  $request->product_id;

            $attachments = new incomings();
            $attachments->file_name = $file_name;
            $attachments->out_number = $out_number;
            $attachments->product = $product;
            $attachments->section_id = $section;
            $attachments->amount = $amount;
            $attachments->source = $source;
            $attachments->note = $note;
            $attachments->price = $price;
            $attachments->out_Date = $out_Date;
            $attachments->product = $product;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $out_number), $imageName);
        }
        else{
            incomings::create([
                'out_number' => $request->out_number,
                'out_Date' => $request->out_Date,
                'product' => $request->product,
                'product_id' => $request->product,
                'section_id' => $request->Section,
                'price' => $request->price,
                'amount' => $request->amount,
                'source' => $request->source,
                'note' => $request->note,
            ]);
        }
      /*  $proout  = products::where('section_id',$request->Section)->where('depot','الوارد')->latest()->first()->product_amount;


            DB::table('products')
            ->where('section_id', $request->Section)
            ->where('Product_name',$request->product)
            ->update(['product_amount' =>$proout + $request->amount]);
             return redirect()->back();


*/
            return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\incomings  $incomings
     * @return \Illuminate\Http\Response
     */
    public function show(incomings $incomings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\incomings  $incomings
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $incomings = incomings::where('id', $id)->first();
        $sections = sections::all();
        return view('depot.edit_in', compact('sections', 'incomings'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\incomings  $incomings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, incomings $incomings)
    {
        $incomings = incomings::findOrFail($request->incomings_id);


        $incomings->update([
                'out_number' => $request->out_number,
                'out_Date' => $request->out_Date,
                'product' => $request->product,
                'product_id' => $request->product,
                'section_id' => $request->Section,
                'price' => $request->price,
                'amount' => $request->amount,
                'source' => $request->source,
                'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect('/incomings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\incomings  $incomings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $incomings = incomings::where('id',$request->incomings_id)->first();
        $incomings->Delete();
        session()->flash('delete_incomings');
        return redirect('/incomings');
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
