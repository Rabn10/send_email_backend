<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employee = Employee::where('delete_flag', 0)->orderBy('id','asc')->get();
            return response()->json([
                'status' => 1,
                'data' => $employee
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $employee = new Employee();
            $employee->name = $request->name;
            $employee->age = $request->age; 
            $employee->position = $request->position; 
            $employee->salary = $request->salary;
            $employee->save();
            return response()->json([
                'status' => 1,
                'message' => 'employee added.'
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $employee = Employee::where('id', $id)->where('delete_flag',0)->first();
            return response()->json([
                'status' => 1,
                'data' => $employee
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $employee = Employee::where('id',$id)->where('delete_flag', 0)->first();

            if($employee == null) {
                return response()->json([
                    'status' => 0,
                    'message' => 'employee not found.'
                ]);
            }

            $employee->name = $request->name;
            $employee->age = $request->age; 
            $employee->position = $request->position; 
            $employee->salary = $request->salary;
            $employee->save();
            return response()->json([
                'status' => 1,
                'message' => 'employee updated.'
            ]);
        } 
        catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::where('id',$id)->first();
            $employee->delete_flag = true;
            $employee->save();
            return response()->json([
                'status' => 1,
                'message' => 'Successfully Deleted'
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }
}
