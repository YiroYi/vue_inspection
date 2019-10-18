<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspscore extends Model
{
    protected $fillable=[
      'iddetail',
      'chQone',
      'chQtwo',
      'chEtwo',
      'chPthree',
      'chPfour',
      'chEvfour',
      'chQfive',
      'chQsix',
      'chRemarks',
      'chScore',
      'mxQone',
      'mxQtwo',
      'mxEtwo',
      'mxPthree',
      'mxPfour',
      'mxEvfour',
      'mxQfive',
      'mxQsix',
      'mxRemarks',
      'mxScore',
      'ttScore',
      'globexPoints',
      'modified_cnby_id',
      'modified_cnb',
      'modified_mxby_id',
      'modified_mxby',
      'modified_slby_id',
      'modified_slby',
      'confirm_report_date',
      'upload_report_date',
      'upload_db_date'
    ];
}
