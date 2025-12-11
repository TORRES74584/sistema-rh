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
        Schema::table('employees', function (Blueprint $table) {
            // Creamos la columna 'department_id'
            // constrained(): Le dice a Laravel que esto se conecta con la tabla 'departments'
            // onDelete('set null'): Si borras el departamento, el empleado se queda sin depa (null), pero no se borra el empleado.
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Borramos la columna y la conexión
            $table->dropForeign(['department_id']);
            $table->dropColumn('department_id');
        });
    }
};
