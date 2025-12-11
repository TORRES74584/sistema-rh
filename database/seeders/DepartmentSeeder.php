<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Importa el modelo arriba con: use App\Models\Department;

        \App\Models\Department::create(['name' => 'Recursos Humanos']);
        \App\Models\Department::create(['name' => 'Tecnología']);
        \App\Models\Department::create(['name' => 'Ventas']);
        \App\Models\Department::create(['name' => 'Contabilidad']);
    }
}
