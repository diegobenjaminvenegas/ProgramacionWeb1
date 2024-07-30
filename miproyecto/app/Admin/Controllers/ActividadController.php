<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\Actividad;
use App\Models\CursoMateria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ActividadController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Actividad';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Actividad());

        $grid->column('id', __('Id'));
        $grid->column('profesor.name', __('Profesor'));
        
        // Mostrar el nombre del curso y la materia usando las relaciones
        $grid->column('cursoMateria.curso.nombre', __('Curso'))
             ->display(function ($nombre) {
                 return $this->cursoMateria ? $this->cursoMateria->curso->nombre : '';
             });

        $grid->column('cursoMateria.materia.nombre', __('Materia'))
             ->display(function ($nombre) {
                 return $this->cursoMateria ? $this->cursoMateria->materia->nombre : '';
             });

        $grid->column('nombre', __('Nombre'));
        $grid->column('descripcion', __('Descripcion'));
        $grid->column('porcentajeNota', __('Porcentaje Nota'));
        $grid->column('fechaEntrega', __('Fecha Entrega'));
       // $grid->column('created_at', __('Created at'));
       // $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Actividad::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('profesor.name', __('Profesor'));
        
        // Mostrar el nombre del curso y la materia usando las relaciones
        $show->field('cursoMateria.curso.nombre', __('Curso'))
             ->as(function ($nombre) {
                 return $this->cursoMateria ? $this->cursoMateria->curso->nombre : '';
             });

        $show->field('cursoMateria.materia.nombre', __('Materia'))
             ->as(function ($nombre) {
                 return $this->cursoMateria ? $this->cursoMateria->materia->nombre : '';
             });

        $show->field('nombre', __('Nombre'));
        $show->field('descripcion', __('Descripcion'));
        $show->field('porcentajeNota', __('Porcentaje Nota'));
        $show->field('fechaEntrega', __('Fecha Entrega'));
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
        $form = new Form(new Actividad());

        // Campo idProfesor: muestra el ID del usuario logueado y es solo lectura
        $form->text('idProfesor', __('Profesor'))
            ->default(Auth::id())
            ->readonly();

        // Filtrar las opciones de CursoMateria basadas en el idProfesor del usuario logueado
        $cursoMaterias = CursoMateria::where('idProfesor', Auth::id())->get()->pluck('id', 'id');
        
        $form->select('idCursoMateria', __('Curso Materia'))
            ->options($cursoMaterias);

        $form->text('nombre', __('Nombre'));
        $form->textarea('descripcion', __('Descripcion'));
        $form->decimal('porcentajeNota', __('Porcentaje Nota'));
        $form->date('fechaEntrega', __('Fecha Entrega'))->default(date('Y-m-d'));

        return $form;
    }
}
