<?php
namespace App\Http\Controllers\Admin;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Layout\Content;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Profesor;

class DashboardController extends AdminController
{
    public function index(Content $content)
    {
        $cursosCount = Curso::count();
        $estudiantesCount = Estudiante::count();
        $profesoresCount = Profesor::count();

        return $content
            ->title('Dashboard')
            ->description('Estadísticas del Sistema Escolar')
            ->view('admin.dashboard', compact('cursosCount', 'estudiantesCount', 'profesoresCount'));
    }
}
