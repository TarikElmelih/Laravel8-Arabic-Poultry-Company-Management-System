<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mixes extends Model
{
    protected $guarded = [];

    public function section()
    {
    return $this->belongsTo('App\Models\sections');
    }
    
    public function mixture()
    {
    return $this->hasmany('App\Models\mixtures','mix_id','id');
    }
}
