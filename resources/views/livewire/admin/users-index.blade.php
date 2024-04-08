<div>
<div class="card">

    <div class="card-header">
        <input wire:model.live="search" class="form-control" type="text" placeholder="Ingrese el Nombre o Correo del Usuario">
    </div>

@if ($users->count())
<div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>EMAIL</th>
                <th></th>
            </tr>                
        </thead>

        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="text-center">{{$user->id}}</td>
                <td class="text-center">{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td> <!-- Nueva celda para acciones -->
                    <div class="d-flex justify-content-end">
                        
                        @can('admin.users.edit')
                            <a class="btn btn-primary btn-sm mr-2" href="{{route('admin.users.edit', $user)}}">EDITAR</a>
                        @endcan

                        @can('admin.users.destroy')
                            <form action="{{route('admin.users.destroy', $user)}}" method="POST">
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

<div class="card footer">
    {{$users->links()}}
</div>

@else
<div class="card-body">
    <strong>No hay registros de usuario...</strong>
</div>
@endif

</div>
</div>


