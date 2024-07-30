<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Notas;
use App\Models\Actividad;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;

class NotasController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Notas';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Notas());

        $grid->column('id', __('Id'));
        
        // Mostrar el nombre de la actividad
        $grid->column('actividad.nombre', __('Actividad'))
            ->display(function () {
                return $this->actividad ? $this->actividad->nombre : '';
            });

        // Mostrar el nombre del estudiante
        $grid->column('estudiante.name', __('Estudiante'))
            ->display(function () {
                return $this->estudiante ? $this->estudiante->name : '';
            });

        $grid->column('nota', __('Nota'));
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
        $show = new Show(Notas::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('actividad.nombre', __('Actividad'));
        $show->field('estudiante.name', __('Estudiante'));
        $show->field('nota', __('Nota'));
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
        $form = new Form(new Notas());

        // Filtrar las actividades por el idProfesor del usuario logueado
        $idProfesor = Auth::id();
        $actividades = Actividad::where('idProfesor', $idProfesor)
            ->pluck('nombre', 'id');
        
        $form->select('idActividad', __('Actividad'))
            ->options($actividades);

        // Filtrar los estudiantes por los idCursoMateria de las actividades del profesor logueado
        $idCursoMaterias = Actividad::where('idProfesor', $idProfesor)
            ->pluck('idCursoMateria');

        $estudiantes = Inscripcion::whereIn('idCursoMateria', $idCursoMaterias)
            ->join('admin_users', 'inscripcion.idEstudiante', '=', 'admin_users.id')
            ->pluck('admin_users.name', 'inscripcion.idEstudiante');

        $form->select('idEstudiante', __('Estudiante'))
            ->options($estudiantes);

        $form->decimal('nota', __('Nota'));

        return $form;
    }
}
