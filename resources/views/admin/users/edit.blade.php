@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')
    <h1>Asignar un Rol</h1>
@stop

@section('content')
@if (session ('info'))
    <div class="alert alert-success">
        <strong>{{ session ('info') }}</strong>
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <p class="h5">Nombre:</p>
            <p class="form-control">{{ $user->name }} </p>

            <h2>Listado de Roles</h2>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
                @foreach ($roles as $role)
                <div>
                    <label>
                        {{ Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1'] ) }}
                        {{ $role->name }}
                    </label>
                </div>
                @endforeach
                <div class="mt-2">
                    <a href="/admin/users" class="btn btn-secondary">Volver</a>
                    {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary ml-1']) !!}    
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop