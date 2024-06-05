@extends('adminlte::page')

@section('title', 'TALLAS-PRODUCTOS')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center">SE MOSTRARAN TODAS LAS TALLAS DE LOS PRODUCTOS</h1>
        </div>
    </div>
@stop

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop

@section('content')

    @if (@session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "OPERACIÓN EXITOSA!"
            });
        </script>
    @endif

    <div class="card">
        <div class="card-body">
            @can('admin.tallas.create')
                <a href="{{ route('admin.tallas.create') }}" class="btn btn-primary float-right mt-2 mr-3">NUEVA MARCA</a>
            @endcan
            <br>
            <br>
            <br>
            <table class="table table-striper">
                <thead>
                    <tr>
                        <th></th>
                        <th>NOMBRE</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tallas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombre }}</td>
                            <td width="5px">
                                <a class="btn btn-primary"
                                    href="{{ route('admin.categorias.edit', $item) }}">Editar</a>
                            </td>
                            <td width="5px">
                                <form class="formEliminar"
                                    action="{{ route('admin.categorias.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.formEliminar').submit(function(e) {
                e.preventDefault(); // Detener el envío automático del formulario
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Se eliminará un Registro!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, Eliminar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si se confirma, enviar el formulario manualmente
                        $(this).off("submit")
                            .submit(); // Desactivar el evento de submit para evitar bucles
                    }
                });
            })
        })
    </script>
@stop
