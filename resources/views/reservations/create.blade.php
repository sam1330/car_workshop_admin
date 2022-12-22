@extends('layouts.admin')

@section('title', 'Crear Reservación')
@section('content-header', 'Crear Reservación')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('reservations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="type">Tipo de servicio</label>
                <select name="type" class="form-control" value="{{ old('type') }}" id="servicioInput">
                    <option value="cita">Agendar cita</option>
                    <option value="servicio_al_cliente">Servicio al cliente</option>
                </select>
                @error('type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="date">Fecha</label>
                <input name="date" type="datetime-local" value="{{ old('date') }}" class="form-control" />
                @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="details">Detalles</label>
                <textarea name="details" class="form-control" id="details" placeholder="El auto se apagó y no enciende">{{old('details')}}</textarea>
                @error('datails')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="customer_id">Cliente</label>
                <select name="customer_id" class="form-control" value="{{ old('type') }}" id="servicioInput">
                    @foreach($customers as $customer)
                    <option value="{{$customer->id}}">{{$customer->first_name.' '.$customer->last_name}}</option>
                    @endforeach
                </select>
                @error('employee')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="employee_id">Empleado</label>
                <select name="employee_id" class="form-control" value="{{ old('type') }}" id="servicioInput">
                    @foreach($employees as $employee)
                    <option value="{{$employee->id}}">{{$employee->first_name.' '.$employee->last_name}}</option>
                    @endforeach
                </select>
                @error('employee_id')
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
<script>
    $(document).ready(function() {
        bsCustomFileInput.init();
    });
</script>
@endsection