<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hability extends Model
{
    use HasFactory;

    protected $table = "habilities";

    public function errorTypes()
    {
        return $this-> hasMany(HabilityErrorType::class);
    }
}
