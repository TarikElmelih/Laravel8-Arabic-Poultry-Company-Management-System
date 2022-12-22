<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sells extends Model
{
    public function section()
    {
    return $this->belongsTo('App\Models\sections','section_id','id');
    }
    protected $guarded = [];
}
