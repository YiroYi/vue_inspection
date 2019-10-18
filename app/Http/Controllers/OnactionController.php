<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\User;
use App\Inspdetail;
use Carbon\Carbon;

class OnactionController extends Controller
{
  public function indexOnAction(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;
      $idauth = Auth::user()->id;
      $rolauth = Auth::user()->idrol;

      if($rolauth==1 || $rolauth==3 || $rolauth==8 ) /*If to test the role*/
      { /*If to test the role*/
        if($search==''){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                       'users.id as users_id')->where('services.idistatus','=',5)
              ->orderBy('services.inspection_date','asc')->paginate(10);
              }elseif($criteria=='name'){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                       'users.id as users_id')->where('services.idistatus','=',5)
                       ->where('services.reference','like','%'. $search .'%')
                       ->orderBy('services.inspection_date','asc')->paginate(10);

                  }elseif($criteria=='inspection_date'){

                    $services = Service::join('istatus','services.idistatus','=','istatus.id')
                    ->join('categories','services.idcategory','=','categories.id')
                    ->join('users','services.idsales','=','users.id')
                    ->join('suppliers','services.idsupplier','=','suppliers.id')
                    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                             'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                             'categories.name as category_name','categories.description',
                             'istatus.name as istatus_name','istatus.description as istatus_description',
                             'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                             'users.id as users_id')->where('services.idistatus','=',5)
                             ->where('services.inspection_date','like','%'. $search .'%')
                             ->orderBy('services.inspection_date','asc')->paginate(10);

            }
      }else{ /*If to test the role*/
        if($search==''){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->join('inspdetails','services.id','=','inspdetails.idservice')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                       'inspdetails.iduser',
                       'users.id as users_id')->where('services.idistatus','=',5)
              ->where('inspdetails.iduser','=',$idauth)
              ->orderBy('services.inspection_date','asc')->paginate(10);
              }elseif($criteria=='name'){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->join('inspdetails','services.id','=','inspdetails.idservice')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                       'inspdetails.iduser',
                       'users.id as users_id')->where('services.idistatus','=',5)
                       ->where('inspdetails.iduser','=',$idauth)
                       ->where('services.reference','like','%'. $search .'%')
                       ->orderBy('services.inspection_date','asc')->paginate(10);

                  }elseif($criteria=='inspection_date'){

                    $services = Service::join('istatus','services.idistatus','=','istatus.id')
                    ->join('categories','services.idcategory','=','categories.id')
                    ->join('users','services.idsales','=','users.id')
                    ->join('suppliers','services.idsupplier','=','suppliers.id')
                    ->join('inspdetails','services.id','=','inspdetails.idservice')
                    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                             'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                             'categories.name as category_name','categories.description',
                             'istatus.name as istatus_name','istatus.description as istatus_description',
                             'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                             'inspdetails.iduser',
                             'users.id as users_id')->where('services.idistatus','=',5)
                             ->where('inspdetails.iduser','=',$idauth)
                             ->where('services.inspection_date','like','%'. $search .'%')
                             ->orderBy('services.inspection_date','asc')->paginate(10);

            }
      } /*If to test the role*/





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

  public function getDetail(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $ids = $request->id;
    $idu = $request->iduser;
    $inspdetail = Inspdetail::where('idservice','=',$ids)
    ->select('inspdetails.id')
    ->where('iduser','=',$idu)->first();

    return['inspdetail'=>$inspdetail];

  }

}
