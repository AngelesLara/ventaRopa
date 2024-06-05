@extends('adminlte::page')

@section('title', 'FORMAS-PAGOS')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1>SE MOSTRARAN TODOS LAS FORMAS DE PAGOS</h1>
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
            @can('admin.formas.create')
                <a href="{{ route('admin.formas.create') }}" class="btn btn-primary float-right mt-2 mr-3">ADD F. PAGO</a>
            @endcan
            <table class="table table-striper mt-2 mr-3">
                <thead>
                    <tr>
                        <th></th>
                        <th>NOMBRE</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forma as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nombre }}</td>
                            @can('admin.formas.edit')
                                <td width="10px">
                                    <a class="btn btn-primary" href="{{ route('admin.formas.edit', $item) }}">Editar</a>
                                </td>
                            @endcan
                            @can('admin.formas.destroy')
                                <td width="10px">
                                    <form class="formEliminar" action="{{ route('admin.formas.destroy', $item) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    <script>
        // Función para eliminar un forma
        function deleteForma(formaId) {
            Swal.fire({
                title: "Eliminar",
                text: "¿Estás seguro de que quieres eliminar este forma pago?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.querySelector('#deleteForm');
                    form.action = deleteUrl.replace('0', formaId);
                    // Enviar el formulario
                    form.submit();
                }
            });
        }
    </script>
@stop
