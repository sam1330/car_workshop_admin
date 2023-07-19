<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorType extends Model
{
    protected $table = "error_types";

    public function habilities()
    {
        return $this->hasMany(HabilityErrorType::class, 'error_type_id');
    }
}
