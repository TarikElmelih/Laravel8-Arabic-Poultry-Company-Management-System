<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sections;
use App\Models\incomings;
class incoming_Report extends Controller
{
    public function index(){

      $sections = sections::all();
      return view('reports.incoming_report',compact('sections'));

    }


    public function Search_customers(Request $request){


// في حالة البحث بدون التاريخ

     if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


      $incomings = incomings::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
      $sections = sections::all();
       return view('reports.customers_report',compact('sections'))->withDetails($incomings);


     }


  // في حالة البحث بتاريخ

     else {

       $start_at = date($request->start_at);
       $end_at = date($request->end_at);

      $incomings = incomings::whereBetween('out_Date',[$start_at,$end_at])->where('section_id','=',$request->Section)->get();
       $sections = sections::all();
       return view('reports.customers_report',compact('sections'))->withDetails($incomings);


     }



    }
}
