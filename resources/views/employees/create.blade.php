@extends('layouts.admin')

@section('title', 'Crear Empleado')
@section('content-header', 'Crear Empleado')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="first_name">Nombre</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Nombre" value="{{ old('first_name') }}">
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Apellido</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Apellido" value="{{ old('last_name') }}">
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone">Teléfono</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Teléfono" value="{{ old('phone') }}">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="address">Dirección</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Dirección" value="{{ old('address') }}">
                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="avatar">Avatar</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="avatar" id="avatar">
                    <label class="custom-file-label" for="avatar">Subir Imagen</label>
                </div>
                @error('avatar')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Rol</label>
                <select name="role" class="form-control" value="{{ old('role') }}" id="role">
                    <option value="Admin">Admin</option>
                    <option value="RRHH">RRHH</option>
                    <option value="Mecánico">Mecánico</option>
                </select>
                @error('employee')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group d-none" id="hability">
                <label for="role">Especialidad</label>
                <select name="hability" class="form-control" value="{{ old('hability') }}">
                    @foreach ($habilities as $hability)
                    <option value="{{$hability->id}}" class="text-capitalize">{{$hability->name}}</option>
                    @endforeach
                </select>
                @error('employee')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Crear</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script type="module">
    $(document).ready(function() {
        bsCustomFileInput.init();

        $("#role").on('change', (e) => {
            if(e.target.value === "Mecánico") {
                $("#hability").removeClass('d-none');
            } else if(!$("#hability").hasClass('d-none')) {
                $("#hability").addClass('d-none');
            }
        })
    });
</script>
@endsection