<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Models\CursoMateria;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\User;

class CursoMateriaController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CursoMateria';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CursoMateria());

        $grid->column('id', __('Id'));

        // Mostrar el nombre del curso
        $grid->column('curso.nombre', __('Curso'))
             ->display(function () {
                 return $this->curso ? $this->curso->nombre : 'No disponible';
             });

        // Mostrar el nombre de la materia
        $grid->column('materia.nombre', __('Materia'))
             ->display(function () {
                 return $this->materia ? $this->materia->nombre : 'No disponible';
             });

        // Mostrar el nombre del profesor
        $grid->column('idProfesor', __('Profesor'))
             ->display(function ($idProfesor) {
                 // Buscar el profesor por ID en la tabla admin_users
                 $profesor = User::find($idProfesor);
                 return $profesor ? $profesor->name : 'No disponible'; // Mostrar el nombre del profesor
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
        $show = new Show(CursoMateria::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('idCurso', __('Curso'))
             ->as(function ($idCurso) {
                 return $this->curso ? $this->curso->nombre : '';
             });

        $show->field('idMateria', __('Materia'))
             ->as(function ($idMateria) {
                 return $this->materia ? $this->materia->nombre : '';
             });

        $show->field('idProfesor', __('Profesor'))
             ->as(function ($idProfesor) {
                 return $this->profesor ? $this->profesor->name : '';
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
        $form = new Form(new CursoMateria());

        $form->select('idCurso', __('Curso'))
            ->options(\App\Models\Curso::pluck('nombre', 'id')->toArray());

        $form->select('idMateria', __('Materia'))
            ->options(\App\Models\Materia::pluck('nombre', 'id')->toArray());

        $professores = \DB::table('admin_users')
            ->join('admin_role_users', 'admin_users.id', '=', 'admin_role_users.user_id')
            ->where('admin_role_users.role_id', 2)
            ->pluck('admin_users.name', 'admin_users.id')
            ->toArray();

        $form->select('idProfesor', __('Profesor'))
            ->options($professores);

        return $form;
    }
}
