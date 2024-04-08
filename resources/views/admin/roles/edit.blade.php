@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')
    <a href="/admin/roles" class="btn btn-secondary float-right">Volver</a>
    <h1>Editar Rol</h1>
@stop

@section('content')
@if (session ('info'))
    <div class="alert alert-success">
        <strong>{{ session ('info') }}</strong>
    </div>
@endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}
           
            @include('admin.roles.partials.form')

            {!! Form::submit('Actualizar Rol', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
@stop

