<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\User;
use App\Ftygenonedetail;
use App\Ftygentwodetail;
use App\Ftyonequestion;
use App\Ftytwoquestion;
use App\Ftythreequestion;
use App\Ftyfourquestion;
use App\Ftyfivequestion;
use App\Inspdetail;
use Carbon\Carbon;
use Image;
use App\Notifications\NotifyAdmin;


class SfaactionController extends Controller
{
    public function storeCheckOut(Request $request)
    {
      if(!$request->ajax()) return redirect('/');

      try {
        DB::beginTransaction();

      $ids=$request->idservice;

      /*Emergency facilities 1
      $explodedEfo = explode(',',$request->img1Ef);
      $decodedEfo = base64_decode($explodedEfo[1]);
      if(str_contains($explodedEfo[0],'jpeg'))
      $extensionEfo = 'jpeg';
      else
      $extensionEfo = 'jpg';
      $fileNameEfo = str_random().'.'.$extensionEfo;
      $pathEfo = public_path('files/').$fileNameEfo;
      file_put_contents($pathEfo,$decodedEfo);
      //Emergency facilities 1//

      //Emergency facilities 2//
      $explodedEft = explode(',',$request->img2Ef);
      $decodedEft = base64_decode($explodedEft[1]);
      if(str_contains($explodedEft[0],'jpeg'))
      $extensionEft = 'jpeg';
      else
      $extensionEft = 'jpg';
      $fileNameEft = str_random().'.'.$extensionEft;
      $pathEft = public_path('files/').$fileNameEft;
      file_put_contents($pathEft,$decodedEft);
      //Emergency facilities 2*/

      //Bank account pictures//
      $explodedBa = explode(',',$request->bank_account_picture);
      $decodedBa = base64_decode($explodedBa[1]);
      if(str_contains($explodedBa[0],'jpeg'))
      $extensionBa = 'jpeg';
      else
      $extensionBa = 'jpg';
      $fileNameBa = str_random().'.'.$extensionBa;
      $pathBa = public_path('files/').$fileNameBa;
      Image::make($decodedBa)
      ->resize(300,300)
      ->save($pathBa,50);
      //Bank account pictures//

      //Check out picture//
      $explodedCo = explode(',',$request->check_outPh);
      $decodedCo = base64_decode($explodedCo[1]);
      if(str_contains($explodedCo[0],'jpeg'))
      $extensionCo = 'jpeg';
      else
      $extensionCo = 'jpg';
      $fileNameCo = str_random().'.'.$extensionCo;
      $pathCo = public_path('files/').$fileNameCo;
      Image::make($decodedCo)
      ->resize(300,300)
      ->save($pathCo,50);
      //Check put picture//


      $factorygenone = new Ftygenonedetail();
      $factorygenone->iddetailone=$request->iddetail;
      $factorygenone->name=$request->name;
      $factorygenone->address=$request->address;
      $factorygenone->website=$request->website;
      $factorygenone->telephone=$request->telephone;
      $factorygenone->email=$request->email;
      $factorygenone->contact_name=$request->contact_name;
      $factorygenone->contact_mobile=$request->contact_mobile;
      $factorygenone->contact_position=$request->contact_position;
      $factorygenone->main_product=$request->main_product;
      $factorygenone->main_market=$request->main_market;
      $factorygenone->production_capacity=$request->production_capacity;
      $factorygenone->registration_date=$request->registration_date;
      $factorygenone->type_of_registration=$request->type_of_registration;
      $factorygenone->type_of_company=$request->type_of_company;
      $factorygenone->employees_number=$request->employees_number;
      $factorygenone->result=$request->result;
      $factorygenone->result_num=$request->result_num;
      $factorygenone->fty_cooperate=$request->fty_cooperate;
      $factorygenone->remarks=$request->remarks;
      $factorygenone->save();

      $factorygentwo = new Ftygentwodetail();
      $factorygentwo->iddetailtwo=$request->iddetail;
      $factorygentwo->customer_country=$request->customer_country;
      $factorygentwo->factory_area_sqm2=$request->factory_area_sqm2;
      $factorygentwo->company_owner=$request->company_owner;
      $factorygentwo->general_manager=$request->general_manager;
      $factorygentwo->tax_id=$request->tax_id;
      $factorygentwo->export_license=$request->export_license;
      $factorygentwo->nearest_port=$request->nearest_port;
      $factorygentwo->bank_account_picture=$fileNameBa;
      $factorygentwo->save();

      $ftyq1 = new Ftyonequestion();
      $ftyq1->iddetailqone = $request->iddetail;
      $ftyq1->q1Pa = $request->q1Pa;
      $ftyq1->q2Pa = $request->q2Pa;
      $ftyq1->q3Pa = $request->q3Pa;
      $ftyq1->q4Pa = $request->q4Pa;
      $ftyq1->q5Pa = $request->q5Pa;

      $ftyq1->q1Ce = $request->q1Ce;
      $ftyq1->q2Ce = $request->q2Ce;
      $ftyq1->q3Ce = $request->q3Ce;
      $ftyq1->q4Ce = $request->q4Ce;
      $ftyq1->q5Ce = $request->q5Ce;

      $ftyq1->save();

      $ftyq2 = new Ftytwoquestion();
      $ftyq2->iddetailqtwo = $request->iddetail;
      $ftyq2->q1Plm = $request->q1Plm;
      $ftyq2->q2Plm = $request->q2Plm;
      $ftyq2->q3Plm = $request->q3Plm;
      $ftyq2->q4Plm = $request->q4Plm;
      $ftyq2->q5Plm = $request->q5Plm;

      $ftyq2->q1Mp = $request->q1Mp;
      $ftyq2->q2Mp = $request->q2Mp;
      $ftyq2->q3Mp = $request->q3Mp;
      $ftyq2->q4Mp = $request->q4Mp;
      $ftyq2->q5Mp = $request->q5Mp;

      $ftyq2->save();

      $ftyq3 = new Ftythreequestion();
      $ftyq3->iddetailqthree = $request->iddetail;
      $ftyq3->q1Iin = $request->q1Iin;
      $ftyq3->q2Iin = $request->q2Iin;
      $ftyq3->q3Iin = $request->q3Iin;
      $ftyq3->q4Iin = $request->q4Iin;
      $ftyq3->q5Iin = $request->q5Iin;

      $ftyq3->q1Qm = $request->q1Qm;
      $ftyq3->q2Qm = $request->q2Qm;
      $ftyq3->q3Qm = $request->q3Qm;
      $ftyq3->q4Qm = $request->q4Qm;
      $ftyq3->q5Qm = $request->q5Qm;

      $ftyq3->save();

      $ftyq4 = new Ftyfourquestion();
      $ftyq4->iddetailqfour = $request->iddetail;
      $ftyq4->q1Fi = $request->q1Fi;
      $ftyq4->q2Fi = $request->q2Fi;
      $ftyq4->q3Fi = $request->q3Fi;
      $ftyq4->q4Fi = $request->q4Fi;
      $ftyq4->q5Fi = $request->q5Fi;

      $ftyq4->q1Wh = $request->q1Wh;
      $ftyq4->q2Wh = $request->q2Wh;
      $ftyq4->q3Wh = $request->q3Wh;
      $ftyq4->q4Wh = $request->q4Wh;
      $ftyq4->q5Wh = $request->q5Wh;

      $ftyq4->save();

      $ftyq5 = new Ftyfivequestion();
      $ftyq5->iddetailqfive = $request->iddetail;
      $ftyq5->q1Ef = $request->q1Ef;
      $ftyq5->q2Ef = $request->q2Ef;
      $ftyq5->q3Ef = $request->q3Ef;
      $ftyq5->q4Ef = $request->q4Ef;
      $ftyq5->q5Ef = $request->q5Ef;
      //$ftyq5->img1Ef = $fileNameEfo;
      //$ftyq5->img2Ef = $fileNameEft;
      $ftyq5->save();

      $detailSfa = Inspdetail::where('idservice','=',$ids)->first();
      $detailSfa->check_out = Carbon::now(new \DateTimeZone('Asia/Shanghai'));
      $detailSfa->check_outPH = $fileNameCo;
      $detailSfa->save();

      $service = Service::findOrFail($request->idservice);
      $service->idistatus = 6;
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

      

      DB::commit();

      } catch (Exception $e) {
        DB::rollback();
      }
    }
}
