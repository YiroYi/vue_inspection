<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Followup;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NotifyFollowup;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class FollowupController extends Controller
{

  public function getFollowup(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $id = $request->id;
      $followups = Followup::where('idservice','=',$id)->where('status','=',1)->orderBy('created_at','desc')->get();

      return['followups'=>$followups];
  }

  public function store(Request $request)
  {
      if(!$request->ajax()) return redirect('/');

      try {
        DB::beginTransaction();

      $followup = new Followup();
      $followup->content = $request->content;
      $followup->idservice = $request->idservice;
      $followup->name = Auth::user()->user;
      $followup->rolf = Auth::user()->idrol;
      $followup->save();

      //Funcion para notificaciones reportes

      $newCci = DB::table('services')->where('idcategory','=',1)->where('idistatus','=',1)->count();
      $newQci = DB::table('services')->where('idcategory','=',2)->where('idistatus','=',1)->count();
      $newSfa = DB::table('services')->where('idcategory','=',3)->where('idistatus','=',1)->count();

      $oldFollow = DB::table('services')->join('followups','services.id','=','followups.idservice')
                    ->select(['services.id','services.reference',DB::raw('MAX(followups.created_at) as created_at' )])
                    ->groupBy('services.id')
                    ->where('services.inspection_date','=',NULL)
                    ->where('followups.rolf','=',2)
                    ->where(function ($query){
                      $query->select(DB::raw('DATE_ADD(followups.created_at,INTERVAL 3 DAY)'),'<=',Carbon::now('Asia/Shanghai'));
                    })->get();

                    $x =$oldFollow;

                    $x = $x->where('created_at','<=',Carbon::now('Asia/Shanghai')->subDays(3))->count();



      $arregloOldFollow = [
        'oldfollow'=> ['numero'=>$x,'msj'=>'Inspections']
      ];

      $allUsers = User::where('idrol','=',1)->orWhere('idrol','=',2)->get();

      foreach ($allUsers as $notificar)
      {
        User::findOrFail($notificar->id)->notify(new NotifyFollowup($arregloOldFollow));
      }

      //Funcion para notificaciones reportes//

      DB::commit();

      } catch (Exception $e) {
        DB::rollback();
      }

  }


  public function desactivate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $followup = Followup::findOrFail($request->id);
    $followup->status= '0';
    $followup->save();
  }
}
