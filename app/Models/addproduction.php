<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class addproduction extends Model
{
    protected $guarded = [];

    public function section()
    {
    return $this->belongsTo('App\Models\sections','section_id','id');
    }

    public function productions()
    {
    return $this->hasmany('App\Models\productions','product_id','id');
    }


}
