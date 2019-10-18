<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Inspector;
use App\User;
use App\Service;
use App\Inspdetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class InspdetailController extends Controller
{

  public function arrangeInspector(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    try {
      DB::beginTransaction();

      $service = Service::findOrFail($request->id);

      $service->sup_intructions = $request->sup_instructions;
      $service->total_cost = $request->total_cost;
      $service->idistatus = 4;
      $service->save();

      $details = $request->data;

      foreach($details as $ep=>$det)
      {
        $detail = new Inspdetail();
        $detail->iduser = $det['idinspector'];
        $detail->idservice = $service->id;
        $detail->inspector = $det['inspector'];
        $detail->inspector_type = $det['inspector_type'];
        $detail->fee = $det['detailFee'];
        $detail->cost_type = 1;
        $detail->modified_by = Auth::user()->user;
        $detail->modified_by_id = Auth::user()->id;
        $detail->save();
      }

      DB::commit();

    } catch (Exception $e) {
      DB::rollback();
    }
  }


  public function getDetails(Request $request)
  {
      if(!$request->ajax()) return redirect('/');

        $id = $request->id;
        $details = Inspdetail::join('services','inspdetails.idservice','=','services.id')
        ->join('users','services.idsales','=','users.id')
        ->select('inspdetails.iduser','inspdetails.inspector','inspdetails.inspector_type','inspdetails.fee',
                 'users.id as users_id')
        ->where('inspdetails.idservice','=',$id)
        ->orderBy('inspdetails.id','desc')->get();

    //dd($services);
    return['details' => $details];
  }



  public function getDetailsAssigned(Request $request)
  {
      if(!$request->ajax()) return redirect('/');

        $id = $request->id;
        $details = Inspdetail::join('services','inspdetails.idservice','=','services.id')
        ->join('users','services.idsales','=','users.id')
        ->select('inspdetails.iduser as idinspector' ,'inspdetails.inspector','inspdetails.inspector_type','inspdetails.fee as detailFee',
                 'users.id as users_id')
        ->where('inspdetails.idservice','=',$id)
        ->orderBy('inspdetails.id','desc')->get();

    //dd($services);
    return['details' => $details];
  }




  public function x(Request $request)
  {

    if(!$request->ajax()) return redirect('/');

    try {
      DB::beginTransaction();

    $ids=$request->idservice;
    $idu=$request->iduser;
    $inspector = Inspdetail::where('idservice','=',$ids)->where('iduser','=',$idu);
    $editedPrice = Service::where('id','=',$ids)->first();

    $inspector->delete();

    $editedPrice->total_cost = 0.0;
    $editedPrice->save();


    DB::commit();

  } catch (Exception $e) {
    DB::rollback();
  }
  }

  public function dismissInspector(Request $request)
  {

    if(!$request->ajax()) return redirect('/');

    try {
      DB::beginTransaction();

    $ids=$request->idservice;
    $idu=$request->iduser;
    $inspector = Inspdetail::where('idservice','=',$ids)->where('iduser','=',$idu);
    $inspector->delete();

    $service = Service::findOrFail($ids);
    $service->idistatus = 3;
    $service->save();

        DB::commit();

        } catch (Exception $e) {
          DB::rollback();
        }
  }

  public function editPrice(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    try {
      DB::beginTransaction();

      $ids=$request->idservice;
      $idu=$request->iduser;
      $price=$request->detailFee;
      $total_cost=number_format((float)$request->total_cost,2,'.','');

      $inspector = Inspdetail::where('idservice','=',$ids)->where('iduser','=',$idu)->first();
      $editedPrice = Service::where('id','=',$ids)->first();


      $inspector->fee = $price;
      $inspector->save();

      $editedPrice->total_cost = $total_cost;
      $editedPrice->save();

      DB::commit();

    } catch (Exception $e) {
      DB::rollback();
    }
  }

}
