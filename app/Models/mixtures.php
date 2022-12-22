<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mixtures extends Model
{
    protected $guarded = [];


    public function section()
    {
    return $this->belongsTo('App\Models\sections');
    }
    public function product()
    {
    return $this->belongsTo('App\Models\products');
    }
    public function mix()
    {
    return $this->belongsTo('App\Models\mixes','mix_id','id');
    }

}


