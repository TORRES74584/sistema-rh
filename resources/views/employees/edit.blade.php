<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Empleado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                        @csrf
                        @method('PUT') ```
                        <div>
                            <label for="first_name">Nombre</label>
                            <input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ old('first_name', $employee->first_name) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <label for="last_name">Apellido</label>
                            <input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ old('last_name', $employee->last_name) }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="email">Email</label>
                            <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $employee->email) }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="position">Puesto</label>
                            <input id="position" class="block mt-1 w-full" type="text" name="position" value="{{ old('position', $employee->position) }}" required />
                        </div>

                        <div class="mt-4">
                            <label for="hire_date">Fecha de Contratación</label>
                            <input id="hire_date" class="block mt-1 w-full" type="date" name="hire_date" value="{{ old('hire_date', $employee->hire_date) }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Actualizar Empleado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>