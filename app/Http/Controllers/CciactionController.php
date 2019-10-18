<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\User;
use App\Cciaction;
use App\Inspdetail;
use Carbon\Carbon;
use Image;

class CciactionController extends Controller
{
    public function storeCheckOut(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        try {
          DB::beginTransaction();

          $ids=$request->idservice;
        //Photo container number//
        $exploded = explode(',',$request->container_numberph);
        $decoded = base64_decode($exploded[1]);
        if(str_contains($exploded[0],'jpeg'))
        $extension = 'jpeg';
        else
        $extension = 'jpg';
        $fileName = str_random().'.'.$extension;
        $path = public_path('files/').$fileName;

        Image::make($decoded)
        ->resize(300,300)
        ->save($path,50);
        //file_put_contents($path,$decoded);
        //Photo container number//

        //Photo seal number//
        $explodedSn = explode(',',$request->seal_numberph);
        $decodedSn = base64_decode($explodedSn[1]);
        if(str_contains($explodedSn[0],'jpeg'))
        $extensionSn = 'jpeg';
        else
        $extensionSn = 'jpg';
        $fileNameSn = str_random().'.'.$extensionSn;
        $pathSn = public_path('files/').$fileNameSn;
        Image::make($decodedSn)
        ->resize(300,300)
        ->save($pathSn,50);
        //Photo seal number//

        /*Photo Packing list//
        $explodedPl = explode(',',$request->packing_listPh);
        $decodedPl = base64_decode($explodedPl[1]);
        if(str_contains($explodedPl[0],'jpeg'))
        $extensionPl = 'jpeg';
        else
        $extensionPl = 'jpg';
        $fileNamePl = str_random().'.'.$extensionPl;
        $pathPl = public_path('files/').$fileNamePl;
        Image::make($decodedPl)
        ->resize(300,300)
        ->save($pathPl,50);
        //Photo Packing list*/

        //Photo Acknowledgment//
        $explodedAck = explode(',',$request->ack_Ph);
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
        //Photo Acknowledgment//

        /*Photo Container Acknowledgment 1//
        $explodedC1 = explode(',',$request->c1ack_Ph);
        $decodedC1 = base64_decode($explodedC1[1]);
        if(str_contains($explodedC1[0],'jpeg'))
        $extensionC1 = 'jpeg';
        else
        $extensionC1 = 'jpg';
        $fileNameC1 = str_random().'.'.$extensionC1;
        $pathC1 = public_path('files/').$fileNameC1;
        Image::make($decodedC1)
        ->resize(300,300)
        ->save($pathC1,50);
        //Photo Container Acknowledgment 1*/

        /*Photo Container Acknowledgment 2//
        $explodedC2 = explode(',',$request->c2ack_Ph);
        $decodedC2 = base64_decode($explodedC2[1]);
        if(str_contains($explodedC2[0],'jpeg'))
        $extensionC2 = 'jpeg';
        else
        $extensionC2 = 'jpg';
        $fileNameC2 = str_random().'.'.$extensionC2;
        $pathC2 = public_path('files/').$fileNameC2;
        Image::make($decodedC2)
        ->resize(300,300)
        ->save($pathC2,50);
        //Photo Container Acknowledgment 2*/

        //Photo Counting Acknowledgment//
        $explodedCa = explode(',',$request->count_ck_Ph);
        $decodedCa = base64_decode($explodedCa[1]);
        if(str_contains($explodedCa[0],'jpeg'))
        $extensionCa = 'jpeg';
        else
        $extensionCa = 'jpg';
        $fileNameCa = str_random().'.'.$extensionCa;
        $pathCa = public_path('files/').$fileNameCa;
        Image::make($decodedCa)
        ->resize(300,300)
        ->save($pathCa,50);
        //Photo Counting Acknowledgment//

        /*Inpector next container//
        $explodedIc = explode(',',$request->inspContPh);
        $decodedIc = base64_decode($explodedIc[1]);
        if(str_contains($explodedIc[0],'jpeg'))
        $extensionIc = 'jpeg';
        else
        $extensionIc = 'jpg';
        $fileNameIc = str_random().'.'.$extensionIc;
        $pathIc = public_path('files/').$fileNameIc;
        Image::make($decodedIc)
        ->resize(300,300)
        ->save($pathIc,50);
        //Inpector next container*/

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


        $detailInsp = new Cciaction();
        $detailInsp->iddetail = $request->iddetail;
        $detailInsp->item_number= $request->item_number;
        $detailInsp->spare_parts= $request->spare_parts;
        $detailInsp->item_cnts = $request->item_cnts;
        $detailInsp->sp_cnts = $request->sp_cnts;
        $detailInsp->total_cnts = $request->total_cnts;
        $detailInsp->damaged_cnts = $request->damaged_cnts;
        $detailInsp->pallet_fumigate = $request->pallet_fumigate;
        $detailInsp->container_number = $request->container_number;
        $detailInsp->seal_number = $request->seal_number;
        $detailInsp->container_numberph = $fileName;
        $detailInsp->seal_numberph = $fileNameSn;
        $detailInsp->fty_cooperate = $request->fty_cooperate;
        $detailInsp->remarks = $request->remarks;
        $detailInsp->result = $request->result;
        $detailInsp->container_damaged = $request->container_damaged;
        $detailInsp->pallets_loaded   = $request->pallets_loaded;
        //$detailInsp->packing_listPh = $fileNamePl;
        $detailInsp->ack_Ph = $fileNameAck;
        //$detailInsp->c1ack_Ph = $fileNameC1;
        //$detailInsp->c2ack_Ph = $fileNameC2;
        $detailInsp->count_ck_Ph = $fileNameCa;
        //$detailInsp->inspContPh = $fileNameIc;
        $detailInsp->save();

        $detail = Inspdetail::where('idservice','=',$ids)->first();
        $detail->check_out = Carbon::now(new \DateTimeZone('Asia/Shanghai'));
        $detail->check_outPH = $fileNameCo;
        $detail->save();

        $service = Service::findOrFail($request->idservice);
        $service->idistatus = 6;
        $service->save();

        DB::commit();

        } catch (Exception $e) {
          DB::rollback();
        }
    }
}
