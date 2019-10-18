<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\User;
use App\Inspdetail;
use App\Monitor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Image;

class MonitorController extends Controller
{
  public function indexMonitor(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('istatus','services.idistatus','=','istatus.id')
          ->join('categories','services.idcategory','=','categories.id')
          ->join('users','services.idsales','=','users.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                   'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions','services.action',
                   'categories.name as category_name','categories.description',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                   'users.id as users_id')->where('services.idistatus','=',5)
                   ->orWhere('services.idistatus','=',6)
          ->orderBy('services.id','desc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions','services.action',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')->where('services.idistatus','=',5)
                 ->orWhere('services.idistatus','=',6)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }elseif($criteria=='inspection_date'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions','services.action',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')->where('services.idistatus','=',5)
                 ->orWhere('services.idistatus','=',6)
                 ->where('services.inspection_date','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }
      //dd($services);
      return[
        'pagination'=>[
          'total' => $services->total(),
          'current_page' => $services->currentPage(),
          'per_page' => $services->perPage(),
          'last_page' => $services->lastPage(),
          'from' => $services->firstItem(),
          'to' => $services->lastItem(),
        ],
        'services' => $services
      ];
  }

  public function storeMonitor(Request $request)
  {

    if(!$request->ajax()) return redirect('/');

    try {
      DB::beginTransaction();

    //Photo 1 Evidence//
    $explodedFevi = explode(',',$request->first_evidence);
    $decodedFevi = base64_decode($explodedFevi[1]);
    if(str_contains($explodedFevi[0],'jpeg'))
    $extensionFevi = 'jpeg';
    else
    $extensionFevi = 'jpg';
    $fileNameFevi = str_random().'.'.$extensionFevi;
    $pathFevi = public_path('files/').$fileNameFevi;
    Image::make($decodedFevi)
    ->resize(300,300)
    ->save($pathFevi,50);
    //Photo 1 Evidence//

    //Photo 2 Evidence//
    $explodedSevi = explode(',',$request->second_evidence);
    $decodedSevi = base64_decode($explodedSevi[1]);
    if(str_contains($explodedSevi[0],'jpeg'))
    $extensionSevi = 'jpeg';
    else
    $extensionSevi = 'jpg';
    $fileNameSevi = str_random().'.'.$extensionSevi;
    $pathSevi = public_path('files/').$fileNameSevi;
    Image::make($decodedSevi)
    ->resize(300,300)
    ->save($pathSevi,50);
    //Photo 2 Evidence//

    //Label file//
    $explodedFl = explode(',',$request->third_evidence);
    $decodedFl = base64_decode($explodedFl[1]);
    if(str_contains($explodedFl[0],'jpeg'))
    $extensionFl = 'jpeg';
    else
    $extensionFl = 'doc';
    $fileNameFl = str_random().'.'.$extensionFl;
    $pathFl = public_path('files/').$fileNameFl;
    file_put_contents($pathFl,$decodedFl);
    //Label file//

    $monitor = new Monitor();
    $monitor->idservice = $request->idservice;
    $monitor->first_evidence = $fileNameFevi;
    $monitor->fe_remarks = $request->fe_remarks;
    $monitor->second_evidence = $fileNameSevi;
    $monitor->se_remarks = $request->se_remarks;
    $monitor->third_evidence = $fileNameFl;
    $monitor->th_remarks = $request->th_remarks;
    $monitor->th_remarks = $request->th_remarks;
    $monitor->modified_by = Auth::user()->user;
    $monitor->modified_by_id = Auth::user()->id;
    $monitor->save();

    $ids=$request->idservice;
    $service = Service::where('id','=',$ids)->first();
    $service->action = 1;
    $service->save();

    DB::commit();

    } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function indexMonitorUp(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $ids=$request->idservice;

    $monitorDetails = Monitor::where('idservice','=',$ids)->get();

    return[ 'monitorDetails' => $monitorDetails];
  }


  public function storeUpdate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $ids=$request->idservice;
    $monitor = Monitor::where('idservice','=',$ids)->first();
    $monitor->first_evidence = $request->first_evidence;
    $monitor->second_evidence= $request->second_evidence;
    $monitor->third_evidence = $request->third_evidence;
    $monitor->fe_remarks = $request->fe_remarks;
    $monitor->se_remarks = $request->se_remarks;
    $monitor->th_remarks = $request->th_remarks;
    $monitor->modified_by = Auth::user()->user;
    $monitor->modified_by_id = Auth::user()->id;
    $monitor->save();

  }


}
