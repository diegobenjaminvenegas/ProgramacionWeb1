@extends('admin::index')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Cursos</span>
                <span class="info-box-number">{{ $cursosCount }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Estudiantes</span>
                <span class="info-box-number">{{ $estudiantesCount }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Profesores</span>
                <span class="info-box-number">{{ $profesoresCount }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
