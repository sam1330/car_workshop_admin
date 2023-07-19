<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\ErrorType;
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
        $nivelError = [
            'alto' => 3,
            'medio' => 2,
            'bajo' => 1
        ];

        $data["type"] = $request->input('type') ? $request->input('type') : null;
        $data["date"] = $request->input('date') ? $request->input('date') : null;
        $data["details"] = $request->input('details') ? $request->input('details') : null;
        $data["location"] = $request->input('location') ? $request->input('location') : null;
        $data["customer_id"] = $request->input('customer') ? $request->input('customer') : null;
        $data["employee_id"] = $request->input('employee') ? $request->input('employee') : null;
        $data["fallas"] = $request->input('fallas') ? $request->input('fallas') : null;

        $majorError = null;
        foreach ($data["fallas"] as $falla) {
            $falla = ErrorType::find($falla);
            if(!isset($majorError)) {
                $majorError = $falla;
            } else if($nivelError[$falla->difficulty] > $nivelError[$majorError->difficulty]) {
                $majorError = $falla;
            }
        }

        $employee = Employee::where('hability_id', $majorError->habilities()->first()->hability_id)->first();

        $data["employee_id"] = $employee->id;

        $reservation = Reservation::create($data);

        return response()->json($reservation);
    }
}
