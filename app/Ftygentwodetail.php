<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftygentwodetail extends Model
{
  protected $fillable=[
    'iddetailtwo',
    'customer_country',
    'factory_area_sqm2',
    'company_owner',
    'general_manager',
    'tax_id',
    'export_license',
    'nearest_port',
    'bank_account_picture'

  ];
}
