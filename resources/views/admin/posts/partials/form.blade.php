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

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            {{-- Imagen por defecto, si el usuario no inserta una imagen --}}
            @isset ($post->image)
            <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">
            @else
            <img id="picture" src="https://cdn.pixabay.com/photo/2023/11/23/20/40/ocean-8408693_1280.jpg" alt="">
            @endisset
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{-- Agrega un id al input file --}}
            {!! Form::label('file', 'Imagen que se mostrará en el post') !!}
            {!! Form::file('file', ['id' => 'file', 'class' => 'form-control-file', 'accept'=>'image/*']) !!}
            
            @error('file')
                <br>
                <small class="text-danger">{{$message}}</small>
            @enderror
        </div>
    </div>
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


@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%; /* 16:9 Aspect ratio */
        }
        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }

        .image-upload{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
    </style>
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


        document.getElementById("file").addEventListener('change', cambiarImagen);
           function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };
            reader.readAsDataURL(file);
           }
    </script>
@stop