@extends('adminlte::page')

@section('title', 'CATEGORIA-CREATE')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1>CREACIÓN DE CATEGORIAS</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.categorias.store') }}" method="post">
                        @csrf
                        {{-- With prepend slot --}}
                        <x-adminlte-input type="text" name="nombre" label="Nombre"
                            placeholder="ingrese el nombre de categoria..." label-class="text-dark"
                            value="{{ old('nombre') }}">
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="far fa-fw fa-file-alt text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save mr-2" />
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
