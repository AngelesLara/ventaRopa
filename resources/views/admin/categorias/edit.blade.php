@extends('adminlte::page')

@section('title', 'CATEGORIAS-EDITAR')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1>PODRAS EDITAR LA CATEGORIA: {{ $categorias->nombre }}</h1>

        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categorias.update', $categorias) }}" method="post">
                @csrf
                @method('PUT')
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="nombre" label="Nombre" label-class="text-dark"
                    value="{{ $categorias->nombre }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="far fa-fw fa-file-alt text-lightblue"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-button type="submit" label="Modificar Categoria" theme="primary" icon="fas fa-save" />
            </form>
        </div>
    </div>
@stop
