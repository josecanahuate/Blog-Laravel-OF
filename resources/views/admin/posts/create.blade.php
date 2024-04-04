@extends('adminlte::page')

@section('title', 'Tristar')

@section('content_header')
    <h1>Crear Nuevo Post</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off']) !!}

            {{-- id del usuario actualmente autenticado para relacioanr el post con el usuario que lo esta creando --}}
            {!! Form::hidden('user_id', auth()->user()->id) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del post']) !!}
            
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group">
                {!! Form::label('slug', 'Slug', ['class' => 'form-label']) !!}
                {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug del post', 'id' => 'slug', 'readonly']) !!}
            
                @error('slug')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('category_id', 'Categoría', ['class' => 'form-label']) !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                
                @error('category_id')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p class="font-weight-bold">Etiquetas:</p>
                @foreach ($tags as $tag)
                    <label class="mr-2" > 
                        {!! Form::checkbox('tags[]', $tag->id, null) !!}
                        {{ $tag->name }}
                    </label>
                @endforeach

                @error('tags')
                <br>
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <p class="font-weight-bold">Estado:</p>
                <label class="mr-2" for="">
                    {!! Form::radio('status', 1, true) !!}
                    Borrador
                </label>

                <label for="">
                    <br>
                    {!! Form::radio('status', 2) !!}
                    Publicado
                </label>

            </div>

            <div class="form-group">
                {!! Form::label('extract', 'Extracto', ['class' => 'form-label']) !!}
                {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}
            
                @error('extract')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                {!! Form::label('body', 'Cuerpo del Post', ['class' => 'form-label']) !!}
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            
                @error('body')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            {!! Form::submit('Crear Post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>

    <script>
        $(document).ready(function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });


    ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
@stop
