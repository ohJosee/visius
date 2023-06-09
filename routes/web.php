<?php
use App\Models\Administradores;

use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\EmpleadosPdfController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\TareasPdfController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ReportesPdfController;
use App\Http\Controllers\AdministradoresController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Vista pantalla de inicio
Route::get('/home', function () {
    return view('inicio');
})->middleware('auth');

//Rutas para loging
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('inicio');

/////////////////////////////
//       USUARIOS          //
/////////////////////////////

    // [VISTA DE USUARIOS REGISTRADOS]
Route::get('/gestion-usuarios', [UsuariosController::class, 'index']);

    // [VISTA PARA EDITAR USUARIOS]
Route::get('/usuarios/edit/{user}', [UsuariosController::class, 'edit']);

Route::put('/usuarios/update/{user}', [UsuariosController::class, 'update']);

Route::delete('/usuarios/destroy/{id}', [UsuariosController::class, 'destroy']);

/////////////////////////////
//       EMPLEADOS         //
/////////////////////////////

    // [Vista para mostrar empleados donde carga los datos de la tabla empleados]
Route::get('/gestion-empleados', [EmpleadosController::class, 'index']);

Route::get('/administrador/userCreate', [RolesController::class, 'index']);

/////////////////////////////////////
//      ASIGNAR AREA EMPLEADO      //
/////////////////////////////////////

    // [Vista para mostrar la asignación del área al empleado]
Route::get('/edit/asignar-area/{selEmpleado}', [EmpleadosController::class, 'edit']);
    // [Ruta para actualizar al empleado en la tabla Empleados con el área asignada]
Route::put('/update/asignar-area/{selEmpleado}', [EmpleadosController::class, 'update']);

//////////////////////
//      TAREAS      //
//////////////////////

    // [VISTA MUESTRA FORMULARIO CREAR TAREAS]
Route::get('/CreateTareas', function () {
    return view('/administrador/createTarea');
});

    // [RUTA CREAR TAREAS]
Route::post('/tareas/store', [TareasController::class, 'store']);

    // [RUTA CREAR TAREAS]
Route::get('/tareas/revision/{selTarea}', [TareasController::class, 'revision']);

    // [VISTA MOSTRAR TAREAS]
Route::get('/tareas/show', [TareasController::class, 'index']);
Route::get('/tareas/estadoTareas', [TareasController::class, 'estadoTareas']);

    //finalizar tarea
Route::get('/tarea/finalizada/{selTarea}', [TareasController::class, 'finalizada']);



//////////////////////////////////////
//      ASIGNAR TAREA EMPLEADO      //
//////////////////////////////////////

    // [VISTA QUE CARGARÁ LOS DATOS DE LA TAREA PARA PODERLA ASIGNAR A UN EMPLEADO]
Route::get('/edit/asignar-tarea/{selTarea}', [TareasController::class, 'edit']);
    
    // [RUTA QUE MANDARÁ A ACTUALIZAR LOS CAMBIOS DE LA TAREA Y PARA ASIGNARLA]
Route::put('/update/asignar-tarea/{selTarea}', [TareasController::class, 'update']);

//////////////////////////////////////
//          REPORTES PDF            //
//////////////////////////////////////

// [VISTA REPORTES]
Route::get('/reportes', [ReportesPdfController::class, 'index']);

// [ EMPLEADOS-PDF ]
    // [Generar reportes todos los empleados <Generar y descargar>]
Route::get('/reporte-empleadosTodos', [ReportesPdfController::class, 'reporteEmpleadosMostrar']);
Route::get('/reporte-empleadosDescargar', [ReportesPdfController::class, 'reporteEmpleadosDescargar']);
    // [Generar reportes de los empleados según el área]
Route::post('/reporte-empleadosArea', [ReportesPdfController::class, 'reporteEmpleadosArea']);

// [REPORTE DE TAREAS SEGÚN EMPLEADO]
Route::post('/reporte-tareasEmpleados', [ReportesPdfController::class, 'reporteTareasEmpleados']);
// [REPORTE DE TAREAS SEGUN EL ÁREA]
Route::post('/reportes-tareasArea', [ReportesPdfController::class, 'reporteEstadoTareasArea']);



