<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth/login');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('usuarios', [App\Http\Controllers\UsuarioController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{user}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('usuarios/{id}/editar', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('usuarios.editar');
    Route::put('usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('usuarios.update');
    Route::get('usuarios/{id}/modal', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('usuarios.delete');
    Route::get('/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('usuario.buscar');


    Route::resource('roles', App\Http\Controllers\RolController::class);
    Route::get('roles/{id}/modal', [App\Http\Controllers\RolController::class, 'destroy'])->name('roles.delete');
});

//Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

 Route::get('/sede/{id}/carrera', [App\Http\Controllers\MejoraController::class, 'byCarrera']);
 Route::get('/carrera/{id}/sede', [App\Http\Controllers\CarreraController::class, 'bySede']);
 Route::get('/detalle/{id}/propuesta', [App\Http\Controllers\RealizadaController::class, 'byPropuesta']);

    

Route::get('registro/facultad', [App\Http\Controllers\FacultadController::class, 'index']);
Route::get('registro/facultad/create', [App\Http\Controllers\FacultadController::class, 'create'])->name('facultad.create');
Route::post('registro/facultad',  [App\Http\Controllers\FacultadController::class, 'store'])->name('facultad.store');
Route::get('registro/facultad/{id}/edit', [App\Http\Controllers\FacultadController::class, 'edit'])->name('facultad.editar');
Route::put('registro/facultad/{id}', [App\Http\Controllers\FacultadController::class, 'update'])->name('facultad.update');
Route::get('registro/facultad/{id}/modal', [App\Http\Controllers\FacultadController::class, 'destroy'])->name('facultad.delete');
Route::get('registro/facultad/search', [App\Http\Controllers\FacultadController::class, 'index'])->name('facultad.buscar');

Route::get('registro/sede', [App\Http\Controllers\SedeController::class, 'index']);
Route::get('registro/sede/create', [App\Http\Controllers\SedeController::class, 'create'])->name('sede.create');
Route::post('registro/sede',  [App\Http\Controllers\SedeController::class, 'store'])->name('sede.store');
Route::get('registro/sede/{id}/edit', [App\Http\Controllers\SedeController::class, 'edit'])->name('sede.editar');
Route::put('registro/sede/{id}', [App\Http\Controllers\SedeController::class, 'update'])->name('sede.update');
Route::get('registro/sede/{id}/modal', [App\Http\Controllers\SedeController::class, 'destroy'])->name('sede.delete');
Route::get('registro/sede/search', [App\Http\Controllers\SedeController::class, 'index'])->name('sede.buscar');

Route::get('registro/carrera', [App\Http\Controllers\CarreraController::class, 'index']);
Route::get('registro/carrera/create', [App\Http\Controllers\CarreraController::class, 'create'])->name('carrera.create');
Route::post('registro/carrera',  [App\Http\Controllers\CarreraController::class, 'store'])->name('carrera.store');
Route::get('registro/carrera/{id}/edit', [App\Http\Controllers\CarreraController::class, 'edit'])->name('carrera.editar');
Route::put('registro/carrera/{id}', [App\Http\Controllers\CarreraController::class, 'update'])->name('carrera.update');
Route::get('registro/carrera/{id}/modal', [App\Http\Controllers\CarreraController::class, 'destroy'])->name('carrera.delete');
Route::get('registro/carrera/search', [App\Http\Controllers\CarreraController::class, 'index'])->name('carrera.buscar');

Route::get('registro/dimension', [App\Http\Controllers\DimensionController::class, 'index']);
Route::get('registro/dimension/create', [App\Http\Controllers\DimensionController::class, 'create'])->name('dimension.create');
Route::post('registro/dimension',  [App\Http\Controllers\DimensionController::class, 'store'])->name('dimension.store');
Route::get('registro/dimension/{id}/edit', [App\Http\Controllers\DimensionController::class, 'edit'])->name('dimension.editar');
Route::put('registro/dimension/{id}', [App\Http\Controllers\DimensionController::class, 'update'])->name('dimension.update');
Route::get('registro/dimension/{id}/modal', [App\Http\Controllers\DimensionController::class, 'destroy'])->name('dimension.delete');
Route::get('registro/dimension/search', [App\Http\Controllers\DimensionController::class, 'index'])->name('dimension.buscar');

Route::get('registro/periodo', [App\Http\Controllers\PeriodoController::class, 'index']);
Route::get('registro/periodo/create', [App\Http\Controllers\PeriodoController::class, 'create'])->name('periodo.create');
Route::post('registro/periodo',  [App\Http\Controllers\PeriodoController::class, 'store'])->name('periodo.store');
Route::get('registro/periodo/{id}/edit', [App\Http\Controllers\PeriodoController::class, 'edit'])->name('periodo.editar');
Route::put('registro/periodo/{id}', [App\Http\Controllers\PeriodoController::class, 'update'])->name('periodo.update');
Route::get('registro/periodo/{id}/modal', [App\Http\Controllers\PeriodoController::class, 'destroy'])->name('periodo.delete');
Route::get('registro/periodo/search', [App\Http\Controllers\PeriodoController::class, 'index'])->name('periodo.buscar');

Route::get('registro/responsable', [App\Http\Controllers\ResponsableController::class, 'index']);
Route::get('registro/responsable/create', [App\Http\Controllers\ResponsableController::class, 'create'])->name('responsable.create');
Route::post('registro/responsable',  [App\Http\Controllers\ResponsableController::class, 'store'])->name('responsable.store');
Route::get('registro/responsable/{id}/edit', [App\Http\Controllers\ResponsableController::class, 'edit'])->name('responsable.editar');
Route::put('registro/responsable/{id}', [App\Http\Controllers\ResponsableController::class, 'update'])->name('responsable.update');
Route::get('registro/responsable/{id}/modal', [App\Http\Controllers\ResponsableController::class, 'destroy'])->name('responsable.delete');
Route::get('registro/responsable/search', [App\Http\Controllers\ResponsableController::class, 'index'])->name('responsable.buscar');


Route::get('/transaccion/mejora', [App\Http\Controllers\MejoraController::class, 'index']);
Route::get('/transaccion/detalle/{id}/create', [App\Http\Controllers\MejoraController::class, 'createDetalle'])->name('detalle.create');
//Route::get("/detalle/listar", "MejoraController@create");
Route::get('/transaccion/detalle/create', [App\Http\Controllers\MejoraController::class, 'create']);

Route::post('/transaccion/detalle', [App\Http\Controllers\MejoraController::class, 'storeDetalle'])->name('detalle.store');
Route::get('/transaccion/detalle/{id}/editar', [App\Http\Controllers\MejoraController::class, 'editDetalle'])->name('detalle.edit');
Route::put('/transaccion/detalle/{id}', [App\Http\Controllers\MejoraController::class, 'updateDetalle'])->name('detalle.update');
Route::get('/transaccion/detalle/eliminar/{id}', [App\Http\Controllers\MejoraController::class, 'eliminar'])->name('delete.detalle');

Route::get('/transaccion/mejora/create', [App\Http\Controllers\MejoraController::class, 'create'])->name('mejora.create');
Route::post('/transaccion/mejora', [App\Http\Controllers\MejoraController::class, 'store'])->name('mejora.store');
Route::get('/transaccion/mejora/{id}/edit', [App\Http\Controllers\MejoraController::class, 'edit'])->name('mejora.editar');
Route::put('/transaccion/mejora/{id}', [App\Http\Controllers\MejoraController::class, 'update'])->name('mejora.update');
Route::get('/transaccion/mejora/{id}', [App\Http\Controllers\MejoraController::class, 'destroy'])->name('mejora.delete');
Route::get('/transaccion/mejora/search', [App\Http\Controllers\MejoraController::class, 'index'])->name('mejora.buscar');

Route::get('/transaccion/propuesta/{id}/create', [App\Http\Controllers\PropuestaController::class, 'create'])->name('propuesta.agregar');
Route::post('/transaccion/propuesta', [App\Http\Controllers\PropuestaController::class, 'store'])->name('propuesta.store');
Route::get('/transaccion/propuesta/{id}/edit', [App\Http\Controllers\PropuestaController::class, 'edit'])->name('propuesta.editar');
Route::put('/transaccion/propuesta/{id}', [App\Http\Controllers\PropuestaController::class, 'update'])->name('propuesta.update');
Route::get('/transaccion/propuesta/modal/{id}', [App\Http\Controllers\PropuestaController::class, 'eliminar'])->name('propuesta.eliminar');

Route::get('/transaccion/realizada', [App\Http\Controllers\RealizadaController::class, 'index']);
Route::get('/transaccion/realizada/{id}/create', [App\Http\Controllers\RealizadaController::class, 'create'])->name('realizada.agregar');
Route::post('/transaccion/realizada', [App\Http\Controllers\RealizadaController::class, 'store'])->name('realizada.store');
Route::get('/transaccion/realizada/{id}/ver_merora', [App\Http\Controllers\RealizadaController::class, 'verMejora'])->name('ver.mejora');
Route::get('/transaccion/realizada/{id}/ver_propuesta', [App\Http\Controllers\RealizadaController::class, 'verPropuesta'])->name('ver.propuesta');
Route::get('/transaccion/realizada/{id}/edit', [App\Http\Controllers\RealizadaController::class, 'edit'])->name('realizada.editar');
Route::put('/transaccion/realizada/{id}', [App\Http\Controllers\RealizadaController::class, 'update'])->name('realizada.update');
Route::get('/transaccion/realizada/modal/{id}', [App\Http\Controllers\RealizadaController::class, 'eliminar'])->name('realizada.eliminar');

Route::get('/transaccion/realizada/create', [App\Http\Controllers\RealizadaController::class, 'createArchivo'])->name('realizada.archivo');
Route::post('/transaccion/realizada/create', [App\Http\Controllers\RealizadaController::class, 'storeArchivo'])->name('archivo.store');


Route::get('chart/chartjs', [App\Http\Controllers\ChartJSController::class, 'index']);

Route::get('pdf/{id}/informe', [App\Http\Controllers\PdfController::class, 'informePDF'])->name('informe.general');
Route::get('pdf/{id}/mejora', [App\Http\Controllers\PdfController::class, 'mejoraPDF'])->name('mejora.propuesta');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


