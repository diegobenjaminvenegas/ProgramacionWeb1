<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Inscripcion;
use App\Models\CursoMateria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Inscripcion';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Inscripcion());

        $grid->column('id', __('Id'));
        $grid->column('estudiante.name', __('Estudiante'))
             ->display(function () {
                 return $this->estudiante ? $this->estudiante->name : 'No disponible';
             });
        $grid->column('cursoMateria.curso.nombre', __('Curso'))
             ->display(function () {
                 return $this->cursoMateria ? $this->cursoMateria->curso->nombre : 'No disponible';
             });
        $grid->column('cursoMateria.materia.nombre', __('Materia'))
             ->display(function () {
                 return $this->cursoMateria ? $this->cursoMateria->materia->nombre : 'No disponible';
             });
        $grid->column('fecha', __('Fecha Inscripcion'));
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
        $show = new Show(Inscripcion::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('idEstudiante', __('Estudiante'))->as(function ($idEstudiante) {
            $estudiante = User::find($idEstudiante);
            return $estudiante ? $estudiante->name : 'No disponible';
        });
        $show->field('idCursoMateria', __('Curso Materia'))->as(function ($idCursoMateria) {
            $cursoMateria = CursoMateria::find($idCursoMateria);
            return $cursoMateria 
                ? $cursoMateria->curso->nombre . ' - ' . $cursoMateria->materia->nombre
                : 'No disponible';
        });
        $show->field('fecha', __('Fecha Inscripcion'));
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
        $form = new Form(new Inscripcion());

        // Campo idEstudiante: muestra el ID del usuario logueado y es solo lectura
        $form->text('idEstudiante', __('Estudiante'))
            ->default(Auth::id())
            ->readonly();

        // Campo idCursoMateria: desplegable con las opciones de CursoMateria
        $form->select('idCursoMateria', __('Curso Materia'))
            ->options(CursoMateria::all()->pluck('materia.nombre', 'id'));

        // Campo fecha: fecha actual y solo lectura
        $form->text('fecha', __('Fecha Inscripcion'))
            ->default(date('Y-m-d'))
            ->readonly();

        return $form;
    }
}
