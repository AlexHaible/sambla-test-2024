<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return Employee::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:employees',
            'ssn' => 'required|string',
            'phone' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'dob' => 'required|date',
            'salary' => 'required|numeric',
            'employmentfrom' => 'required|date',
            'employmentto' => 'nullable|date',
            'currentlyworking' => 'required|boolean'
        ]);

        $employee = Employee::create($validated);

        return response()->json($employee, 201);
    }

    public function show($id)
    {
        return Employee::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'email' => 'sometimes|required|email|unique:employees,email,' . $id,
            'ssn' => 'sometimes|required',
            'phone' => 'sometimes|required',
            'firstname' => 'sometimes|required',
            'lastname' => 'sometimes|required',
            'dob' => 'sometimes|required|date',
            'salary' => 'sometimes|required|numeric',
            'employmentfrom' => 'sometimes|required|date',
            'employmentto' => 'sometimes|nullable|date',
            'currentlyworking' => 'sometimes|required|boolean'
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($validated);

        return response()->json($employee, 200);
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return response()->json(null, 204);
    }
}
