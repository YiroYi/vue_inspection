<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cciaction extends Model
{
    protected $fillable = ['id',
    'iddetail',
    'item_number',
    'spare_parts',
    'item_cnts',
    'sp_cnts',
    'total_cnts',
    'damaged_cnts',
    'pallet_fumigate',
    'container_number',
    'seal_number',
    'container_numberph',
    'seal_numberph',
    'fty_cooperate',
    'remarks',
    'result',
    'container_damaged',
    'pallets_loaded',
    //'packing_listPh',
    'ack_Ph',
    //'c1ack_Ph',
    //'c2ack_Ph',
    'count_ck_Ph',
    //'inspContPh'
    ];
}
