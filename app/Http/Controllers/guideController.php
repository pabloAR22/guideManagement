<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class guideController extends Controller
{
    public function validateDelyvery(Request $request){
        $request->validate([
            'nameGuide' => 'required',
            'idDelivery' => 'required'
        ]);

        $idToValidate = $request->input('idDelivery');
        $getRol = DB::table('users')
                    ->where('idUser', $idToValidate)
                    ->get();

        if($getRol != 1){
            return response()->json([
                "message " => "Error, el usuario no es un mensajero."
            ], Response::HTTP_OK);
        }
    }
}
