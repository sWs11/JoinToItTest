<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employee\SaveEmployee;
use App\Models\Employee;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $employees = Employee::select(['companies.name AS company_name', 'employees.*'])
            ->leftJoin('companies', 'employees.company_id', 'companies.id')
            ->orderBy('employees.id', 'DESC')
            ->paginate(10);

        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveEmployee $saveEmployee
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SaveEmployee $saveEmployee)
    {
        Employee::create([
            'first_name' => $saveEmployee->first_name,
            'last_name' => $saveEmployee->last_name,
            'company_id' => $saveEmployee->company_id,
            'email' => $saveEmployee->email,
            'phone' => $saveEmployee->phone,
        ]);

        return redirect()->back()->with('success', 'Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $employee = Employee::select(['companies.name AS company_name', 'employees.*'])
            ->leftJoin('companies', 'employees.company_id', 'companies.id')
            ->findOrFail($id);

        return view('employees.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $employee = Employee::select(['companies.name AS company_name', 'employees.*'])
            ->leftJoin('companies', 'employees.company_id', 'companies.id')
            ->findOrFail($id);

        return view('employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SaveEmployee $saveEmployee
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SaveEmployee $saveEmployee, $id)
    {
        $employee = Employee::findOrFail($id);

        $employee->fill([
            'first_name' => $saveEmployee->first_name,
            'last_name' => $saveEmployee->last_name,
            'company_id' => $saveEmployee->company_id,
            'email' => $saveEmployee->email,
            'phone' => $saveEmployee->phone,
        ]);

        $employee->save();

        return redirect()->back()->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }
}
