@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')
    <a href="/admin/roles" class="btn btn-secondary float-right">Volver</a>
    <h1>Crear Nuevo Rol</h1>
@stop

@section('content')
@if (session ('info'))
    <div class="alert alert-success">
        <strong>{{ session ('info') }}</strong>
    </div>
@endif

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}
           
            @include('admin.roles.partials.form')
            
            {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

