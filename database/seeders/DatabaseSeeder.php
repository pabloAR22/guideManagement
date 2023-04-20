<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use App\Models\vehicleType;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $rol = new Rol();
        $rol->rolName = "Mensajero";
        $rol->save();

        $rol2 = new Rol();
        $rol2->rolName = "Administrador";
        $rol2->save();

        $user = new User();
        $user->name = 'Pablo';
        $user->lastname = 'Aristizabal';
        $user->cellphone = '350471';
        $user->age = '20';
        $user->idRol = 2;
        $user->password = Hash::make('password');
        $user->save();

        $typeVehicle = new vehicleType();
        $typeVehicle->name = 'Moto';
        $typeVehicle->save();

        $typeVehicle2 = new vehicleType();
        $typeVehicle2->name = 'Carro';
        $typeVehicle2->save();

        $typeVehicle3 = new vehicleType();
        $typeVehicle3->name = 'Bicicleta';
        $typeVehicle3->save();
    }
}
