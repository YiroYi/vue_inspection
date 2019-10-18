<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forwarder extends Model
{
    protected $fillable = ['name','contact_person','email','telephone','status','modified_by','modified_by_id'];

    public function services()
    {
      return $this->hasMany('App\Service');
    }
}
