<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'avatar',
        'role',
        'hability_id'
    ];

    public function getAvatarUrl()
    {
        return Storage::url($this->avatar);
    }

    public function hability()
    {
        return $this->belongsTo(Hability::class);
    }

    // public function errorTypes()
    // {
    //     return $this->hasManyThrough();
    // }
}
