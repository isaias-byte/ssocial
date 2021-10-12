@extends('layouts.windmill')
@section('contenido')

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Detalle del Programa
    </h2>

    <div class="grid gap-6 mb-8 md:grid-cols-2">
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                {{ $programa->nombre }}
            </h4>
            <p class="text-gray-600 dark:text-gray-400">
                <ul>
                    <li>Dependencia: {{ $programa->dependencia }}</li>
                    <li>Calendario: {{ $programa->calendario }}</li>
                    <li>Titular: {{ $programa->titular }}</li>
                    <li>Folio: {{ $programa->folio }}</li>
                </ul>
            </p>
        </div>
        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                Prestadores del programa
            </h4>
            <p class="text-gray-600 dark:text-gray-400">
                <ul>
                    @foreach ($programa->prestadores as $prestador)
                        
                        <li>{{ $prestador->nombre }}</li>
                    @endforeach
                </ul>
            </p>
        </div>
    </div>
    <div class="grid gap-6 mb-8 md:grid-cols-2">

        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                Actualizar Prestadores
            </h4>
            <p class="text-gray-600 dark:text-gray-400">
                <form action="{{ route('programa.agregar-prestador', $programa->id) }}" method="POST">
                    @csrf
                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Seleccione Prestador
                        </span>
                        <select class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-multiselect focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray" multiple name="prestador_id[]">
                            @foreach ($prestadores as $prestador)
                                <option value="{{ $prestador->id }}" {{ array_search($prestador->id, $programa->prestadores->pluck('id')->toArray()) !== false ? 'selected' : '' }}>{{ $prestador->nombre }}</option>
                                
                            @endforeach

                        </select>
                        
                    </label>
                    <!-- Opción 1 para enviar programa_id -->
                    <!-- <input type="hidden" name="programa_id" value="{{ $programa->id }}"> -->
                <br>
                <input class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit"
                value="Agregar"
                >
                </input>
                </form>
            </p>
        </div>
    </div>

    <!-- <input class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        
    >
        <a href="{{ route('programa.index') }}">
            Listado de programas
        </a>
    </input> -->

    <!-- <p>
        <a href="{{ route('programa.index') }}">Listado de programas</a>
    </p> -->

    <form action="{{ route('programa.destroy', $programa) }}" method="POST">
        @csrf
        @method('DELETE')
        <input class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            type="submit"
            value="Eliminar Programa"
        >
        </input>
    </form>
    
@endsection