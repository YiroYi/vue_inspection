<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Supplier;


class SupplierController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $suppliers = Supplier::orderBy('id','desc')->paginate(10);
      }else{
        $suppliers = Supplier::where($criteria,'like','%'. $search .'%')
                              ->orderBy('id','desc')
                              ->paginate(10);
      }

      return[
        'pagination'=>[
          'total' => $suppliers->total(),
          'current_page' => $suppliers->currentPage(),
          'per_page' => $suppliers->perPage(),
          'last_page' => $suppliers->lastPage(),
          'from' => $suppliers->firstItem(),
          'to' => $suppliers->lastItem(),
        ],
        'suppliers' => $suppliers
      ];
  }

  public function store(Request $request)
  {
      if(!$request->ajax()) return redirect('/');

        $supplier = new Supplier();
        $supplier->supplier_contact=$request->supplier_contact;
        $supplier->supplier_phone=$request->supplier_phone;
        $supplier->product_type=$request->product_type;
        $supplier->province=$request->province;
        $supplier->city=$request->city;
        $supplier->name=$request->name;
        $supplier->short_name=$request->short_name;
        $supplier->email=$request->email;
        $supplier->inspection_address=$request->inspection_address;
        $supplier->modified_by = Auth::user()->user;
        $supplier->modified_by_id = Auth::user()->id;
        $supplier->save();
  }

  public function update(Request $request)
  {
    if(!$request->ajax()) return redirect('/');

      $supplier = Supplier::findOrFail($request->id);
      $supplier->supplier_contact=$request->supplier_contact;
      $supplier->supplier_phone=$request->supplier_phone;
      $supplier->product_type=$request->product_type;
      $supplier->province=$request->province;
      $supplier->city=$request->city;
      $supplier->name=$request->name;
      $supplier->short_name=$request->short_name;
      $supplier->email=$request->email;
      $supplier->inspection_address=$request->inspection_address;
      $supplier->modified_by = Auth::user()->user;
      $supplier->modified_by_id = Auth::user()->id;
      $supplier->save();

  }

  public function selectSupplier(Request $request)
  {
    $suppliers = Supplier::orderBy('name','ASC')->get();

    return ['suppliers' => $suppliers];
  }
}
