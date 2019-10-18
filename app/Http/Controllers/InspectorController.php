<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Inspector;
use App\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class InspectorController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
          ->join('users','customers.id','=','users.id')
          ->select('customers.id',
                   'customers.name',
                   'customers.country',
                   'customers.phone',
                   'users.user',
                   'users.status',
                   'inspectors.cn_name',
                   'inspectors.type',
                   'inspectors.province',
                   'inspectors.city',
                   'inspectors.back_account',
                   'inspectors.bank_name',
                   'inspectors.remarks',
                   'inspectors.score'
                   )
          ->orderBy('customers.id','desc')->paginate(10);
      }elseif($criteria=='name'){
        $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
        ->join('users','customers.id','=','users.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.country',
                 'customers.phone',
                 'users.user',
                 'users.status',
                 'inspectors.cn_name',
                 'inspectors.type',
                 'inspectors.province',
                 'inspectors.city',
                 'inspectors.back_account',
                 'inspectors.bank_name',
                 'inspectors.remarks',
                 'inspectors.score'
                 )
          ->where('customers.name','like','%'. $search .'%')
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }elseif($criteria=='cn_name'){
        $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
        ->join('users','customers.id','=','users.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.country',
                 'customers.phone',
                 'users.user',
                 'users.status',
                 'inspectors.cn_name',
                 'inspectors.type',
                 'inspectors.province',
                 'inspectors.city',
                 'inspectors.back_account',
                 'inspectors.bank_name',
                 'inspectors.remarks',
                 'inspectors.score'
                 )
          ->where('inspectors.cn_name','like','%'. $search .'%')
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }elseif($criteria=='province'){
        $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
        ->join('users','customers.id','=','users.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.country',
                 'customers.phone',
                 'users.user',
                 'users.status',
                 'inspectors.cn_name',
                 'inspectors.type',
                 'inspectors.province',
                 'inspectors.city',
                 'inspectors.back_account',
                 'inspectors.bank_name',
                 'inspectors.remarks',
                 'inspectors.score'
                 )
          ->where('inspectors.province','like','%'. $search .'%')
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }elseif($criteria=='city'){
        $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
        ->join('users','customers.id','=','users.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.country',
                 'customers.phone',
                 'users.user',
                 'users.status',
                 'inspectors.cn_name',
                 'inspectors.type',
                 'inspectors.province',
                 'inspectors.city',
                 'inspectors.back_account',
                 'inspectors.bank_name',
                 'inspectors.remarks',
                 'inspectors.score'
                 )
          ->where('inspectors.city','like','%'. $search .'%')
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }elseif($criteria=='status'){
        $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
        ->join('users','customers.id','=','users.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.country',
                 'customers.phone',
                 'users.user',
                 'users.status',
                 'inspectors.cn_name',
                 'inspectors.type',
                 'inspectors.province',
                 'inspectors.city',
                 'inspectors.back_account',
                 'inspectors.bank_name',
                 'inspectors.remarks',
                 'inspectors.score'
                 )
          ->where('users.status','like','%'. $search .'%')
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }elseif($criteria=='score'){
        $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
        ->join('users','customers.id','=','users.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.country',
                 'customers.phone',
                 'users.user',
                 'users.status',
                 'inspectors.cn_name',
                 'inspectors.type',
                 'inspectors.province',
                 'inspectors.city',
                 'inspectors.back_account',
                 'inspectors.bank_name',
                 'inspectors.remarks',
                 'inspectors.score'
                 )
          ->where('inspectors.score','like','%'. $search .'%')
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }

      return[
        'pagination'=>[
          'total' => $customers->total(),
          'current_page' => $customers->currentPage(),
          'per_page' => $customers->perPage(),
          'last_page' => $customers->lastPage(),
          'from' => $customers->firstItem(),
          'to' => $customers->lastItem(),
        ],
        'customers' => $customers
      ];
  }


  public function listInspector(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
          ->join('users','customers.id','=','users.id')
          ->select('customers.id',
                   'customers.name',
                   'customers.phone',
                   'customers.country',
                   'users.user',
                   'users.status',
                   'inspectors.cn_name',
                   'inspectors.type',
                   'inspectors.province',
                   'inspectors.city',
                   'inspectors.back_account',
                   'inspectors.bank_name',
                   'inspectors.remarks',
                   'inspectors.score'
                   )
          ->where('users.status','=',1)
          ->orderBy('customers.id','desc')->paginate(10);
      }else{
        $customers = Customer::join('inspectors','customers.id','=','inspectors.id')
        ->join('users','customers.id','=','users.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.phone',
                 'customers.country',
                 'users.user',
                 'users.status',
                 'inspectors.cn_name',
                 'inspectors.type',
                 'inspectors.province',
                 'inspectors.city',
                 'inspectors.back_account',
                 'inspectors.bank_name',
                 'inspectors.remarks',
                 'inspectors.score'
                 )
          ->where('customers.'.$criteria,'like','%'. $search .'%')
          ->where('users.status','=',1)
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }

      return[ 'customers' => $customers];
  }


  public function searchInspector(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $filtro = $request->filtro;
    $inspectors = Customer::join('inspectors','customers.id','=','inspectors.id')
    ->join('users','customers.id','=','users.id')
    ->where('name','=',$filtro)
    ->where('users.idrol','=',4)
    ->select('customers.id','customers.name','customers.phone','customers.country',
              'inspectors.cn_name','inspectors.type','inspectors.province','inspectors.city',
              'inspectors.score')
    ->orderBy('customers.name','asc')->get();

    return ['inspectors' => $inspectors];
  }


  public function store(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $this->validate($request,[
        'back_account'=>'required|unique:inspectors,back_account',
      ]);


      try {
        DB::beginTransaction();
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->short_name = $request->short_name;
        $customer->contact_person = 'Globex Office';
        $customer->customer_mail='User Mail';
        $customer->phone=$request->phone;
        $customer->address='Globex China';
        $customer->country=$request->country;
        $customer->internal_external='1';

        $customer->save();

        $inspector = new Inspector();
        $inspector->cn_name=$request->cn_name;
        $inspector->type=$request->type;
        $inspector->province=$request->province;
        $inspector->city=$request->city;
        $inspector->back_account=$request->back_account;
        $inspector->bank_name=$request->bank_name;
        $inspector->remarks=$request->remarks;
        $inspector->id=$customer->id;
        $inspector->modified_by = Auth::user()->user;
        $inspector->modified_by_id = Auth::user()->id;
        $inspector->save();


        $user = new User();
        $user->user=$request->user;
        $user->password=bcrypt($request->password);
        $user->status='1';
        $user->idrol='4';
        $user->id=$customer->id;
        $user->save();

        DB::commit();

      } catch (Exception $e) {
        DB::rollback();
      }
  }

  public function update(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

    $this->validate($request,[
      'back_account'=>'required|unique:inspectors,back_account',
    ]);

    try {
      DB::beginTransaction();

      $user = User::findOrFail($request->id);

      $inspector = Inspector::findOrFail($request->id);

      $customer = Customer::findOrFail($user->id);

      $customer->name = $request->name;
      $customer->short_name = $request->short_name;
      $customer->phone=$request->phone;
      $customer->country=$request->country;
      $customer->save();

      $inspector->cn_name=$request->cn_name;
      $inspector->type=$request->type;
      $inspector->province=$request->province;
      $inspector->city=$request->city;
      $inspector->back_account=$request->back_account;
      $inspector->bank_name=$request->bank_name;
      $inspector->remarks=$request->remarks;
      $inspector->id=$customer->id;
      $inspector->modified_by = Auth::user()->user;
      $inspector->modified_by_id = Auth::user()->id;
      $inspector->save();


      $user->user=$request->user;
      $user->password=bcrypt($request->password);
      $user->status='1';
      $user->idrol='4';
      $user->id=$customer->id;
      $user->save();

      DB::commit();

    } catch (Exception $e) {
      DB::rollback();
    }
  }

  public function desactivate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $user = User::findOrFail($request->id);
    $user->status= '0';
    $user->save();
  }

  public function activate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $user = User::findOrFail($request->id);
    $user->status= '1';
    $user->save();
  }

  public function selectUser(Request $request)
  {
    $users = User::join('customers','users.id','=','customers.id')
    ->join('rols','users.idrol','=','rols.id')
    ->select('customers.id',
             'customers.name',
             'users.idrol')
    ->where('users.idrol','=','1')
    ->orderBy('customers.id','desc')->get();

    return ['users' => $users];
  }
}
