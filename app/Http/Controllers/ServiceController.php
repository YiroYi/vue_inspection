<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\User;
use App\Followup;


class ServiceController extends Controller
{

  public function index(Request $request)
  {

      //if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('categories','services.idcategory','=','categories.id')
          ->join('istatus','services.idistatus','=','istatus.id')
          ->join('forwarders','services.idforwarder','=','forwarders.id')
          ->join('users','services.idsales','=','users.id')
          ->join('companies','services.idcompany','=','companies.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                   'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                   'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                   'services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.cs_consultant',
                   'categories.name','categories.description',
                   'companies.name as companies_name','companies.description as companies_description',
                   'customers.name as customers_name','customers.short_name',
                   'forwarders.name as forwarders_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                   'users.id as users_id')
                   ->whereBetween('services.idistatus',[1,5])
          ->orderBy('services.idistatus','asc')->paginate(10);
      }elseif($criteria=='reference'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date','services.cs_consultant',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[1,5])
                 ->where('services.'.$criteria,'like','%'. $search .'%')
                 ->orderBy('services.idistatus','asc')->paginate(10);
      }elseif($criteria=='forwarder'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date','services.cs_consultant',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[1,5])
                 ->where('forwarders.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','asc')->paginate(10);
      }elseif($criteria=='invoice'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date','services.cs_consultant',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[1,5])
                 ->where('companies.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','asc')->paginate(10);
      }elseif($criteria=='customer'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date','services.cs_consultant',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[1,5])
                 ->where('customers.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','asc')->paginate(10);
      }elseif($criteria=='supplier'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date','services.cs_consultant',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[1,5])
                 ->where('suppliers.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','asc')->paginate(10);
      }elseif($criteria=='status'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date','services.cs_consultant',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[1,5])
                 ->where('istatus.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','asc')->paginate(10);
      }elseif($criteria=='cs'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date','services.cs_consultant',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[1,5])
                 ->where('services.cs_consultant','like','%'. $search .'%')
                 ->orderBy('services.idistatus','asc')->paginate(10);
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

  public function indexNew(Request $request)
  {

      //if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('categories','services.idcategory','=','categories.id')
          ->join('istatus','services.idistatus','=','istatus.id')
          ->join('forwarders','services.idforwarder','=','forwarders.id')
          ->join('users','services.idsales','=','users.id')
          ->join('companies','services.idcompany','=','companies.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                   'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                   'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                   'services.instructions','services.special_instructions','services.inspection_status',
                   'categories.name','categories.description',
                   'companies.name as companies_name','companies.description as companies_description',
                   'customers.name as customers_name','customers.short_name',
                   'forwarders.name as forwarders_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                   'users.id as users_id')
                   ->where('services.idistatus','=',1)
          ->orderBy('services.id','desc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('services.idistatus','=',1)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }elseif($criteria=='forwarder'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('services.idistatus','=',1)
                 ->where('forwarders.name','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }elseif($criteria=='invoice'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('services.idistatus','=',1)
                 ->where('companies.name','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }elseif($criteria=='customer'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('services.idistatus','=',1)
                 ->where('customers.name','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }elseif($criteria=='supplier'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('services.idistatus','=',1)
                 ->where('suppliers.name','like','%'. $search .'%')
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

  public function indexProgress(Request $request)
  {

      //if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('categories','services.idcategory','=','categories.id')
          ->join('istatus','services.idistatus','=','istatus.id')
          ->join('forwarders','services.idforwarder','=','forwarders.id')
          ->join('users','services.idsales','=','users.id')
          ->join('companies','services.idcompany','=','companies.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                   'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                   'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                   'services.instructions','services.special_instructions','services.inspection_status','services.inspection_date',
                   'categories.name','categories.description',
                   'companies.name as companies_name','companies.description as companies_description',
                   'customers.name as customers_name','customers.short_name',
                   'forwarders.name as forwarders_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description','istatus.id as istatus_id',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                   'users.id as users_id')
                   ->whereBetween('services.idistatus',[2,11])
          ->orderBy('services.idistatus','desc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[2,11])
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.idistatus','desc')->paginate(10);
      }elseif($criteria=='forwarder'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[2,11])
                 ->where('forwarders.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','desc')->paginate(10);
      }elseif($criteria=='customer'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[2,11])
                 ->where('customers.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','desc')->paginate(10);
      }elseif($criteria=='supplier'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[2,11])
                 ->where('suppliers.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','desc')->paginate(10);
      }elseif($criteria=='status'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('forwarders','services.idforwarder','=','forwarders.id')
        ->join('users','services.idsales','=','users.id')
        ->join('companies','services.idcompany','=','companies.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at',
                 'categories.name','categories.description',
                 'companies.name as companies_name','companies.description as companies_description',
                 'customers.name as customers_name','customers.short_name',
                 'forwarders.name as forwarders_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->whereBetween('services.idistatus',[2,11])
                 ->where('istatus.name','like','%'. $search .'%')
                 ->orderBy('services.idistatus','desc')->paginate(10);
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


  public function indexInspArrange(Request $request)
  {

      //if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('categories','services.idcategory','=','categories.id')
          ->join('istatus','services.idistatus','=','istatus.id')
          ->join('users','services.idsales','=','users.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                   'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                   'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                   'services.instructions','services.special_instructions','services.inspection_status','services.inspection_date',
                   'categories.name as category_name','categories.description',
                   'customers.name as customers_name','customers.short_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                   'users.id as users_id')->where('services.idistatus','=',3)
          ->orderBy('services.inspection_date','asc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date',
                 'categories.name as category_name','categories.description',
                 'customers.name as customers_name','customers.short_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('services.reference','like','%'. $search .'%')
                 ->where('services.idistatus','=',3)
                 ->orderBy('services.inspection_date','asc')->paginate(10);

      }elseif($criteria=='type'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date',
                 'categories.name as category_name','categories.description',
                 'customers.name as customers_name','customers.short_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('categories.name','like','%'. $search .'%')
                 ->where('services.idistatus','=',3)
                 ->orderBy('services.inspection_date','asc')->paginate(10);
      }elseif($criteria=='date'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date',
                 'categories.name as category_name','categories.description',
                 'customers.name as customers_name','customers.short_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('services.inspection_date','like','%'. $search .'%')
                 ->where('services.idistatus','=',3)
                 ->orderBy('services.inspection_date','asc')->paginate(10);
      }elseif($criteria=='customer'){
        $services = Service::join('categories','services.idcategory','=','categories.id')
        ->join('istatus','services.idistatus','=','istatus.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.created_at','services.inspection_date',
                 'categories.name as category_name','categories.description',
                 'customers.name as customers_name','customers.short_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')
                 ->where('customers.name','like','%'. $search .'%')
                 ->where('services.idistatus','=',3)
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


  public function indexInspAssigned(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('istatus','services.idistatus','=','istatus.id')
          ->join('categories','services.idcategory','=','categories.id')
          ->join('users','services.idsales','=','users.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                   'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                   'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                   'services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.total_cost','services.sup_intructions',
                   'categories.name as category_name','categories.description',
                   'customers.name as customers_name','customers.short_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email','suppliers.inspection_address',
                   'users.id as users_id')->where('services.idistatus','=',4)
          ->orderBy('services.id','desc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.total_cost','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'customers.name as customers_name','customers.short_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')->where('services.idistatus','=',4)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }elseif($criteria=='customer'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.total_cost','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'customers.name as customers_name','customers.short_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')->where('services.idistatus','=',4)
                 ->where('customers.name','like','%'. $search .'%')
                 ->orderBy('services.id','desc')->paginate(10);

      }elseif($criteria=='inspection_date'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->select('services.id','services.idcategory','services.idistatus','services.idforwarder','services.idsales','services.idcompany','services.idsupplier',
                 'services.idcustomer','services.reference','services.selling_price','services.billing_price','services.product_type','services.container_type',
                 'services.item_number','services.cnts_cnts','services.spareparts_number','services.total_sp_cnts','services.po_number','services.supplier_number',
                 'services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.total_cost','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'customers.name as customers_name','customers.short_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id')->where('services.idistatus','=',4)
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


  public function findInspector()
  {
    if(!$request->ajax()) return redirect('/');

    $filtro = $request->filtro;
    $articulos = User::where('inspector','=',$filtro)
    ->select('id','name')->orderBy('name','asc')->take(1)->get();
  }


  public function store(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $this->validate($request,[
        'reference'=>'required|unique:services,reference',
      ]);

      $service = new Service();
      $service->idcategory = $request->idcategory;
      $service->idistatus = '1';
      $service->idforwarder = $request->idforwarder;
      $service->idsales = $request->idsales;
      $service->idcompany = $request->idcompany;
      $service->idsupplier = $request->idsupplier;
      $service->idcustomer = $request->idcustomer;
      $service->reference = $request->reference;
      $service->selling_price = $request->selling_price;
      $service->billing_price = $request->billing_price;
      $service->product_type = $request->product_type;
      $service->container_type = $request->container_type;
      $service->item_number = $request->item_number;
      $service->cnts_cnts = $request->cnts_cnts;
      $service->spareparts_number = $request->spareparts_number;
      $service->total_sp_cnts = $request->total_sp_cnts;
      $service->po_number = $request->po_number;
      $service->supplier_number = $request->supplier_number;
      $service->instructions = $request->instructions;
      $service->special_instructions = $request->special_instructions;
      $service->inspection_status = '1';
      $service->cs_consultant = 'Not assigned';
      $service->save();
  }


  public function update(Request $request)
  {
    if(!$request->ajax()) return redirect('/');


    $this->validate($request,[
      'reference'=>'required',Rule::unique('services','reference')->ignore($request->id),//|unique:services,reference'.$request->id
    ]);


    $service = Service::findOrFail($request->id);
    $service->idcategory = $request->idcategory;
    $service->idistatus = '1';
    $service->idforwarder = $request->idforwarder;
    $service->idsales = $request->idsales;
    $service->idcompany = $request->idcompany;
    $service->idsupplier = $request->idsupplier;
    $service->idcustomer = $request->idcustomer;
    $service->reference = $request->reference;
    $service->selling_price = $request->selling_price;
    $service->billing_price = $request->billing_price;
    $service->product_type = $request->product_type;
    $service->container_type = $request->container_type;
    $service->item_number = $request->item_number;
    $service->cnts_cnts = $request->cnts_cnts;
    $service->spareparts_number = $request->spareparts_number;
    $service->total_sp_cnts = $request->total_sp_cnts;
    $service->po_number = $request->po_number;
    $service->supplier_number = $request->supplier_number;
    $service->instructions = $request->instructions;
    $service->special_instructions = $request->special_instructions;
    $service->inspection_status = '1';
    $service->save();
  }

  public function updateAfter(Request $request)
  {
    if(!$request->ajax()) return redirect('/');


    $this->validate($request,[
      'reference'=>'required',Rule::unique('services','reference')->ignore($request->id),//|unique:services,reference'.$request->id
    ]);


    $service = Service::findOrFail($request->id);
    $service->idcategory = $request->idcategory;
    $service->idistatus = '2';
    $service->idforwarder = $request->idforwarder;
    $service->idsales = $request->idsales;
    $service->idcompany = $request->idcompany;
    $service->idsupplier = $request->idsupplier;
    $service->idcustomer = $request->idcustomer;
    $service->reference = $request->reference;
    $service->selling_price = $request->selling_price;
    $service->billing_price = $request->billing_price;
    $service->product_type = $request->product_type;
    $service->container_type = $request->container_type;
    $service->item_number = $request->item_number;
    $service->cnts_cnts = $request->cnts_cnts;
    $service->spareparts_number = $request->spareparts_number;
    $service->total_sp_cnts = $request->total_sp_cnts;
    $service->po_number = $request->po_number;
    $service->supplier_number = $request->supplier_number;
    $service->instructions = $request->instructions;
    $service->special_instructions = $request->special_instructions;
    $service->inspection_status = '1';
    $service->save();
  }


  public function updateIstatus(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $service = Service::findOrFail($request->id);
    $service->idistatus = '2';
    $service->cs_consultant = Auth::user()->user;
    $service->save();
  }

  public function updateIstatusInspectionDate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $service = Service::findOrFail($request->id);
    $service->idistatus = '3';
    $service->inspection_date = $request->inspection_date;
    $service->cs_consultant = Auth::user()->user;
    $service->save();
  }


  public function getFollowup(Request $request)
  {

      /*$followups  = Service::join('followups','services.id','=','followups.idservice')
                    ->select('services.id','followups.id as followups_id','followups.content','followups.name as followups_name','followups.created_at','followups.idservice')->get();
      return $followups;*/
      if (!$request->ajax()) return redirect('/');

      $id = $request->id;
      $followups = Followup::
      where('followups.idservice','=',$id)
      ->orderBy('followups.id', 'desc')->get();

      return ['followups' => $followups];

  }

  public function cancelInspection(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $service = Service::findOrFail($request->id);
    $service->idistatus= 11;
    $service->save();
  }


}
