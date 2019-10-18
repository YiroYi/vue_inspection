<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forwarder;
use Illuminate\Support\Facades\Auth;

class ForwarderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $forwarders = Forwarder::orderBy('id','desc')->paginate(10);
      }else{
          $forwarders = Forwarder::where($criteria,'like','%'. $search .'%')
                                ->orderBy('id','desc')
                                ->paginate(10);
      }

      return[
        'pagination'=>[
          'total' => $forwarders->total(),
          'current_page' => $forwarders->currentPage(),
          'per_page' => $forwarders->perPage(),
          'last_page' => $forwarders->lastPage(),
          'from' => $forwarders->firstItem(),
          'to' => $forwarders->lastItem(),
        ],
        'forwarders' => $forwarders
      ];
  }


  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

      if(!$request->ajax()) return redirect('/');
      $forwarder = new Forwarder();
      $forwarder->name = $request->name;
      $forwarder->contact_person = $request->contact_person;
      $forwarder->email = $request->email;
      $forwarder->telephone = $request->telephone;
      $forwarder->modified_by = Auth::user()->user;
      $forwarder->modified_by_id = Auth::user()->id;
      $forwarder->status= '1';
      $forwarder->save();
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
    $forwarder = Forwarder::findOrFail($request->id);
    $forwarder->name = $request->name;
    $forwarder->contact_person = $request->contact_person;
    $forwarder->email = $request->email;
    $forwarder->telephone = $request->telephone;
    $forwarder->modified_by = Auth::user()->user;
    $forwarder->modified_by_id = Auth::user()->id;
    $forwarder->status= '1';
    $forwarder->save();
  }



  public function desactivate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $forwarder = Forwarder::findOrFail($request->id);
    $forwarder->modified_by = Auth::user()->user;
    $forwarder->modified_by_id = Auth::user()->id;
    $forwarder->status= '0';
    $forwarder->save();
  }

  public function activate(Request $request)
  {
    if(!$request->ajax()) return redirect('/');
    $forwarder = Forwarder::findOrFail($request->id);
    $forwarder->modified_by = Auth::user()->user;
    $forwarder->modified_by_id = Auth::user()->id;
    $forwarder->status= '1';
    $forwarder->save();
  }

  public function selectForwarder(Request $request)
  {
    $forwarders = Forwarder::where('status','=','1')
    ->select('id','name')
    ->orderBy('name','asc')->get();

    return ['forwarders' => $forwarders];
  }
}
