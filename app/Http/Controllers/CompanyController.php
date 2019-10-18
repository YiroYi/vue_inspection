<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
  public function index(Request $request)
  {

      if(!$request->ajax()) return redirect('/');

      $search = $request->search;
      $criteria =$request->criteria;

      if($search==''){
          $companies = Company::orderBy('id','desc')->paginate(10);
      }else{
          $companies = Company::where($criteria,'like','%'. $search .'%')
                                ->orderBy('id','desc')
                                ->paginate(10);
      }

      return[
        'pagination'=>[
          'total' => $companies->total(),
          'current_page' => $companies->currentPage(),
          'per_page' => $companies->perPage(),
          'last_page' => $companies->lastPage(),
          'from' => $companies->firstItem(),
          'to' => $companies->lastItem(),
        ],
        'companies' => $companies
      ];
  }

  public function selectCompany(Request $request)
  {
    $companies = Company::where('status','=','1')
    ->select('id','name')
    ->orderBy('name','asc')->get();

    return ['companies' => $companies];
  }

}
