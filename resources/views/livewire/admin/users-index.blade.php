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
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td width="10px">
                        <a class="btn btn-primary btn-sm" href="{{route('admin.users.edit', $user)}}">Editar</a>
                    </td>
                </tr>

                <form action="">
                    @csrf
                    @method('DELETE')
                </form>
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


