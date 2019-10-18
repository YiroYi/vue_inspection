<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
  protected $fillable=['name','description','status'];

  public $timestamps = false;

  public function services()
  {
    return $this->hasMany('App\Service');
  }
}
