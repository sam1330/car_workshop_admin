<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Reservation::where('customer_id', 1)->get());
    }

    public function store(Request $request)
    {
        $data["type"] = $request->input('type') ? $request->input('type') : null;
        $data["date"] = $request->input('date') ? $request->input('date') : null;
        $data["details"] = $request->input('details') ? $request->input('details') : null;
        $data["location"] = $request->input('location') ? $request->input('location') : null;
        $data["customer_id"] = $request->input('customer') ? $request->input('customer') : null;
        $data["employee_id"] = $request->input('employee') ? $request->input('employee') : null;
        

        $reservation = Reservation::create($data);

        return response()->json($reservation);
    }
}
