<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $customers = User::join('customers','users.id','=','customers.id')
          ->join('rols','users.idrol','=','rols.id')
          ->select('customers.id',
                   'customers.name',
                   'customers.short_name',
                   'customers.phone',
                   'customers.contact_person',
                   'customers.customer_mail',
                   'customers.country',
                   'customers.internal_external',
                   'customers.address',
                   'users.user',
                   'users.password',
                   'users.status',
                   'users.idrol',
                   'rols.name as rol')
          ->where('customers.internal_external','=',1)
          ->orderBy('customers.id','desc')->paginate(10);
      }elseif($criteria=='rol'){
        $customers = User::join('customers','users.id','=','customers.id')
        ->join('rols','users.idrol','=','rols.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.short_name',
                 'customers.phone',
                 'customers.contact_person',
                 'customers.customer_mail',
                 'customers.country',
                 'customers.internal_external',
                 'customers.address',
                 'users.user',
                 'users.password',
                 'users.status',
                 'users.idrol',
                 'rols.name as rol')
          ->where('customers.internal_external','=',1)
          ->where('rols.name','like','%'. $search .'%')
          ->orderBy('customers.id','desc')
          ->paginate(10);
      }else{
        $customers = User::join('customers','users.id','=','customers.id')
        ->join('rols','users.idrol','=','rols.id')
        ->select('customers.id',
                 'customers.name',
                 'customers.short_name',
                 'customers.phone',
                 'customers.address',
                 'customers.contact_person',
                 'customers.customer_mail',
                 'customers.country',
                 'customers.internal_external',
                 'users.user',
                 'users.password',
                 'users.status',
                 'users.idrol',
                 'rols.name as rol')
          ->where('customers.internal_external','=',1)
          ->where('customers.'.$criteria,'like','%'. $search .'%')
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

  public function store(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      try {
        DB::beginTransaction();
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->short_name = $request->short_name;
        $customer->contact_person='Globex Office';
        $customer->customer_mail='User Mail';
        $customer->country=$request->country;
        $customer->internal_external='1';
        $customer->phone=$request->phone;
        $customer->address=$request->address;
        $customer->modified_by = Auth::user()->user;
        $customer->modified_by_id = Auth::user()->id;
        $customer->save();

        $user = new User();
        $user->user=$request->user;
        $user->password=bcrypt($request->password);
        $user->status='1';
        $user->idrol=$request->idrol;
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

    try {
      DB::beginTransaction();

      $user = User::findOrFail($request->id);

      $customer = Customer::findOrFail($user->id);

      $customer->name = $request->name;
      $customer->short_name = $request->short_name;
      $customer->country=$request->country;
      $customer->phone=$request->phone;
      $customer->address=$request->address;
      $customer->modified_by = Auth::user()->user;
      $customer->modified_by_id = Auth::user()->id;
      $customer->save();


      $user->user=$request->user;
      $user->password=bcrypt($request->password);
      $user->status='1';
      $user->idrol=$request->idrol;
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
    ->where('users.idrol','=',5)
    ->orderBy('customers.id','desc')->get();

    return ['users' => $users];
  }
}
