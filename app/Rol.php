<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $fillable=['name','description','status'];

    public $timestamps = false;

    public function customer()
    {
      return $this->hasMany('App\User');
    }
}
