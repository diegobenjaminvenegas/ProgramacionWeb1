<?php

use Illuminate\Routing\Router;



Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('cursos', CursoController::class);
    $router->resource('materias', MateriaController::class);
    $router->resource('curso-materias', CursoMateriaController::class);
    $router->resource('docentes', DocenteController::class);
    $router->resource('inscripcions', InscripcionController::class);
    $router->resource('actividads', ActividadController::class);
    $router->resource('notas', NotasController::class);
    $router->resource('asistencias', AsistenciaController::class);

});
