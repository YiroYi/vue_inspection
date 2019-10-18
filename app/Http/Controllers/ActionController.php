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
use Image;



class ActionController extends Controller
{
  public function indexAction(Request $request)
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
            ->join('customers','services.idcustomer','=','customers.id')
            ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                     'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                     'categories.name as category_name','categories.description',
                     'customers.name as customers_name',
                     'istatus.name as istatus_name','istatus.description as istatus_description',
                     'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                     'users.id as users_id')->where('services.idistatus','=',4)
            ->orderBy('services.inspection_date','asc')->paginate(10);
            }elseif($criteria=='name'){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->join('customers','services.idcustomer','=','customers.id')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'customers.name as customers_name',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                       'users.id as users_id')->where('services.idistatus','=',4)
                       ->where('services.reference','like','%'. $search .'%')
                       ->orderBy('services.inspection_date','asc')->paginate(10);

            }elseif($criteria=='inspection_date'){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->join('customers','services.idcustomer','=','customers.id')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'customers.name as customers_name',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                       'users.id as users_id')->where('services.idistatus','=',4)
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
            ->join('customers','services.idcustomer','=','customers.id')
            ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                     'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                     'categories.name as category_name','categories.description',
                     'customers.name as customers_name',
                     'istatus.name as istatus_name','istatus.description as istatus_description',
                     'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                     'inspdetails.iduser',
                     'users.id as users_id')->where('services.idistatus','=',4)
                     ->where('inspdetails.iduser','=',$idauth)
            ->orderBy('services.inspection_date','asc')->paginate(10);
            }elseif($criteria=='name'){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->join('inspdetails','services.id','=','inspdetails.idservice')
              ->join('customers','services.idcustomer','=','customers.id')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'customers.name as customers_name',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                       'inspdetails.iduser',
                       'users.id as users_id')->where('services.idistatus','=',4)
                       ->where('inspdetails.iduser','=',$idauth)
                       ->where('services.reference','like','%'. $search .'%')
                       ->orderBy('services.inspection_date','asc')->paginate(10);

            }elseif($criteria=='inspection_date'){

              $services = Service::join('istatus','services.idistatus','=','istatus.id')
              ->join('categories','services.idcategory','=','categories.id')
              ->join('users','services.idsales','=','users.id')
              ->join('suppliers','services.idsupplier','=','suppliers.id')
              ->join('inspdetails','services.id','=','inspdetails.idservice')
              ->join('customers','services.idcustomer','=','customers.id')
              ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                       'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                       'categories.name as category_name','categories.description',
                       'customers.name as customers_name',
                       'istatus.name as istatus_name','istatus.description as istatus_description',
                       'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                       'inspdetails.iduser',
                       'users.id as users_id')->where('services.idistatus','=',4)
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

   public function storeCheckIn(Request $request)
   {
     if(!$request->ajax()) return redirect('/');

     try {
       DB::beginTransaction();
     $ids=$request->idservice;
     //$idu=$request->iduser;
     //$inspector = Inspdetail::where('idservice','=',$ids)->where('iduser','=',$idu)->first();

      $exploded = explode(',',$request->check_inPh);
      $decoded = base64_decode($exploded[1]);
      if(str_contains($exploded[0],'jpeg'))
      $extension = 'jpeg';
      else
      $extension = 'jpg';
      $fileName = str_random().'.'.$extension;
      $path = public_path('files/').$fileName;


      Image::make($decoded)
      ->resize(300,300)
      ->save($path,50);


      $detail = Inspdetail::where('idservice','=',$ids)->first();
      $detail->inspDate = Carbon::today();
      $detail->check_in = Carbon::now(new \DateTimeZone('Asia/Shanghai'));
      $detail->check_inPH = $fileName;
      $detail->save();


      $service = Service::findOrFail($request->idservice);
      $service->idistatus = 5;
      $service->save();

      DB::commit();

      } catch (Exception $e) {
        DB::rollback();
      }


   }
}
