<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExpensesController extends Controller
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
            $Expenses = Expenses::all();
        }else{
            $Expenses = Expenses::where('section_id',  auth::user()->id - 1)->get();
        }

        return view('depot.Expenses',compact('sections','Expenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::where('section_name',auth::user()->name)->get();
        return view('depot.addExpense', compact('sections'));
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
            $note = $request->note;

            $attachments = new Expenses();
            $attachments->file_name = $file_name;
            $attachments->number = $number;
            $attachments->section_id = $section;
            $attachments->currency = $currency;
            $attachments->price = $price;
            $attachments->note = $note;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $number), $imageName);
        }
        else{
            Expenses::create([
                'section_id' => $request->Section,
                'number' => $request->number,
                'price' => $request->price,
                'currency' => $request->currency,
                'note' => $request->note,
            ]);
        }

        session()->flash('Add', 'تم اضافة المصروف بنجاح ');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Expenses = Expenses::where('id', $id)->first();
        $sections = sections::all();
        return view('depot.edit_Expenses', compact('sections', 'Expenses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Expenses = Expenses::findOrFail($request->Expenses_id);


        $Expenses->update([
            'section_id' => $request->Section,
            'price' => $request->price,
            'currency' => $request->currency,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'تم تعديل الفاتورة بنجاح');
        return redirect('/Expenses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $Expenses = Expenses::where('id',$request->Expenses_id)->first();
        $Expenses->Delete();
        session()->flash('delete_Expenses');
        return redirect('/Expenses');
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
