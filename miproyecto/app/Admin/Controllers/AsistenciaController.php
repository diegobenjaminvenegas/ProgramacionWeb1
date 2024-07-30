<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\Asistencia;
use \App\Models\Cursomateria;
use \App\Models\Inscripcion;
use \App\Models\Estudiante;
use Illuminate\Support\Facades\Auth;

class AsistenciaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Asistencia';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Asistencia());

        $grid->column('id', __('Id'));

        // Mostrar el nombre del estudiante
        $grid->column('estudiante.name', __('Estudiante'))
            ->display(function () {
                return $this->estudiante ? $this->estudiante->name : '';
            });

        $grid->column('idCursoMateria', __('IdCursoMateria'));
        $grid->column('fecha', __('Fecha'));
        $grid->column('estado', __('Estado'))->display(function($estado) {
            switch ($estado) {
                case 0:
                    return 'Presente';
                case 1:
                    return 'Falta';
                case 2:
                    return 'Retraso';
                case 3:
                    return 'Licencia';
            }
        });
        //$grid->column('created_at', __('Created at'));
        //$grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Asistencia::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('estudiante.name', __('Estudiante'));
        $show->field('idCursoMateria', __('IdCursoMateria'));
        $show->field('fecha', __('Fecha'));
        $show->field('estado', __('Estado'))->as(function($estado) {
            switch ($estado) {
                case 0:
                    return 'Presente';
                case 1:
                    return 'Falta';
                case 2:
                    return 'Retraso';
                case 3:
                    return 'Licencia';
            }
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Asistencia());

        $user = Auth::user(); // Obtener el usuario logueado
        $profesorId = $user->id; // Asumimos que el ID del usuario es el ID del profesor

        // Obtener los cursos del profesor logueado
        $cursos = Cursomateria::where('idProfesor', $profesorId)->pluck('id', 'id');

        // Obtener los estudiantes inscritos en los cursos del profesor logueado
        $idCursoMaterias = Cursomateria::where('idProfesor', $profesorId)->pluck('id');
        $estudiantes = Inscripcion::whereIn('idCursoMateria', $idCursoMaterias)
            ->join('admin_users', 'inscripcion.idEstudiante', '=', 'admin_users.id')
            ->pluck('admin_users.name', 'inscripcion.idEstudiante');

        $form->select('idCursoMateria', __('IdCursoMateria'))->options($cursos);
        $form->select('idEstudiante', __('Estudiante'))->options($estudiantes);
        $form->date('fecha', __('Fecha'))->default(date('Y-m-d'));

        // Combo box para el estado con valores enteros
        $form->select('estado', __('Estado'))->options([
            0 => 'Presente',
            1 => 'Falta',
            2 => 'Retraso',
            3 => 'Licencia',
        ]);

        return $form;
    }
}
