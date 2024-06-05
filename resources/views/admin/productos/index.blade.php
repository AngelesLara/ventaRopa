@extends('adminlte::page')

@section('title', 'PRODUCTOS-VISTA')

@section('content_header')
    <div class="card">
        <div class="card-body text-center">
            <h1>SE MOSTRARAN TODOS LOS PRODUCTOS</h1>
        </div>
    </div>
@stop

@section('content')
    @if (@session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
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
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    @can('admin.categorias.index')
                        <a href="{{ route('admin.categorias.index') }}" class="btn btn-primary btn-block mt-2 mr-3">
                            Ver Categorias <i class="fas fa-eye"></i>
                        </a>
                    @endcan
                    @can('admin.colors.index')
                        <a href="{{ route('admin.colors.index') }}" class="btn btn-primary btn-block mt-2 mr-3">
                            Ver Colores <i class="fas fa-eye"></i>
                        </a>
                    @endcan
                    @can('admin.tallas.index')
                        <a href="{{ route('admin.tallas.index') }}" class="btn btn-primary btn-block mt-2 mr-3">
                            Ver Tallas <i class="fas fa-eye"></i>
                        </a>
                    @endcan
                    @can('admin.marcas.index')
                        <a href="{{ route('admin.marcas.index') }}" class="btn btn-primary btn-block mt-2 mr-3">
                            Ver Marcas <i class="fas fa-eye"></i>
                        </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @can('admin.productos.create')
                        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary float-right mt-2 mr-3">NUEVO
                            PRODUCTO</a>
                    @endcan
                    <br>
                    <br>
                    <br>
                    <table class="table table-striper">
                        <thead>
                            <tr>
                                <th class="text-center">FOTO</th>
                                <th class="text-center">CÓDIGO</th>
                                <th class="text-center">NOMBRE</th>
                                <th class="text-center">STOCK</th>
                                <th>DESCRIPCIÓN</th>
                                <th class="text-center">PRECIO</th>
                                <th class="text-center">ESTADO</th>
                                <th>CATEGORIA</th>
                                <th class="text-center">TALLA</th>
                                <th class="text-center">COLOR</th>
                                <th class="text-center">MARCA</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productos as $pro)
                                <tr>
                                    <td class="text-center">
                                        @if ($pro->img_path)
                                            <img src="{{ asset('storage/' . $pro->img_path) }}" alt="Imagen del Producto"
                                                style="max-width: 100px; max-height: 100px;">
                                        @else
                                            <img src="{{ asset('storage/productos/default.webp') }}"
                                                alt="Imagen por defecto" style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $pro->codigo }}</td>
                                    <td class="text-center">{{ $pro->nombre }}</td>
                                    <td class="text-center">{{ $pro->stock }}</td>
                                    <td>{{ $pro->descripcion }}</td>
                                    <td class="text-center">{{ $pro->precio }}</td>
                                    <td class="text-center">{{ $pro->estado }}</td>
                                    <td>{{ $pro->categoria->nombre }}</td>
                                    <td class="text-center">{{ $pro->talla->nombre }}</td>
                                    <td class="text-center">{{ $pro->color->nombre }}</td>
                                    <td class="text-center">{{ $pro->marca->nombre }}</td>
                                    <td class="text-center"></td>
                                    @can('admin.productos.edit')
                                        <td width="10px">
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.productos.edit', $pro) }}">Editar</a>
                                        </td>
                                    @endcan
                                    @can('admin.productos.destroy')
                                        <td width="10px">
                                            <form class="formEliminar" action="{{ route('admin.productos.destroy', $pro) }}"
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
