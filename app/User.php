<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user', 'password','status','idrol','idinspector'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
      return $this->belongsTo('App\Rol');
    }

    public function customer()
    {
      return $this->belongsTo('App\Customer');
    }

    public function inspector()
    {
      return $this->belongsTo('App\Inspector');
    }

    public $timestamps = false;

    public function services()
    {
      return $this->hasMany('App\Service');
    }


}
