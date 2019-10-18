<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftygenonedetail extends Model
{
  protected $fillable=[
  'iddetailone',
  'name',
  'address',
  'website',
  'telephone',
  'email',
  'contact_name',
  'contact_mobile',
  'contact_position',
  'main_product',
  'main_market',
  'production_capacity',
  'registration_date',
  'type_of_registration',
  'type_of_company',
  'employees_number',
  'fty_cooperate',
  'result_num',
  'result',
  'remarks',
  ];
}
