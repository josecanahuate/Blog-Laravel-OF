@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')

<a class="btn btn-primary float-right" href="{{route('admin.users.create')}}">Nuevo Usuario</a>

{{-- @can('admin.users.create')
<a class="btn btn-primary float-right" href="{{route('admin.users.create')}}">Nuevo Usuario</a>
@endcan --}}
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
@if (session ('info'))
    <div class="alert alert-success">
        <strong>{{ session ('info') }}</strong>
    </div>
@endif

    @livewire('admin.users-index')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop