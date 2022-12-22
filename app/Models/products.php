<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class products extends Model
{
    protected $guarded = [];

   public function section()
   {
   return $this->belongsTo('App\Models\sections');
   }

   public function outgoing()
   {
   return $this->hasmany('App\Models\outgoings','product_id','id');
   }

   public function incoming()
   {
   return $this->hasmany('App\Models\incomings','product_id','id');
   }

   public function production()
   {
   return $this->hasmany('App\Models\productions','product_id','id');
   }
   
   public function manufacturing()
   {
   return $this->hasmany('App\Models\manufacturings','product_id','id');
   }




}
