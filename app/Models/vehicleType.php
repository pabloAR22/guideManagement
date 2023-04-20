<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicleType extends Model
{
    use HasFactory;

    protected $table = "vehicle_types";

    protected $fillable = [
        "name",
        'created_at',
        'updated_at'
    ];
}
