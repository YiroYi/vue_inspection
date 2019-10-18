<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\User;
use App\Inspdetail;
use App\Inspscore;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
  public function indexInvoice(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('istatus','services.idistatus','=','istatus.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                   'services.reference','services.inspection_status','services.inspection_date',
                   'customers.name as customer_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name')
                   ->where('services.idistatus','=',10)
                   ->orWhere('services.idistatus','=',12)
                   ->orderBy('services.inspection_date','asc')->paginate(10);

                 }elseif($criteria=='name'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'services.reference','services.inspection_status','services.inspection_date',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name',
                 'customers.name as customer_name')
                 ->where('services.idistatus','=',10)
                 ->orWhere('services.idistatus','=',12)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

          }elseif($criteria=='supplier'){

    $services = Service::join('istatus','services.idistatus','=','istatus.id')
    ->join('customers','services.idcustomer','=','customers.id')
    ->join('suppliers','services.idsupplier','=','suppliers.id')
    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
          'services.reference','services.inspection_status','services.inspection_date',
          'istatus.name as istatus_name','istatus.description as istatus_description',
          'suppliers.name as suppliers_name',
          'customers.name as customer_name',)
          ->where('services.idistatus','=',10)
          ->orWhere('services.idistatus','=',12)
          ->where('suppliers.name','like','%'. $search .'%')
          ->orderBy('services.inspection_date','asc')->paginate(10);

    }elseif($criteria=='customer'){

    $services = Service::join('istatus','services.idistatus','=','istatus.id')
    ->join('customers','services.idcustomer','=','customers.id')
    ->join('suppliers','services.idsupplier','=','suppliers.id')
    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
    'services.reference','services.inspection_status','services.inspection_date',
    'istatus.name as istatus_name','istatus.description as istatus_description',
    'suppliers.name as suppliers_name',
    'customers.name as customer_name',)
    ->where('services.idistatus','=',10)
    ->orWhere('services.idistatus','=',12)
    ->where('customers.name','like','%'. $search .'%')
    ->orderBy('services.inspection_date','asc')->paginate(10);

    }elseif($criteria=='inspection_date'){

    $services = Service::join('istatus','services.idistatus','=','istatus.id')
    ->join('customers','services.idcustomer','=','customers.id')
    ->join('suppliers','services.idsupplier','=','suppliers.id')
    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
    'services.reference','services.inspection_status','services.inspection_date',
    'istatus.name as istatus_name','istatus.description as istatus_description',
    'suppliers.name as suppliers_name',
    'customers.name as customer_name',)
    ->where('services.idistatus','=',10)
    ->orWhere('services.idistatus','=',12)
    ->where('services.inspection_date','like','%'. $search .'%')
    ->orderBy('services.inspection_date','asc')->paginate(10);

  }elseif($criteria=='status'){

    $services = Service::join('istatus','services.idistatus','=','istatus.id')
    ->join('customers','services.idcustomer','=','customers.id')
    ->join('suppliers','services.idsupplier','=','suppliers.id')
    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
    'services.reference','services.inspection_status','services.inspection_date',
    'istatus.name as istatus_name','istatus.description as istatus_description',
    'suppliers.name as suppliers_name',
    'customers.name as customer_name')
    ->where('services.idistatus','=',10)
    ->orWhere('services.idistatus','=',12)
    ->where('istatus.name','like','%'. $search .'%')
    ->orderBy('services.inspection_date','asc')->paginate(10);

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

  public function invoicePrint(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $service = Service::findOrFail($request->id);
    $service->idistatus = 12;
    $service->save();
  }
}
