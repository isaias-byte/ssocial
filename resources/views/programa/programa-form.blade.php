@extends('layouts.temp')
@section('contenido')
    <h1>Formulario de Programa</h1>

    <p>
        <a href="{{ route('programa.index') }}">Listado de Programa</a>
    </p>
    
    @if(isset($programa))
    <!-- Edición de programa -->
        <form action="{{ route('programa.update', $programa) }}" method="POST">
            @method('PATCH')
    @else
    <!-- Creación de programa -->
        <form action="{{ route('programa.store') }}" method="POST">
    @endif
            @csrf
            <label for="calendario">Calendario</label>
            <input type="text" name="calendario" id="calendario" value="{{ $programa->calendario ?? '' }}">
            <br>

            <label for="folio">Folio</label>
            <input type="text" name="folio" id="folio" value="{{ $programa->folio ?? ''}}">
            <br>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ $programa->nombre ?? ''}}">
            <br>

            <label for="titular">Titular</label>
            <input type="text" name="titular" id="titular" value="{{ $programa->titular ?? ''}}">
            <br>

            <label for="dependencia">Dependencia</label>
            <input type="text" name="dependencia" id="dependencia" value="{{ $programa->dependencia ?? ''}}">
            <br>

            <input type="submit" value="Guardar">
    </form>
@endsection