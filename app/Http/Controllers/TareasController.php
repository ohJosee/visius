<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Areas;
use App\Models\Tareas;
use App\Models\Empleados;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TareasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tareas::all();
        return view('/tareas/read', ['tareas'=>$tareas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $areas = Areas::all();
        // return view('/administrador/createTarea', ['areas'=>$areas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'tarNombre'=>'required',
            'tarDescripcion'=>'required',
        ]);

        $data['tarEstado'] = 'Creada';
        $data['tarFechaAsignada'] = 'Null';
        $data['tarFechaFinalizada'] = 'Null';


        // Emviar insert
        Tareas::create($data);

        //Redireccionar
        return redirect('/tareas/show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tareas $selTarea)
    {

        $empleados = Empleados::all();
        
        $users = User::select()
        ->where('userRol', '=', 3)
        ->get();

        return view('/tareas/asignarTarea', ['selTarea'=>$selTarea, 'empleados'=>$empleados, 'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tareas $selTarea)
    {
        
        //Validamos datos
        $datos = request()->validate([
            'tarEmpleado' => 'required'
        ]);

        //Reemplazamos datos por nuevos
        $selTarea->tarEstado = 'Asignado';
        $selTarea->tarEmpleado = $datos['tarEmpleado'];
        $selTarea->tarFechaAsignada = Carbon::now();

        //Guardamos
        $selTarea->save();

        return redirect('/tareas/show');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
