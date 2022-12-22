@extends('layouts.admin')

@section('title', 'Lista de reservaciones')
@section('content-header', 'Lista de reservaciones')
@section('content-actions')
<a href="{{route('reservations.create')}}" class="btn btn-primary">Crear Reservación</a>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
<div class="card product-list">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th width="250px">Detalles</th>
                    <th>Cliente</th>
                    <th>Empleado asignado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                <tr>
                    <td>{{$reservation->id}}</td>
                    <td>{{$reservation->type}}</td>
                    <td>{{$reservation->date}}</td>
                    <td>{{$reservation->details}}</td>
                    <td>{{$reservation->customer?->first_name.' '.$reservation->customer?->last_name}}</td>
                    <td>{{$reservation->employee?->first_name.' '.$reservation->employee?->last_name}}</td>
                    <td>
                        <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                                <form action="{{ route('reservations.destroy', $reservation) }}" method="post" class="d-inline-block">
                                    <button class="btn btn-danger btn-delete" data-url="{{route('reservations.destroy', $reservation)}}"><i
                                    class="fas fa-trash"></i></button>
                                    <input type="hidden" name="_method" value="delete" />
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<!-- <script type="module">
    $(document).ready(function () {
        $(document).on('click', '.btn-delete', function () {
            $this = $(this);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                title: 'Estas seguro?',
                text: "Seguro que desea eliminar producto?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'No',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                        $this.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        })
                    })
                }
            })
        })
    })
</script> -->
@endsection
