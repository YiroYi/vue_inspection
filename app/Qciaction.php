<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qciaction extends Model
{
    protected $fillabe=[
      'id',
      'iddetail',
      'aql_level',
      'production_status',
      'item_number',
      'inspection_result',
      'fty_cooperate',
      'remarks',
      'opened_samplePh',
      'sealed_samplePh',
      //'product_picture',
      //'sampling_picture',
      //'printed_plPh',
      'acknowledgmentPh'
    ];
}
