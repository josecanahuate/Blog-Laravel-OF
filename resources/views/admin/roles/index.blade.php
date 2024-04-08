@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')
    @can('admin.roles.create')
    <a class="btn btn-primary float-right" href="{{route('admin.roles.create')}}">Nuevo Rol</a>
    @endcan
    <h1>Lista de Roles</h1>
@stop

@section('content')
@if (session ('info'))
    <div class="alert alert-success">
        <strong>{{ session ('info') }}</strong>
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id}}</td>
                            <td>{{ $role->name}}</td>

                            <td width = "10px">
                                @can('admin.roles.edit')
                                <a class="btn btn-primary btn-sm" href="{{route('admin.roles.edit', $role)}}">Editar</a>
                                @endcan
                            </td>
                            <td width = "10px">
                                @can('admin.roles.destroy')
                                <form action="{{route('admin.roles.destroy', $role)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                                </form>
                                @endcan
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

