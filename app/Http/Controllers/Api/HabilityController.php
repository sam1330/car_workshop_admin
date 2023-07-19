<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hability;
use Illuminate\Http\Request;

class HabilityController extends Controller
{
    public function index()
    {
        $habilities = Hability::all();
        return response()->json($habilities);
    }
}
