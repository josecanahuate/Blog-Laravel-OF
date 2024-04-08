        <div class="form-group">
            {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del usuario']) !!}
        
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el correo del usuario']) !!}
        
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            {!! Form::label('password', 'Contraseña', ['class' => 'form-label']) !!}
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña']) !!}
        
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <h2>Listado de Roles</h2>
{{--             @foreach ($roles as $role)
            <div>
                <label>
                    {{ Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1'] ) }}
                    {{ $role->name }}
                </label>
            </div>
            @endforeach --}}

            @foreach ($roles as $role)
            <div>
                <label>
                    {{ Form::checkbox('roles[]', $role->name, null, ['class' => 'mr-1'] ) }}
                    {{ $role->name }}
                </label>
            </div>
            @endforeach

        </div>
