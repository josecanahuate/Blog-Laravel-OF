<div class="form-group">
    {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la etiqueta']) !!}

    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="form-group">
    {!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la etiqueta', 'id' => 'slug', 'readonly']) !!}

    @error('slug')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('color', 'Color', ['class' => 'form-label']) !!}
    {!! Form::select('color', $colors, null, ['class' => 'form-control']) !!}
    
    @error('color')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>