<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;
    protected $fillable = [
        'nameGuide',
        'idDelivery'
    ];

    public function user()
    {
        return $this->belogsTo(User::class);
    }
}
