<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qcidefect extends Model
{
    protected $fillable=[
    'id',
    'idqciaction',
    'product_code',
    'product_description',
    'sample_size',
    'minor_defects',
    'major_defects',
    'critical_defects',
    'total',
    'result'
    ];
}
