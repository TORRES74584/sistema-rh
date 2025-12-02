<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // ID único para cada empleado
            $table->string('first_name'); // Nombre del empleado
            $table->string('last_name'); // Apellido del empleado
            $table->string('email'); // Email, debe ser único
            $table->string('position'); // Puesto de trabajo
            $table->date('hire_date'); // Fecha de contratación
            $table->timestamps(); // Crea las columnas 'create_at' y 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
