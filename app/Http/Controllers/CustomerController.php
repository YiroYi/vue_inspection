<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $customers = Customer::where('customers.internal_external','=',0)->
                                orderBy('id','desc')->paginate(10);
      }else{
          $customers = Customer::where('customers.internal_external','=',0)->
                                where($criteria,'like','%'. $search .'%')
                                ->orderBy('id','desc')
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
      $customer = new Customer();
      $customer->name = $request->name;
      $customer->short_name = $request->short_name;
      $customer->phone=$request->phone;
      $customer->address=$request->address;
      $customer->contact_person=$request->contact_person;
      $customer->customer_mail=$request->customer_mail;
      $customer->country=$request->country;
      $customer->internal_external='0';
      $customer->modified_by = Auth::user()->user;
      $customer->modified_by_id = Auth::user()->id;
      $customer->save();
  }

  public function update(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $customer = Customer::findOrFail($request->id);
    $customer->name = $request->name;
    $customer->short_name = $request->short_name;
    $customer->phone=$request->phone;
    $customer->address=$request->address;
    $customer->contact_person=$request->contact_person;
    $customer->customer_mail=$request->customer_mail;
    $customer->country=$request->country;
    $customer->modified_by = Auth::user()->user;
    $customer->modified_by_id = Auth::user()->id;
    $customer->save();
  }

  public function selectCustomer(Request $request)
  {
    $customers = Customer::orderBy('name','ASC')
              ->where('customers.internal_external','=',0)->get();

    return ['customers' => $customers];
  }
}
