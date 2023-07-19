<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HabilityErrorType extends Model
{
    protected $table = "habilities_error_types";

    public function habilities()
    {
        return $this->belongsToMany(Hability::class, 'hability_id');
    }

    public function errorTypes()
    {
        return $this->belongsToMany(ErrorType::class, 'error_type_id');
    }
}
