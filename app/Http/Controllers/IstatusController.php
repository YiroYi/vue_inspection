<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Istatus;

class IstatusController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $istatuses = Istatus::orderBy('id','desc')->paginate(10);
      }else{
          $istatuses = Istatus::where($criteria,'like','%'. $search .'%')
                                ->orderBy('id','desc')
                                ->paginate(10);
      }

      return[
        'pagination'=>[
          'total' => $istatuses->total(),
          'current_page' => $istatuses->currentPage(),
          'per_page' => $istatuses->perPage(),
          'last_page' => $istatuses->lastPage(),
          'from' => $istatuses->firstItem(),
          'to' => $istatuses->lastItem(),
        ],
        'istatuses' => $istatuses
      ];
  }

  public function selectIstatus(Request $request)
  {
    $istatuses = Istatus::where('status','=','1')
    ->select('id','name')
    ->orderBy('name','asc')->get();

    return ['istatuses' => $istatuses];
  }
}
