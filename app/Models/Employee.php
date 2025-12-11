<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'photo', // Nueva Columna para fotos de los empleados
        'position',
        'hire_date',
        'department_id', // Nueva Columna para el departamento
    ];

    // Se crea la función departament
    public function department()
    {
        // Un empleado PERTENECE A (Belongs To) un Departamento
        return $this->belongsTo(Department::class);
    }
}
