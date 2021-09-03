@extends('layouts.temp')
@section('contenido')
    <h1>Detalle del Programa</h1>

    <p>
        <a href="{{ route('programa.index') }}">Listado de programas</a>
    </p>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Calendario</th>
                <th>Folio</th>
                <th>Nombre</th>
                <th>Dependencia</th>
                <th>Titular</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $programa->id }}</td>
                <td>{{ $programa->calendario }}</td>
                <td>{{ $programa->folio }}</td>
                <td>{{ $programa->nombre }}</td>
                <td>{{ $programa->dependencia }}</td>
                <td>{{ $programa->titular }}</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('programa.destroy', $programa) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Eliminar Programa">
    </form>
    
@endsection