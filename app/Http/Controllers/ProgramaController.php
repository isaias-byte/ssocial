<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $programas = Programa::where('calendario', 'like', '20%')->get();
        $programas = Programa::all();
        return view('programa.programa-index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('programa.programa-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());//! Nos da un mensaje donde vemos la información de la tabla, nos sirve para testing
        // $programa = new Programa();
        // $programa->calendario = $request->calendario;
        // $programa->folio = $request->folio;
        // $programa->nombre = $request->nombre;
        // $programa->dependencia = $request->dependencia;
        // $programa->titular = $request->titular;
        // $programa->save();
        //! lo de arriba nos sirve como ejemplo para insertar de manera "manual" los registros

        $programa = Programa::create($request->all());

        return redirect()->route('programa.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function show(Programa $programa)
    {
        return view('programa.programa-show', compact('programa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function edit(Programa $programa)
    {
        return view('programa.programa-form', compact('programa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programa $programa)
    {
        // $programa->calendario = $request->calendario;
        // $programa->folio = $request->folio;
        // $programa->nombre = $request->nombre;
        // $programa->dependencia = $request->dependencia;
        // $programa->titular = $request->titular;
        // $programa->save();
        //!Forma más tardada para actualizar en la base de datos
        Programa::where('id', $programa->id)->update($request->except('_token', '_method'));

        return redirect()->route('programa.show', $programa);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programa $programa)
    {
        $programa->delete();
        return redirect()->route('programa.index');
    }
}
