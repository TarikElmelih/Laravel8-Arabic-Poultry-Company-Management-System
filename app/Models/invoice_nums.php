<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_nums extends Model
{
    protected $guarded = [];

    public function section()
    {
    return $this->belongsTo('App\Models\sections');
    }

    public function manufacturing()
   {
   return $this->hasmany('App\Models\manufacturings','invoice_id','id');
   }
   public function mix()
    {
    return $this->belongsTo('App\Models\mixes','mix_id','id');
    }
}
