<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable=['id','supplier_contact','supplier_phone','province','city','product_type','name','short_name','email','modified_by_id','modified_by'];


    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }

    public function services()
    {
      return $this->hasMany('App\Service');
    }

}
