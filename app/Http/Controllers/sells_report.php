<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sections;
use App\Models\sells;
class sells_report extends Controller
{
    public function index(){

      $sections = sections::all();
      return view('reports.sells_report',compact('sections'));

    }


    public function Search_customers(Request $request){


// في حالة البحث بدون التاريخ

     if ($request->Section && $request->product && $request->start_at =='' && $request->end_at=='') {


      $sells = sells::select('*')->where('section_id','=',$request->Section)->where('product','=',$request->product)->get();
      $sections = sections::all();
       return view('reports.sells_report',compact('sections'))->withDetails($sells);


     }


  // في حالة البحث بتاريخ

     else {

       $start_at = date($request->start_at);
       $end_at = date($request->end_at);

      $sells = sells::whereBetween('created_at',[$start_at,$end_at])->where('section_id','=',$request->Section)->get();
       $sections = sections::all();
       return view('reports.sells_report',compact('sections'))->withDetails($sells);


     }



    }
}
