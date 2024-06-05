@extends('adminlte::page')

@section('title', 'COLOR-EDIT')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center">PODRAS EDITAR EL DESTINO: {{$colors->nombre}}</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.colors.update', $colors) }}" method="post">
                @csrf
                @method('PUT')
                {{-- With prepend slot --}}
                <x-adminlte-input type="text" name="nombre" label="Nombre" placeholder="ingrese el nombre del COLOR..."
                    label-class="text-dark" value="{{ $colors->nombre }}">
                    <x-slot name="prependSlot">
                        <div class="input-group-text">
                            <i class="far fa-fw fa-file-alt text-dark"></i>
                        </div>
                    </x-slot>
                </x-adminlte-input>
                <x-adminlte-button type="submit" label="Modificar Color" theme="primary" icon="fas fa-save mr-2" />
            </form>
        </div>
    </div>
@stop
