<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Prestador;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    private $rules;
    public function __construct()
    {
        //! Aplicando un middleware en el controlador de Programas
        $this->middleware('auth');
        $this->rules = [
            'nombre' => ['required', 'string', 'min:2', 'max:255'],
            'titular' => ['required', 'string', 'min:2', 'max:255'],
            'dependencia' => 'required|string|max:255',
            'calendario' => 'required|string|min:4|max:6',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $programas = Programa::where('calendario', 'like', '20%')->get();
        // $programas = Programa::all();
        //!Se muestra el listado de programas solo de usuarios logueados
        $programas = Auth::user()->programas;
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
        // dd($request->user());
        $request->validate($this->rules + ['folio' => ['required','integer','unique:App\Models\Programa,folio']]);
        
        //! Una forma de hacer lo de uno a muchos...
        // $request->merge(['user_id' => $request->user()->id]);
        
        // Programa::create($request->all());
        //! Otra forma de hacer la relación de uno a muchos...
        $programa = new Programa($request->all());
        //* El modelo padre es el que tiene muchos, en este caso como el padre es user, usamos directamente el Auth user, pero si usamos otro modelo sería como viene abajo
        // $modeloPadre = ModeloPadre::find($idModeloPadre);
        $user = Auth::user();
        $user->programas()->save($programa);

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
        $prestadores = Prestador::get();
        return view('programa.programa-show', compact('programa', 'prestadores'));
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
        $request->validate($this->rules + ['folio' => ['required','integer', Rule::unique('programas')->ignore($programa->id),]]);
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

    /**
     * //*Agrega un prestador a un programa
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Programa  $programa
     * @return \Illuminate\Http\Response
     */

    public function agregarPrestador(Request $request, Programa $programa) {
        // dd($request->all(), $programa);
        // $programa->prestadores()->sync($request->prestador_id);
        $programa->prestadores()->sync($request->prestador_id);

        return redirect()->route('programa.show', $programa->id);
    }
}
