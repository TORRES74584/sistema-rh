<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Tiene que ser verdadero true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Obtenemos al empleado de la ruta (Laravel sabe quién es por la URL)
        $employee = $this->route('employee');

        return [
            'first_name' => 'required|string|max:255',
            
            'last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'hire_date' => 'required|date',
            // REGLA ESPECIAL:
            // 'unique:tabla,columna,ID_A_IGNORAR'
            // Esto le dice: Revisa si el email existe, pero ignora el ID de este empleado actual.
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'photo' => 'nullable|image|max:2048',
            'department_id' => 'required|exists:departments,id',
        ];
    }
}
