<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\User;
use App\Qciaction;
use App\Qcidefect;
use App\Inspdetail;
use Carbon\Carbon;
use Image;

class QciactionController extends Controller
{
    public function storeCheckOut(Request $request)
    {
      if(!$request->ajax()) return redirect('/');

      try {
        DB::beginTransaction();

      $ids=$request->idservice;

      //Photo Acknowledgment//
      $explodedAck = explode(',',$request->acknowledgmentPh);
      $decodedAck = base64_decode($explodedAck[1]);
      if(str_contains($explodedAck[0],'jpeg'))
      $extensionAck = 'jpeg';
      else
      $extensionAck = 'jpg';
      $fileNameAck = str_random().'.'.$extensionAck;
      $pathAck = public_path('files/').$fileNameAck;
      Image::make($decodedAck)
      ->resize(300,300)
      ->save($pathAck,50);
      //Photo Acknowledgmentr//

      /*Photo Packing list//
      $explodedPkl = explode(',',$request->printed_plPh);
      $decodedPkl = base64_decode($explodedPkl[1]);
      if(str_contains($explodedPkl[0],'jpeg'))
      $extensionPkl = 'jpeg';
      else
      $extensionPkl = 'jpg';
      $fileNamePkl = str_random().'.'.$extensionPkl;
      $pathPkl = public_path('files/').$fileNamePkl;
      Image::make($decodedPkl)
      ->resize(300,300)
      ->save($pathPkl,50);
      //Photo Packing list*/

      /*Photo Product Picture//
      $explodedPr = explode(',',$request->product_picture);
      $decodedPr = base64_decode($explodedPr[1]);
      if(str_contains($explodedPr[0],'jpeg'))
      $extensionPr = 'jpeg';
      else
      $extensionPr = 'jpg';
      $fileNamePr = str_random().'.'.$extensionPr;
      $pathPr = public_path('files/').$fileNamePr;
      Image::make($decodedPr)
      ->resize(300,300)
      ->save($pathPr,50);
      //Photo Product Picture//

      //Photo Sampling//
      $explodedSp = explode(',',$request->sampling_picture);
      $decodedSp = base64_decode($explodedSp[1]);
      if(str_contains($explodedSp[0],'jpeg'))
      $extensionSp = 'jpeg';
      else
      $extensionSp = 'jpg';
      $fileNameSp = str_random().'.'.$extensionSp;
      $pathSp = public_path('files/').$fileNameSp;
      Image::make($decodedSp)
      ->resize(300,300)
      ->save($pathSp,50);
      //Photo Sampling*/

      //Photo Sampling Opened//
      $explodedSpo = explode(',',$request->opened_samplePh);
      $decodedSpo = base64_decode($explodedSpo[1]);
      if(str_contains($explodedSpo[0],'jpeg'))
      $extensionSpo = 'jpeg';
      else
      $extensionSpo = 'jpg';
      $fileNameSpo = str_random().'.'.$extensionSpo;
      $pathSpo = public_path('files/').$fileNameSpo;
      Image::make($decodedSpo)
      ->resize(300,300)
      ->save($pathSpo,50);
      //Photo Sampling Opened//

      //Photo Sampling Closed//
      $explodedSpc = explode(',',$request->sealed_samplePh);
      $decodedSpc = base64_decode($explodedSpc[1]);
      if(str_contains($explodedSpc[0],'jpeg'))
      $extensionSpc = 'jpeg';
      else
      $extensionSpc = 'jpg';
      $fileNameSpc = str_random().'.'.$extensionSpc;
      $pathSpc = public_path('files/').$fileNameSpc;
      Image::make($decodedSpc)
      ->resize(300,300)
      ->save($pathSpc,50);
      //Photo Sampling Closed//

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


      $detailInspQci = new Qciaction();
      $detailInspQci->iddetail = $request->iddetail;
      $detailInspQci->aql_level= $request->aql_level;
      $detailInspQci->item_number= $request->item_number;
      $detailInspQci->production_status = $request->production_status;
      $detailInspQci->fty_cooperate = $request->fty_cooperate;
      $detailInspQci->inspection_result = $request->inspection_result;
      $detailInspQci->remarks = $request->remarks;
      $detailInspQci->acknowledgmentPh = $fileNameAck;
      //$detailInspQci->printed_plPh = $fileNamePkl;
      //$detailInspQci->product_picture = $fileNamePr;
      //$detailInspQci->sampling_picture = $fileNameSp;
      $detailInspQci->opened_samplePh = $fileNameSpo;
      $detailInspQci->sealed_samplePh = $fileNameSpc;
      $detailInspQci->save();

      $defects = $request->arrayDefect;

      foreach($defects as $ep=>$det)
      {
        $defect = new Qcidefect();
        $defect->product_code = $det['product_code'];
        $defect->idqciaction = $detailInspQci->id;
        $defect->product_description = $det['product_description'];
        $defect->sample_size = $det['sample_size'];
        $defect->minor_defects = $det['minor_defects'];
        $defect->major_defects = $det['major_defects'];
        $defect->critical_defects = $det['critical_defects'];
        $defect->total = $det['total'];
        $defect->result = $det['result'];
        $defect->save();
      }

      $detailQci = Inspdetail::where('idservice','=',$ids)->first();
      $detailQci->check_out = Carbon::now(new \DateTimeZone('Asia/Shanghai'));
      $detailQci->check_outPH = $fileNameCo;
      $detailQci->save();

      $service = Service::findOrFail($request->idservice);
      $service->idistatus = 6;
      $service->save();

      DB::commit();

      } catch (Exception $e) {
        DB::rollback();
      }
    }
}
