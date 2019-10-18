<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
    'name',
    'short_name',
    'phone',
    'contact_person',
    'customer_mail',
    'country',
    'internal_external',
    'address',
    'modified_by_id',
    'modified_by'];

    public function supplier()
    {
      return $this->hasOne('App\Supplier');
    }

    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function services()
    {
      return $this->hasMany('App\Service');
    }

    public function inspector()
    {
        return $this->hasOne('App\Inspector');
    }
}
