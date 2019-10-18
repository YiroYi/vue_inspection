<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $rols = Rol::orderBy('id','desc')->paginate(10);
      }else{
          $rols = Rol::where($criteria,'like','%'. $search .'%')
                                ->orderBy('id','desc')
                                ->paginate(10);
      }

      return[
        'pagination'=>[
          'total' => $rols->total(),
          'current_page' => $rols->currentPage(),
          'per_page' => $rols->perPage(),
          'last_page' => $rols->lastPage(),
          'from' => $rols->firstItem(),
          'to' => $rols->lastItem(),
        ],
        'rols' => $rols
      ];
  }

  public function selectRol(Request $request)
  {
    $rols = Rol::where('status','=','1')
    ->select('id','name')
    ->where('id','!=',4)
    ->orderBy('name','asc')->get();

    return ['rols' => $rols];
  }
}
