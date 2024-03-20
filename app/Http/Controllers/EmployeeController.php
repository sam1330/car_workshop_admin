<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Employee;
use App\Models\Hability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            return response(
                Employee::with(['hability'])->get()
            );
        }
        $employees = Employee::with(['hability'])->latest()->paginate(10);
        return view('employees.index')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $habilities = Hability::all();
        return view('employees.create', ['habilities' => $habilities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        $avatar_path = '';

        if ($request->hasFile('avatar')) {
            $avatar_path = $request->file('avatar')->store('employees', 'public');
        }

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatar_path,
            'role' => $request->role,
            'hability_id' => $request->hability,
        ]);

        if (!$employee) {
            return redirect()->back()->with('error', 'Sorry, Hubo un problema creando el empleado.');
        }
        return redirect()->route('employees.index')->with('success', 'Success, Su empleado ha sido creado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->role = $request->role;

        if ($request->hasFile('avatar')) {
            // Delete old avatar
            if ($employee->avatar) {
                Storage::delete($employee->avatar);
            }
            // Store avatar
            $avatar_path = $request->file('avatar')->store('employees', 'public');
            // Save to Database
            $employee->avatar = $avatar_path;
        }

        if (!$employee->save()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating employee.');
        }
        return redirect()->route('employees.index')->with('success', 'Success, your employee have been updated.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->avatar) {
            Storage::delete($employee->avatar);
        }

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Empleado eliminado.');
    }
}
