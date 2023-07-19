<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ErrorType;
use Illuminate\Http\Request;

class ErrorTypeController extends Controller
{
    public function index()
    {
        $errors = ErrorType::all();
        return response()->json($errors);
    }
}
