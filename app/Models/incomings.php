<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class incomings extends Model
{
    protected $guarded = [];

    public function section()
    {
    return $this->belongsTo('App\Models\sections');
    }

    public function products()
    {
    return $this->belongsTo('App\Models\products','product_id','id');
    }
}
