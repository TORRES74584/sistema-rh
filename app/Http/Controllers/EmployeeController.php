<?php

namespace App\Http\Controllers;

use App\Models\Employee; // 1.- IMPORTANDO EL MODELO EMPLEADO
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // IMPORTANDO EL MODELO Almacenamiento
use App\Models\Department; // IMPORTANDO EL MODELO DEPARTAMENTO

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
        // Obtenemos todos los departamentos de la base de datos
        $departments = Department::all();

        // Se le pasa a la vista 
        return view('employees.create', ['departments' => $departments]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        // 1. Obtenemos los datos validados del "Guardia"
        $data = $request->validated();

        // 2. ¿El usuario subió una foto?
        if ($request->hasFile('photo')) {
            // A. Guardamos el archivo en la carpeta 'employees_photos' dentro del disco 'public'
            $path = $request->file('photo')->store('employees_photos', 'public');

            // B. Guardamos LA RUTA (ej: "employees_photos/foto.jpg") en el array de datos
            $data['photo'] = $path;
        }

        // 3. Creamos el empleado usando el array $data (que ya incluye la ruta de la foto si la hubo)
        Employee::create($data);

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
        $departments = Department::all();
        return view('employees.edit', ['employee' => $employee, 'departments' => $departments]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        // 1. Obtenemos los datos validados (nombre, email, etc.)
        $data = $request->validated();

        // 2. ¿Subieron una foto NUEVA?
        if ($request->hasFile('photo')) {
            
            // A. Si el empleado ya tenía una foto vieja, la borramos del disco
            if ($employee->photo) {
                Storage::disk('public')->delete($employee->photo);
            }

            // B. Guardamos la nueva foto
            $data['photo'] = $request->file('photo')->store('employees_photos', 'public');
        }

        // 3. Actualizamos la base de datos
        $employee->update($data);

        // 4. Redirigimos
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
