<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Followup;
use Illuminate\Support\Facades\Auth;

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
      $followup = new Followup();
      $followup->content = $request->content;
      $followup->idservice = $request->idservice;
      $followup->name = Auth::user()->user;
      $followup->save();
  }

  public function desactivate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $followup = Followup::findOrFail($request->id);
    $followup->status= '0';
    $followup->save();
  }
}
