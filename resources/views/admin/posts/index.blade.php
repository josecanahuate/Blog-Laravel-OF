@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')
<a class="btn btn-secondary btn-sm float-right" href="{{route('admin.posts.create')}}">Nuevo Post</a>

    <h1>Listado de Post</h1>
@stop

@section('content')

@if (session ('info'))
<div class="alert alert-success">
    <strong>{{ session ('info') }}</strong>
</div>
@endif

    @livewire('admin.post-index'){{--  aca importamos la misma ruta del componente app\Livewire\Admin\PostIndex.php --}}
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop