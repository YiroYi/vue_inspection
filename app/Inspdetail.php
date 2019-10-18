<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspdetail extends Model
{

  protected $fillable =['idservice','iduser','supervisor','inspector_type','cost_type','fee','status',
                          'inspDate','check_in','check_out','check_inPh','check_outPh','check_inPhSize','check_outPhSize',
                        'modified_by','modified_by_id'];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
