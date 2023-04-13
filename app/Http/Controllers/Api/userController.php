<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Rol;
use Illuminate\support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            "Lista de usuarios: " => $users
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idValidate = $request->input('idRol');
        if($idValidate == 1){
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'cellphone' => 'required|numeric|unique:users',
                'age' => 'required|numeric',
                'idRol' => 'required|numeric',
                'plate' => 'required|unique:vehicles',
                'type' => 'required',
                'password' => 'required|confirmed'
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->cellphone = $request->cellphone;
            $user->age = $request->age;
            $user->idRol = $request->idRol;
            $user->password = Hash::make($request->password);
            $user->save();

            $vehicle = new Vehicle();
            $vehicle->idUser = $user->id;
            $vehicle->plate = $request->plate;
            $vehicle->type = $request->type;
            $vehicle->save();

        } else {
            $request->validate([
                'name'=>'required',
                'lastname'=>'required',
                'cellphone'=>'required|unique:users',
                'age'=>'required',
                'idRol'=>'required',
                'password'=>'required|confirmed',
            ]);

            $user = new User();
            $user->name = $request->name;
            $user->lastname = $request->lastname;
            $user->cellphone = $request->cellphone;
            $user->age = $request->age;
            $user->idRol = $request->idRol;
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response()->json([
            "User created: " => $user
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        return response()->json([
            "result" => $user
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idUsuario)
    {
        $idValidate = $request->input('idRol');
        if($idValidate == 1){
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'cellphone' => 'required|numeric|unique:users',
                'age' => 'required|numeric',
                'idRol' => 'required|numeric',
                'plate' => 'required|unique:vehicles',
                'type' => 'required',
                'password' => 'required|confirmed'
            ]);
            DB::table('vehicles')
                ->where('idUser', $idUsuario)
                ->update([
                    'idUser' => $idUsuario,
                    'plate' => $request->plate,
                    'type' => $request->type,
                ]);
            DB::table('users')
                ->where('id', $idUsuario)
                ->update([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'cellphone' => $request->cellphone,
                    'password' => Hash::make($request->password),
                    'age' => $request->age,
                    'idRol' => $request->idRol
                ]);
        } else {
            $request->validate([
                'name'=>'required',
                'lastname'=>'required',
                'cellphone'=>'required|unique:users',
                'age'=>'required',
                'idRol'=>'required',
                'password'=>'required|confirmed',
            ]);
            DB::table('users')
                ->where('id', $idUsuario)
                ->update([
                    'name' => $request->name,
                    'lastname' => $request->lastname,
                    'cellphone' => $request->cellphone,
                    'password' => Hash::make($request->password),
                    'age' => $request->age,
                    'idRol' => $request->idRol
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vehicle::where('idUser', $id)->delete();
        User::find($id)->delete();

        return response()->json([
            "result" => "El usuario fue eliminado"
        ], Response::HTTP_OK);
    }
}
