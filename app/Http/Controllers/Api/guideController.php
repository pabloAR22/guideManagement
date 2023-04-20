<?php

namespace App\Http\Controllers\Api;

use App\Exports\GuidesExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guide;
use Illuminate\support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Facades\Excel;


class guideController extends Controller
{
    public function assignGuide(Request $request){
        $request->validate([
            'nameGuide' => 'required',
            'iddelivery' => 'required'
        ]);

        $idToValidate = $request->input('iddelivery');
        $getRol = DB::table('users')->whereId($idToValidate)->first()->idRol;

        if($getRol !== 1){
            return response()->json([
                "message " => "Error, el usuario no es un mensajero."
            ], Response::HTTP_OK);
        } else {
            $guide = new Guide();
            $guide->nameGuide = $request->nameGuide;
            $guide->iddelivery = $request->iddelivery;
            $guide->save();

            return response()->json([
                "message " => "Guia registrada."
            ], Response::HTTP_OK);
        }
    }

    public function deleteAllGuides(){
        $checkTable = Guide::first();

        if(! $checkTable == null){
            $guides = Guide::all();
            foreach($guides as $guide){
                $guide->delete();
            }

            return response()->json([
                "message" => "Se limpiaron las guías"
            ], Response::HTTP_OK);
        }else{
            return response()->json([
                "Alerta" => "No hay guias a eliminar"
            ], Response::HTTP_OK);
        }
    }

    public function createFileName(){
        date_default_timezone_set('America/Bogota');
        $date = date('Y-m-d H:i:s');
        $str = str_replace(array(":"," ", "-"), '', $date);
        $fileName = 'ASIGNACION_'.$str.'.xlsx';
        return $fileName;
    }

    public function createFile(){
        $fileName = $this->createFileName();
        return Excel::download(new GuidesExport, $fileName, \Maatwebsite\Excel\Excel::XLSX);
    }

    public function deliveryWithMostGuides(){
        $v = DB::table('guides')
                ->join('users', 'guides.iddelivery', '=', 'users.id')
                ->select('users.name', DB::raw('COUNT(iddelivery) AS total_guias'))
                ->groupBy('users.name')
                ->orderBy('total_guias', 'desc')
                ->limit(1)
                ->get();
        return($v);
    }
}
