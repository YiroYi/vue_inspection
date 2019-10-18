<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{

  protected $fillable=['cn_name','type','province','city','back_account','remarks','score','status','modified_by_id','modified_by'];

  public function persona()
  {
      return $this->belongsTo('App\Customer');
  }
}
