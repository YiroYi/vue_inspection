<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Costtype;

class CosttypeController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $costs = Costtype::orderBy('id','desc')->paginate(10);
      }else{
          $costs = Costtype::where($criteria,'like','%'. $search .'%')
                                ->orderBy('id','desc')
                                ->paginate(10);
      }

      return[
        'pagination'=>[
          'total' => $costs->total(),
          'current_page' => $costs->currentPage(),
          'per_page' => $costs->perPage(),
          'last_page' => $costs->lastPage(),
          'from' => $costs->firstItem(),
          'to' => $costs->lastItem(),
        ],
        'costs' => $costs
      ];
  }


  public function store(Request $request)
  {

      if(!$request->ajax()) return redirect('/');
      $cost = new Costtype();
      $cost->code = $request->code;
      $cost->name = $request->name;
      $cost->description = $request->description;
      $cost->status= '1';
      $cost->save();
  }



  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $cost = Costtype::findOrFail($request->id);
    $cost->code = $request->code;
    $cost->name = $request->name;
    $cost->description = $request->description;
    $cost->status= '1';
    $cost->save();
  }



  public function desactivate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $cost = Costtype::findOrFail($request->id);
    $cost->status= '0';
    $cost->save();
  }

  public function activate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $cost = Costtype::findOrFail($request->id);
    $cost->status= '1';
    $cost->save();
  }

  public function selectCost(Request $request)
  {
    $costs = Costtype::where('status','=','1')
    ->select('id','name')
    ->orderBy('name','asc')->get();

    return ['costs' => $costs];
  }
}
