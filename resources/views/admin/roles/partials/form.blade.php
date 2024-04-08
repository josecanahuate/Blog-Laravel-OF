<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del Rol']) !!}
    
    @error('name')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<h2 class="h3">Lista de Permisos</h2>
@foreach ($permissions as $permission)
<div>
<label>
    {{-- trayendo la lista de permisos o rutas de permisos, se pone en array --}}
    {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-1']) !!}
    {{ $permission->description}}
</label>
</div>
@endforeach