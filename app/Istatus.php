<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Istatus extends Model
{
  protected $fillable=['name','description','status'];
  protected $table = 'istatus';
  public $timestamps = false;

  public function services()
  {
    return $this->hasMany('App\Service');
  }

}
