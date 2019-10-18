<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $fillable=[
      'idservice',
      'first_evidence',
      'fe_remarks',
      'second_evidence',
      'se_remarks',
      'third_evidence',
      'th_remarks',
      'modified_by_id',
      'modified_by'
    ];
}
