@extends('adminlte::page')

@section('title', 'COLOR-CREATE')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center">CREACIÓN DE COLORES PARA LOS PRODUCTOS</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.colors.store') }}" method="post">
                @csrf
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="ingrese el nombre del COLOR para el producto..."
                    label-class="text-dark" value="{{ old('nombre') }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="far fa-fw fa-file-alt text-dark"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-button type="submit" label="Guardar Destino" theme="primary" icon="fas fa-save mr-2" />
            </form>
        </div>
    </div>
@stop