<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\User;
use App\Inspdetail;
use App\Inspscore;
use App\Cciaction;
use App\Qciaction;
use App\Qcidefect;
use App\Ftygenonedetail;
use App\Ftygentwodetail;
use App\Ftyonequestion;
use App\Ftytwoquestion;
use App\Ftythreequestion;
use App\Ftyfourquestion;
use App\Ftyfivequestion;
use Illuminate\Support\Facades\Auth;
use Image;
use Carbon\Carbon;
use App\Notifications\NotifyAdmin;
use App\Notifications\NotifyCs;


class ScoreController extends Controller
{


  public function indexScore(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('istatus','services.idistatus','=','istatus.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->join('categories','services.idcategory','=','categories.id')
          ->join('users','services.idsales','=','users.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('inspdetails','services.id','=','inspdetails.idservice')
          ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                   'customers.name as customer_name',
                   'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                   'categories.name as category_name','categories.description',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                   'users.id as users_id',
                   'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh','inspdetails.check_inPh')
                   ->where('services.idistatus','=',6)->where('services.idcategory','=',1)

          ->orderBy('services.inspection_date','asc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'customers.name as customer_name',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh')
                 ->where('services.idistatus','=',6)
                 ->where('services.idcategory','=',1)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

      }elseif($criteria=='customer'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'customers.name as customer_name',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh')
                 ->where('services.idistatus','=',6)
                 ->where('services.idcategory','=',1)
                 ->where('customers.name','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

      }elseif($criteria=='inspection_date'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'customers.name as customer_name',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh')
                 ->where('services.idistatus','=',6)
                 ->where('services.idcategory','=',1)
                 ->where('services.inspection_date','like','%'. $search .'%')
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

  public function indexScoreQci(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('istatus','services.idistatus','=','istatus.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->join('categories','services.idcategory','=','categories.id')
          ->join('users','services.idsales','=','users.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('inspdetails','services.id','=','inspdetails.idservice')
          ->join('qciactions','inspdetails.id','=','qciactions.iddetail')
          ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                   'customers.name as customer_name',
                   'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                   'categories.name as category_name','categories.description',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                   'users.id as users_id',
                   'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh','inspdetails.check_inPh',
                   'qciactions.id as qciactions_id','qciactions.aql_level','qciactions.production_status','qciactions.item_number','qciactions.printed_plPh','qciactions.acknowledgmentPh',
                   'qciactions.opened_samplePh','qciactions.sealed_samplePh','qciactions.sampling_picture','qciactions.inspection_result','qciactions.fty_cooperate','qciactions.remarks'
                   )

          ->where('services.idistatus','=',6)
          ->orderBy('services.inspection_date','asc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->join('qciactions','inspdetails.id','=','qciactions.iddetail')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'customers.name as customer_name',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh',
                 'qciactions.id as qciactions_id','qciactions.aql_level','qciactions.production_status','qciactions.item_number','qciactions.printed_plPh','qciactions.acknowledgmentPh',
                 'qciactions.opened_samplePh','qciactions.sealed_samplePh','qciactions.sampling_picture','qciactions.inspection_result','qciactions.fty_cooperate','qciactions.remarks'
                 )->where('services.idistatus','=',6)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

      }elseif($criteria=='inspection_date'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->join('qciactions','inspdetails.id','=','qciactions.iddetail')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'customers.name as customer_name',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh',
                 'qciactions.id as qciactions_id','qciactions.aql_level','qciactions.production_status','qciactions.item_number','qciactions.printed_plPh','qciactions.acknowledgmentPh',
                 'qciactions.opened_samplePh','qciactions.sealed_samplePh','qciactions.sampling_picture','qciactions.inspection_result','qciactions.fty_cooperate','qciactions.remarks'
                 )->where('services.idistatus','=',6)
                 ->where('services.inspection_date','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

      }elseif($criteria=='customer'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->join('qciactions','inspdetails.id','=','qciactions.iddetail')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'customers.name as customer_name',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh',
                 'qciactions.id as qciactions_id','qciactions.aql_level','qciactions.production_status','qciactions.item_number','qciactions.printed_plPh','qciactions.acknowledgmentPh',
                 'qciactions.opened_samplePh','qciactions.sealed_samplePh','qciactions.sampling_picture','qciactions.inspection_result','qciactions.fty_cooperate','qciactions.remarks'
                 )->where('services.idistatus','=',6)
                 ->where('customers.name','like','%'. $search .'%')
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

  public function indexScoreSfa(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('istatus','services.idistatus','=','istatus.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->join('categories','services.idcategory','=','categories.id')
          ->join('users','services.idsales','=','users.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('inspdetails','services.id','=','inspdetails.idservice')
          ->join('ftygenonedetails','inspdetails.id','=','ftygenonedetails.iddetailone')
          ->join('ftygentwodetails','inspdetails.id','=','ftygentwodetails.iddetailtwo')
          ->join('ftyonequestions','inspdetails.id','=','ftyonequestions.iddetailqone')
          ->join('ftytwoquestions','inspdetails.id','=','ftytwoquestions.iddetailqtwo')
          ->join('ftythreequestions','inspdetails.id','=','ftythreequestions.iddetailqthree')
          ->join('ftyfourquestions','inspdetails.id','=','ftyfourquestions.iddetailqfour')
          ->join('ftyfivequestions','inspdetails.id','=','ftyfivequestions.iddetailqfive')
          ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                   'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                   'categories.name as category_name','categories.description',
                   'customers.name as customer_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                   'users.id as users_id',
                   'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh','inspdetails.check_inPh',
                   'ftygenonedetails.id as ftygenonedetails_id','ftygenonedetails.name','ftygenonedetails.address','ftygenonedetails.website','ftygenonedetails.telephone','ftygenonedetails.email',
                   'ftygenonedetails.contact_name','ftygenonedetails.contact_mobile','ftygenonedetails.contact_position','ftygenonedetails.main_product','ftygenonedetails.main_market','ftygenonedetails.production_capacity',
                   'ftygenonedetails.registration_date','ftygenonedetails.type_of_registration','ftygenonedetails.type_of_company','ftygenonedetails.employees_number','ftygenonedetails.result_num','ftygenonedetails.result','ftygenonedetails.fty_cooperate','ftygenonedetails.remarks',
                   'ftygentwodetails.id as ftygentwodetails_id','ftygentwodetails.customer_country','ftygentwodetails.factory_area_sqm2','ftygentwodetails.company_owner','ftygentwodetails.general_manager','ftygentwodetails.tax_id',
                   'ftygentwodetails.export_license','ftygentwodetails.nearest_port','ftygentwodetails.bank_account_picture',
                   'ftyonequestions.id as ftygenonedetails_id','ftyonequestions.q1Pa','ftyonequestions.q2Pa','ftyonequestions.q3Pa','ftyonequestions.q4Pa','ftyonequestions.q5Pa',
                   'ftyonequestions.q1Ce','ftyonequestions.q2Ce','ftyonequestions.q3Ce','ftyonequestions.q4Ce','ftyonequestions.q5Ce',
                   'ftytwoquestions.id as ftytwoquestions_id','ftytwoquestions.q1Plm','ftytwoquestions.q2Plm','ftytwoquestions.q3Plm','ftytwoquestions.q4Plm','ftytwoquestions.q5Plm',
                   'ftytwoquestions.q1Mp','ftytwoquestions.q2Mp','ftytwoquestions.q3Mp','ftytwoquestions.q4Mp','ftytwoquestions.q5Mp',
                   'ftythreequestions.id as ftythreequestions_id','ftythreequestions.q1Iin','ftythreequestions.q2Iin','ftythreequestions.q3Iin','ftythreequestions.q4Iin','ftythreequestions.q5Iin',
                   'ftythreequestions.q1Qm','ftythreequestions.q2Qm','ftythreequestions.q3Qm','ftythreequestions.q4Qm','ftythreequestions.q5Qm',
                   'ftyfourquestions.id as ftyfourquestions_id','ftyfourquestions.q1Fi','ftyfourquestions.q2Fi','ftyfourquestions.q3Fi','ftyfourquestions.q4Fi','ftyfourquestions.q5Fi',
                   'ftyfourquestions.q1Wh','ftyfourquestions.q2Wh','ftyfourquestions.q3Wh','ftyfourquestions.q4Wh','ftyfourquestions.q5Wh',
                   'ftyfivequestions.id as ftyfivequestions_id','ftyfivequestions.q1Ef','ftyfivequestions.q2Ef','ftyfivequestions.q3Ef','ftyfivequestions.q4Ef','ftyfivequestions.q5Ef'
                    )
                   ->where('services.idistatus','=',6)
                   ->where('services.idcategory','=',3)
                   ->orderBy('services.inspection_date','asc')->paginate(10);
      }elseif($criteria=='name'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->join('ftygenonedetails','inspdetails.id','=','ftygenonedetails.iddetailone')
        ->join('ftygentwodetails','inspdetails.id','=','ftygentwodetails.iddetailtwo')
        ->join('ftyonequestions','inspdetails.id','=','ftyonequestions.iddetailqone')
        ->join('ftytwoquestions','inspdetails.id','=','ftytwoquestions.iddetailqtwo')
        ->join('ftythreequestions','inspdetails.id','=','ftythreequestions.iddetailqthree')
        ->join('ftyfourquestions','inspdetails.id','=','ftyfourquestions.iddetailqfour')
        ->join('ftyfivequestions','inspdetails.id','=','ftyfivequestions.iddetailqfive')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'customers.name as customer_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh','inspdetails.check_inPh',
                 'ftygenonedetails.id as ftygenonedetails_id','ftygenonedetails.name','ftygenonedetails.address','ftygenonedetails.website','ftygenonedetails.telephone','ftygenonedetails.email',
                 'ftygenonedetails.contact_name','ftygenonedetails.contact_mobile','ftygenonedetails.contact_position','ftygenonedetails.main_product','ftygenonedetails.main_market','ftygenonedetails.production_capacity',
                 'ftygenonedetails.registration_date','ftygenonedetails.type_of_registration','ftygenonedetails.type_of_company','ftygenonedetails.employees_number','ftygenonedetails.result_num','ftygenonedetails.result','ftygenonedetails.fty_cooperate','ftygenonedetails.remarks',
                 'ftygentwodetails.id as ftygentwodetails_id','ftygentwodetails.customer_country','ftygentwodetails.factory_area_sqm2','ftygentwodetails.company_owner','ftygentwodetails.general_manager','ftygentwodetails.tax_id',
                 'ftygentwodetails.export_license','ftygentwodetails.nearest_port','ftygentwodetails.bank_account_picture',
                 'ftyonequestions.id as ftygenonedetails_id','ftyonequestions.q1Pa','ftyonequestions.q2Pa','ftyonequestions.q3Pa','ftyonequestions.q4Pa','ftyonequestions.q5Pa',
                 'ftyonequestions.q1Ce','ftyonequestions.q2Ce','ftyonequestions.q3Ce','ftyonequestions.q4Ce','ftyonequestions.q5Ce',
                 'ftytwoquestions.id as ftytwoquestions_id','ftytwoquestions.q1Plm','ftytwoquestions.q2Plm','ftytwoquestions.q3Plm','ftytwoquestions.q4Plm','ftytwoquestions.q5Plm',
                 'ftytwoquestions.q1Mp','ftytwoquestions.q2Mp','ftytwoquestions.q3Mp','ftytwoquestions.q4Mp','ftytwoquestions.q5Mp',
                 'ftythreequestions.id as ftythreequestions_id','ftythreequestions.q1Iin','ftythreequestions.q2Iin','ftythreequestions.q3Iin','ftythreequestions.q4Iin','ftythreequestions.q5Iin',
                 'ftythreequestions.q1Qm','ftythreequestions.q2Qm','ftythreequestions.q3Qm','ftythreequestions.q4Qm','ftythreequestions.q5Qm',
                 'ftyfourquestions.id as ftyfourquestions_id','ftyfourquestions.q1Fi','ftyfourquestions.q2Fi','ftyfourquestions.q3Fi','ftyfourquestions.q4Fi','ftyfourquestions.q5Fi',
                 'ftyfourquestions.q1Wh','ftyfourquestions.q2Wh','ftyfourquestions.q3Wh','ftyfourquestions.q4Wh','ftyfourquestions.q5Wh',
                 'ftyfivequestions.id as ftyfivequestions_id','ftyfivequestions.q1Ef','ftyfivequestions.q2Ef','ftyfivequestions.q3Ef','ftyfivequestions.q4Ef','ftyfivequestions.q5Ef'
                  )
                 ->where('services.idistatus','=',6)
                 ->where('services.idcategory','=',3)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

      }elseif($criteria=='inspection_date'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->join('ftygenonedetails','inspdetails.id','=','ftygenonedetails.iddetailone')
        ->join('ftygentwodetails','inspdetails.id','=','ftygentwodetails.iddetailtwo')
        ->join('ftyonequestions','inspdetails.id','=','ftyonequestions.iddetailqone')
        ->join('ftytwoquestions','inspdetails.id','=','ftytwoquestions.iddetailqtwo')
        ->join('ftythreequestions','inspdetails.id','=','ftythreequestions.iddetailqthree')
        ->join('ftyfourquestions','inspdetails.id','=','ftyfourquestions.iddetailqfour')
        ->join('ftyfivequestions','inspdetails.id','=','ftyfivequestions.iddetailqfive')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'customers.name as customer_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh','inspdetails.check_inPh',
                 'ftygenonedetails.id as ftygenonedetails_id','ftygenonedetails.name','ftygenonedetails.address','ftygenonedetails.website','ftygenonedetails.telephone','ftygenonedetails.email',
                 'ftygenonedetails.contact_name','ftygenonedetails.contact_mobile','ftygenonedetails.contact_position','ftygenonedetails.main_product','ftygenonedetails.main_market','ftygenonedetails.production_capacity',
                 'ftygenonedetails.registration_date','ftygenonedetails.type_of_registration','ftygenonedetails.type_of_company','ftygenonedetails.employees_number','ftygenonedetails.result_num','ftygenonedetails.result','ftygenonedetails.fty_cooperate','ftygenonedetails.remarks',
                 'ftygentwodetails.id as ftygentwodetails_id','ftygentwodetails.customer_country','ftygentwodetails.factory_area_sqm2','ftygentwodetails.company_owner','ftygentwodetails.general_manager','ftygentwodetails.tax_id',
                 'ftygentwodetails.export_license','ftygentwodetails.nearest_port','ftygentwodetails.bank_account_picture',
                 'ftyonequestions.id as ftygenonedetails_id','ftyonequestions.q1Pa','ftyonequestions.q2Pa','ftyonequestions.q3Pa','ftyonequestions.q4Pa','ftyonequestions.q5Pa',
                 'ftyonequestions.q1Ce','ftyonequestions.q2Ce','ftyonequestions.q3Ce','ftyonequestions.q4Ce','ftyonequestions.q5Ce',
                 'ftytwoquestions.id as ftytwoquestions_id','ftytwoquestions.q1Plm','ftytwoquestions.q2Plm','ftytwoquestions.q3Plm','ftytwoquestions.q4Plm','ftytwoquestions.q5Plm',
                 'ftytwoquestions.q1Mp','ftytwoquestions.q2Mp','ftytwoquestions.q3Mp','ftytwoquestions.q4Mp','ftytwoquestions.q5Mp',
                 'ftythreequestions.id as ftythreequestions_id','ftythreequestions.q1Iin','ftythreequestions.q2Iin','ftythreequestions.q3Iin','ftythreequestions.q4Iin','ftythreequestions.q5Iin',
                 'ftythreequestions.q1Qm','ftythreequestions.q2Qm','ftythreequestions.q3Qm','ftythreequestions.q4Qm','ftythreequestions.q5Qm',
                 'ftyfourquestions.id as ftyfourquestions_id','ftyfourquestions.q1Fi','ftyfourquestions.q2Fi','ftyfourquestions.q3Fi','ftyfourquestions.q4Fi','ftyfourquestions.q5Fi',
                 'ftyfourquestions.q1Wh','ftyfourquestions.q2Wh','ftyfourquestions.q3Wh','ftyfourquestions.q4Wh','ftyfourquestions.q5Wh',
                 'ftyfivequestions.id as ftyfivequestions_id','ftyfivequestions.q1Ef','ftyfivequestions.q2Ef','ftyfivequestions.q3Ef','ftyfivequestions.q4Ef','ftyfivequestions.q5Ef'
                  )
                 ->where('services.idistatus','=',6)
                 ->where('services.idcategory','=',3)
                 ->where('services.inspection_date','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

      }elseif($criteria=='customer'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->join('ftygenonedetails','inspdetails.id','=','ftygenonedetails.iddetailone')
        ->join('ftygentwodetails','inspdetails.id','=','ftygentwodetails.iddetailtwo')
        ->join('ftyonequestions','inspdetails.id','=','ftyonequestions.iddetailqone')
        ->join('ftytwoquestions','inspdetails.id','=','ftytwoquestions.iddetailqtwo')
        ->join('ftythreequestions','inspdetails.id','=','ftythreequestions.iddetailqthree')
        ->join('ftyfourquestions','inspdetails.id','=','ftyfourquestions.iddetailqfour')
        ->join('ftyfivequestions','inspdetails.id','=','ftyfivequestions.iddetailqfive')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'services.reference','services.instructions','services.special_instructions','services.inspection_status','services.inspection_date','services.sup_intructions',
                 'categories.name as category_name','categories.description',
                 'customers.name as customer_name',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name' ,'suppliers.province','suppliers.city','suppliers.supplier_contact','suppliers.supplier_phone','suppliers.email',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector','inspdetails.check_in','inspdetails.check_out','inspdetails.check_outPh','inspdetails.check_inPh',
                 'ftygenonedetails.id as ftygenonedetails_id','ftygenonedetails.name','ftygenonedetails.address','ftygenonedetails.website','ftygenonedetails.telephone','ftygenonedetails.email',
                 'ftygenonedetails.contact_name','ftygenonedetails.contact_mobile','ftygenonedetails.contact_position','ftygenonedetails.main_product','ftygenonedetails.main_market','ftygenonedetails.production_capacity',
                 'ftygenonedetails.registration_date','ftygenonedetails.type_of_registration','ftygenonedetails.type_of_company','ftygenonedetails.employees_number','ftygenonedetails.result_num','ftygenonedetails.result','ftygenonedetails.fty_cooperate','ftygenonedetails.remarks',
                 'ftygentwodetails.id as ftygentwodetails_id','ftygentwodetails.customer_country','ftygentwodetails.factory_area_sqm2','ftygentwodetails.company_owner','ftygentwodetails.general_manager','ftygentwodetails.tax_id',
                 'ftygentwodetails.export_license','ftygentwodetails.nearest_port','ftygentwodetails.bank_account_picture',
                 'ftyonequestions.id as ftygenonedetails_id','ftyonequestions.q1Pa','ftyonequestions.q2Pa','ftyonequestions.q3Pa','ftyonequestions.q4Pa','ftyonequestions.q5Pa',
                 'ftyonequestions.q1Ce','ftyonequestions.q2Ce','ftyonequestions.q3Ce','ftyonequestions.q4Ce','ftyonequestions.q5Ce',
                 'ftytwoquestions.id as ftytwoquestions_id','ftytwoquestions.q1Plm','ftytwoquestions.q2Plm','ftytwoquestions.q3Plm','ftytwoquestions.q4Plm','ftytwoquestions.q5Plm',
                 'ftytwoquestions.q1Mp','ftytwoquestions.q2Mp','ftytwoquestions.q3Mp','ftytwoquestions.q4Mp','ftytwoquestions.q5Mp',
                 'ftythreequestions.id as ftythreequestions_id','ftythreequestions.q1Iin','ftythreequestions.q2Iin','ftythreequestions.q3Iin','ftythreequestions.q4Iin','ftythreequestions.q5Iin',
                 'ftythreequestions.q1Qm','ftythreequestions.q2Qm','ftythreequestions.q3Qm','ftythreequestions.q4Qm','ftythreequestions.q5Qm',
                 'ftyfourquestions.id as ftyfourquestions_id','ftyfourquestions.q1Fi','ftyfourquestions.q2Fi','ftyfourquestions.q3Fi','ftyfourquestions.q4Fi','ftyfourquestions.q5Fi',
                 'ftyfourquestions.q1Wh','ftyfourquestions.q2Wh','ftyfourquestions.q3Wh','ftyfourquestions.q4Wh','ftyfourquestions.q5Wh',
                 'ftyfivequestions.id as ftyfivequestions_id','ftyfivequestions.q1Ef','ftyfivequestions.q2Ef','ftyfivequestions.q3Ef','ftyfivequestions.q4Ef','ftyfivequestions.q5Ef'
                  )
                 ->where('services.idistatus','=',6)
                 ->where('services.idcategory','=',3)
                 ->where('customers.name','like','%'. $search .'%')
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

  public function indexCompleted(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){

          $services = Service::join('istatus','services.idistatus','=','istatus.id')
          ->join('customers','services.idcustomer','=','customers.id')
          ->join('categories','services.idcategory','=','categories.id')
          ->join('users','services.idsales','=','users.id')
          ->join('suppliers','services.idsupplier','=','suppliers.id')
          ->join('inspdetails','services.id','=','inspdetails.idservice')
          ->join('inspscores','inspdetails.id','=','inspscores.iddetail')
          ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                   'services.reference','services.inspection_status','services.inspection_date',
                   'categories.name as category_name','categories.description',
                   'customers.name as customer_name',
                   'istatus.name as istatus_name','istatus.description as istatus_description',
                   'suppliers.name as suppliers_name',
                   'users.id as users_id',
                   'inspdetails.id as inspdetails_id','inspdetails.inspector',
                   'inspscores.id as inspscores_id','inspscores.db_link'
                    )
                   ->where('services.idistatus','=',8)
                   ->orderBy('services.inspection_date','asc')->paginate(10);

                 }elseif($criteria=='name'){

        $services = Service::join('istatus','services.idistatus','=','istatus.id')
        ->join('customers','services.idcustomer','=','customers.id')
        ->join('categories','services.idcategory','=','categories.id')
        ->join('users','services.idsales','=','users.id')
        ->join('suppliers','services.idsupplier','=','suppliers.id')
        ->join('inspdetails','services.id','=','inspdetails.idservice')
        ->join('inspscores','inspdetails.id','=','inspscores.iddetail')
        ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
                 'services.reference','services.inspection_status','services.inspection_date',
                 'categories.name as category_name','categories.description',
                 'istatus.name as istatus_name','istatus.description as istatus_description',
                 'suppliers.name as suppliers_name',
                 'customers.name as customer_name',
                 'users.id as users_id',
                 'inspdetails.id as inspdetails_id','inspdetails.inspector',
                 'inspscores.id as inspscores_id','inspscores.db_link'
                  )
                 ->where('services.idistatus','=',8)
                 ->where('services.reference','like','%'. $search .'%')
                 ->orderBy('services.inspection_date','asc')->paginate(10);

          }elseif($criteria=='supplier'){

    $services = Service::join('istatus','services.idistatus','=','istatus.id')
    ->join('customers','services.idcustomer','=','customers.id')
    ->join('categories','services.idcategory','=','categories.id')
    ->join('users','services.idsales','=','users.id')
    ->join('suppliers','services.idsupplier','=','suppliers.id')
    ->join('inspdetails','services.id','=','inspdetails.idservice')
    ->join('inspscores','inspdetails.id','=','inspscores.iddetail')
    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
          'services.reference','services.inspection_status','services.inspection_date',
          'categories.name as category_name','categories.description',
          'istatus.name as istatus_name','istatus.description as istatus_description',
          'suppliers.name as suppliers_name',
          'customers.name as customer_name',
          'users.id as users_id',
          'inspdetails.id as inspdetails_id','inspdetails.inspector',
          'inspscores.id as inspscores_id','inspscores.db_link'
           )
          ->where('services.idistatus','=',8)
          ->where('suppliers.name','like','%'. $search .'%')
          ->orderBy('services.inspection_date','asc')->paginate(10);

    }elseif($criteria=='customer'){

    $services = Service::join('istatus','services.idistatus','=','istatus.id')
    ->join('customers','services.idcustomer','=','customers.id')
    ->join('categories','services.idcategory','=','categories.id')
    ->join('users','services.idsales','=','users.id')
    ->join('suppliers','services.idsupplier','=','suppliers.id')
    ->join('inspdetails','services.id','=','inspdetails.idservice')
    ->join('inspscores','inspdetails.id','=','inspscores.iddetail')
    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
    'services.reference','services.inspection_status','services.inspection_date',
    'categories.name as category_name','categories.description',
    'istatus.name as istatus_name','istatus.description as istatus_description',
    'suppliers.name as suppliers_name',
    'customers.name as customer_name',
    'users.id as users_id',
    'inspdetails.id as inspdetails_id','inspdetails.inspector',
    'inspscores.id as inspscores_id','inspscores.db_link'
     )
    ->where('services.idistatus','=',8)
    ->where('customers.name','like','%'. $search .'%')
    ->orderBy('services.inspection_date','asc')->paginate(10);

    }elseif($criteria=='inspection_date'){

    $services = Service::join('istatus','services.idistatus','=','istatus.id')
    ->join('customers','services.idcustomer','=','customers.id')
    ->join('categories','services.idcategory','=','categories.id')
    ->join('users','services.idsales','=','users.id')
    ->join('suppliers','services.idsupplier','=','suppliers.id')
    ->join('inspdetails','services.id','=','inspdetails.idservice')
    ->join('inspscores','inspdetails.id','=','inspscores.iddetail')
    ->select('services.id','services.idcategory','services.idistatus','services.idsupplier',
    'services.reference','services.inspection_status','services.inspection_date',
    'categories.name as category_name','categories.description',
    'istatus.name as istatus_name','istatus.description as istatus_description',
    'suppliers.name as suppliers_name',
    'customers.name as customer_name',
    'users.id as users_id',
    'inspdetails.id as inspdetails_id','inspdetails.inspector',
    'inspscores.id as inspscores_id','inspscores.db_link'
     )
    ->where('services.idistatus','=',8)
    ->where('services.inspection_date','like','%'. $search .'%')
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

  public function indexScoreUp(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $idDet=$request->idDet;

    $cciDetail = Cciaction::where('iddetail','=',$idDet)->get();

    return['cciDetail'=>$cciDetail];
  }

  public function getDefectQci(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $idDef=$request->idDef;

    $qciDetail = Qcidefect::where('idqciaction','=',$idDef)->get();

    return['qciDetail'=>$qciDetail];
  }

  public function confirmInfo(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    try {
      DB::beginTransaction();

    $idDet=$request->idcci;
    $ids=$request->ids;

    $cciDet = Cciaction::where('iddetail','=',$idDet)->first();
    $cciDet->item_number=$request->item_number;
    $cciDet->spare_parts=$request->spare_parts;
    $cciDet->item_cnts=$request->item_cnts;
    $cciDet->sp_cnts=$request->sp_cnts;
    $cciDet->total_cnts=$request->total_cnts;
    $cciDet->damaged_cnts=$request->damaged_cnts;
    $cciDet->pallet_fumigate=$request->pallet_fumigate;
    $cciDet->pallets_loaded=$request->pallets_loaded;
    $cciDet->container_number=$request->container_number;
    $cciDet->seal_number=$request->seal_number;
    $cciDet->container_numberph=$request->container_numberph;
    $cciDet->seal_numberph=$request->seal_numberph;
    $cciDet->fty_cooperate=$request->fty_cooperate;
    $cciDet->container_damaged=$request->container_damaged;
    $cciDet->result=$request->result;
    $cciDet->remarks=$request->remarks;

    $cciDet->save();

    $service = Service::findOrFail($request->ids);
    $service->idistatus = 6;
    $service->save();

    DB::commit();

    } catch (Exception $e) {
      DB::rollback();
    }

  }

  public function addNewDefect(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $idqciaction=$request->idqciaction;
    $defects = $request->arrayDefect;

    foreach($defects as $ep=>$det)
    {
      $defect = new Qcidefect();
      $defect->product_code = $det['product_code'];
      $defect->idqciaction = $idqciaction;
      $defect->product_description = $det['product_description'];
      $defect->sample_size = $det['sample_size'];
      $defect->minor_defects = $det['minor_defects'];
      $defect->major_defects = $det['major_defects'];
      $defect->critical_defects = $det['critical_defects'];
      $defect->total = $det['total'];
      $defect->result = $det['result'];
      $defect->save();
    }

  }

  public function deleteDefectEdit(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $id=$request->id;
    $defect = Qcidefect::where('id','=',$id);
    $defect->delete();
  }

  public function editSfainfo(Request $request)
  {

      if(!$request->ajax()) return redirect('/');
      $idDet = $request->iddetailone;

      try {
        DB::beginTransaction();

          $sfaDetailone = Ftygenonedetail::where('iddetailone','=',$idDet)->first();
          $sfaDetailone->name= $request->name;
          $sfaDetailone->address= $request->address;
          $sfaDetailone->website= $request->website;
          $sfaDetailone->telephone= $request->telephone;
          $sfaDetailone->email= $request->email;
          $sfaDetailone->contact_name= $request->contact_name;
          $sfaDetailone->contact_mobile= $request->contact_mobile;
          $sfaDetailone->contact_position= $request->contact_position;
          $sfaDetailone->main_product= $request->main_product;
          $sfaDetailone->main_market= $request->main_market;
          $sfaDetailone->production_capacity= $request->production_capacity;
          $sfaDetailone->registration_date= $request->registration_date;
          $sfaDetailone->type_of_registration= $request->type_of_registration;
          $sfaDetailone->type_of_company= $request->type_of_company;
          $sfaDetailone->employees_number= $request->employees_number;
          $sfaDetailone->save();

          $sfaDetailtwo =Ftygentwodetail::where('iddetailtwo','=',$idDet)->first();
          $sfaDetailtwo->customer_country= $request->customer_country;
          $sfaDetailtwo->factory_area_sqm2= $request->factory_area_sqm2;
          $sfaDetailtwo->company_owner= $request->company_owner;
          $sfaDetailtwo->general_manager= $request->general_manager;
          $sfaDetailtwo->tax_id= $request->tax_id;
          $sfaDetailtwo->export_license= $request->export_license;
          $sfaDetailtwo->nearest_port= $request->nearest_port;
          $sfaDetailtwo->save();

        DB::commit();

        } catch (Exception $e) {
          DB::rollback();
        }

  }

  public function newSfaScore(Request $request)
  {

    if(!$request->ajax()) return redirect('/');

    $idDet = $request->iddetail;

    try {
      DB::beginTransaction();


   if(!$request->chEtwo){
     $fileNameEv='';
   }else{
    //Evidencia score//
    $explodedEv = explode(',',$request->chEtwo);
    $decodedEv = base64_decode($explodedEv[1]);
    if(str_contains($explodedEv[0],'jpeg'))
    $extensionEv = 'jpeg';
    else
    $extensionEv = 'doc';
    $fileNameEv = str_random().'.'.$extensionEv;
    $pathEv = public_path('files/').$fileNameEv;
    file_put_contents($pathEv,$decodedEv);
    //Evidencia score//
    }

    $score = new Inspscore();
    $score->iddetail=$idDet;
    $score->chQone=$request->chQone;
    $score->chQtwo=$request->chQtwo;
    $score->chEtwo=$fileNameEv;
    $score->chPthree=$request->chPthree;
    $score->chPfour=$request->chPfour;
    $score->chQfive=$request->chQfive;
    $score->chQSix=$request->chQSix;
    $score->chRemarks=$request->chRemarks;
    $score->chScore=$request->chScore;
    $score->modified_cnby = Auth::user()->user;
    $score->modified_cnby_id = Auth::user()->id;
    $score->upload_db_date = Carbon::today();

    $score->save();

    $service = Service::findOrFail($request->idservice);
    $service->idistatus = 7;
    $service->save();

    //Funcion para notificaciones

    $numCci = DB::table('services')->where('idcategory','=',1)->where('idistatus','=',6)->count();
    $numQci = DB::table('services')->where('idcategory','=',2)->where('idistatus','=',6)->count();
    $numSfa = DB::table('services')->where('idcategory','=',3)->where('idistatus','=',6)->count();

    $arregloCciNotify = [
      'services'=> ['numero'=>$numCci,'msj'=>'CCI'],
      'servicesqci'=> ['numero'=>$numQci,'msj'=>'QCI'],
      'servicessfa'=> ['numero'=>$numSfa,'msj'=>'SFA']
    ];

    $allUsers = User::where('idrol','=',1)->orWhere('idrol','=',3)->get();

    foreach ($allUsers as $notificar)
    {
      User::findOrFail($notificar->id)->notify(new NotifyAdmin($arregloCciNotify));
    }

    //Funcion para notificaciones

    //Funcion para notificaciones reportes

    $repCci = DB::table('services')->where('idcategory','=',1)->where('idistatus','=',7)->count();
    $repQci = DB::table('services')->where('idcategory','=',2)->where('idistatus','=',7)->count();
    $repSfa = DB::table('services')->where('idcategory','=',3)->where('idistatus','=',7)->count();

    $arregloRepNotify = [
      'reportesccia'=> ['numero'=>$repCci,'msj'=>'CCI'],
      'reportesqci'=> ['numero'=>$repQci,'msj'=>'QCI'],
      'reportessfa'=> ['numero'=>$repSfa,'msj'=>'SFA']
    ];

    $allUsers = User::where('idrol','=',1)->orWhere('idrol','=',2)->get();

    foreach ($allUsers as $notificar)
    {
      User::findOrFail($notificar->id)->notify(new NotifyCs($arregloRepNotify));
    }

    //Funcion para notificaciones reportes

    DB::commit();

    } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function saleClosing(Request $request)
  {

    if(!$request->ajax()) return redirect('/');

    try {
      DB::beginTransaction();

    //Evidencia score//
    if(!$request->insp_ev){
      $fileNameEv='';
    }else{
    $explodedEv = explode(',',$request->insp_ev);
    $decodedEv = base64_decode($explodedEv[1]);
    Log::info($explodedEv);
    if(str_contains($explodedEv[0],'jpeg'))
    $extensionEv = 'jpeg';
    else
    $extensionEv = 'doc';
    $fileNameEv = str_random().'.'.$extensionEv;
    $pathEv = public_path('files/').$fileNameEv;
    file_put_contents($pathEv,$decodedEv);
    //Evidencia score*/
    }
    //$file=$request->file('insp_ev');
    //Log::info($file);
    //$uniqueFileName = uniqid() . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
    //$file->move(public_path('files') . $uniqueFileName);




    $feedback = Inspscore::findOrFail($request->idinspscores);
    $feedback->insp_grade = $request->insp_grade;
    $feedback->insp_remark = $request->insp_remark;
    $feedback->insp_ev = $fileNameEv;
    //$feedback->insp_ev = $uniqueFileName;
    $feedback->cs_grade = $request->cs_grade;
    $feedback->cs_remark = $request->cs_remark;
    $feedback->report_grade = $request->report_grade;
    $feedback->report_remark = $request->report_remark;
    $feedback->modified_slby = Auth::user()->user;
    $feedback->modified_slby_id = Auth::user()->id;
    $feedback->confirm_report_date = Carbon::today();
    $feedback->save();

    $service = Service::findOrFail($request->idservice);
    $service->selling_price = $request->selling_price;
    $service->idcompany = $request->idcompany;
    $service->idistatus = 10;
    $service->save();

    DB::commit();

    } catch (Exception $e) {
      DB::rollback();
    }


  }
}
