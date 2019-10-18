<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['idcategory','idistatus','idforwarder','idsales','idcompany','idsupplier','idcustomer',
                            'reference','selling_price','billing_price','product_type','container_type','item_number',
                            'cnts_cnts','spareparts_number','total_sp_cnts','po_number','supplier_number','instructions',
                            'special_instructions','inspection_status','inspection_date','cs_consultant','idfollowup'];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function istatus()
    {
      return $this->belongsTo('App\Istatus');
    }

    public function forwarder()
    {
      return $this->belongsTo('App\Forwarder');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function company()
    {
      return $this->belongsTo('App\Company');
    }

    public function supplier()
    {
      return $this->belongsTo('App\Supplier');
    }

    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }

    public function comments()
    {
      return $this->hasMany('App\Followup');
    }

}
