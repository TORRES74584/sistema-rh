<?php

namespace App\Http\Controllers;

use App\Models\Employee; // 1.- IMPORTANDO EL MODELO EMPLEADO
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Obtenemos el texto del buscador (si está vacío, será null)
        $search = $request->input('search');

        // 2. Iniciamos la consulta (aún no pedimos los datos, solo preparamos)
        $query = Employee::query();

        // 3. Si el usuario escribió algo, agregamos los filtros
        if ($search) {
            $query->where('first_name', 'like', '%'. $search . '%')
                ->orWhere('last_name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }

        // 4. Ahora sí, ejecutamos la consulta y guardamos los resultados
        $employees = $query->paginate(10)->withQueryString();

        // 5. Enviamos los empleados a la vista (igual que antes)
        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Simplemente devuelve la vista que contiene el formulario de creación
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // 1. Crear el empleado (Laravel ya validó los datos automáticamente antes de entrar aquí)
        Employee::create($request->validated());

        // 2. Redirigir al usuario a la lista de empleados con un mensaje de éxito
        return redirect()->route('employees.index')->with('success', '¡Empleado creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // Laravel automáticamente encuentra el empleado por su ID gracias al "Route Model Binding"
        return view('employees.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // Ya no hay validación aquí, el "Guardia" lo hizo en la entrada

        // Actualizamos
        $employee->update($request->validated());

        // Redirige con mensaje de éxito
        return redirect()->route('employees.index')->with('success', '¡Empleado actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // 1. Borra al empleado de la base de datos
        $employee->delete();

        // 2. Nos regresa a la lista avisando que todo salió bien
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado correctamente');
    }
}
