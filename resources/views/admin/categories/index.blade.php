@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')
    @can('admin.categories.create')
    <a class="btn btn-primary float-right" href="{{route('admin.categories.create')}}">Agregar Categoría</a>
    @endcan
    <h1>Lista de Categorias</h1>
@stop

@section('content')

@if (session ('info'))
    <div class="alert alert-success">
        <strong>{{ session ('info') }}</strong>
    </div>
@endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered" id="categorias">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">NOMBRES</th>
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
            
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td class="text-center">{{$category->id}}</td>
                            <td class="text-center">{{$category->name}}</td>
                            <td> <!-- Nueva celda para acciones -->
                                <div class="d-flex justify-content-end">
                                    @can('admin.categories.edit')
                                        <a class="btn btn-primary btn-sm mr-2" href="{{route('admin.categories.edit', $category)}}">EDITAR</a>
                                    @endcan
                                    @can('admin.categories.destroy')
                                        <form action="{{route('admin.categories.destroy', $category)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger btn-sm">BORRAR</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.bootstrap4.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap4.js"></script>
    {{-- responsive --}}
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.1/js/responsive.bootstrap4.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#categorias').DataTable( {
                responsive: true,
                autoWidth: false,
                language: {
                    "lengthMenu": "Mostrar " +
                        `<select class="custom-select custom-select-sm form-control form-control-sm"> 
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="-1">Todos</option>
                        </select>`+ " registros por página",
                    "zeroRecords": "Nada Encontrado - Disculpa",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": { 
                        "first":      "Primero",
                        "last":       "Último",
                        "next":       "Siguiente",
                        "previous":   "Anterior"
                    }
                }
            } );
        });
    </script>
    
@stop