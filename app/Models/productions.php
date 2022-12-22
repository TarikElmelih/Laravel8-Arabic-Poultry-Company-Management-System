<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productions extends Model
{
    protected $guarded = [];


    public function section()
    {
    return $this->belongsTo('App\Models\sections');
    }


   
    public function addproduction()
    {
    return $this->belongsTo('App\Models\addproduction','product_id','id');
    }

}
