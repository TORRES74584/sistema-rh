<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function employees()
    {
        // Un departamento TIENE MUCHOS (Has Many) empleados
        return $this->hasMany(Employee::class);
    }
}
