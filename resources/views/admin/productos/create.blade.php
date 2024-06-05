@extends('adminlte::page')

@section('title', 'PRODUCTOS-CREATE')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1>CREACIÓN DE PRODUCTOS</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.productos.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                {{-- With prepend slot --}}
                                <x-adminlte-input type="text" name="codigo" label="Código"
                                    placeholder="ingrese código del producto..." label-class="text-dark"
                                    value="{{ old('codigo') }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-fw fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="nombre" label="Nombre"
                                    placeholder="ingrese el nombre del Producto..." label-class="text-dark"
                                    value="{{ old('nombre') }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-fw fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="stock" label="Stock"
                                    placeholder="ingrese el stock del producto..." type="number" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-dark">
                                            <i class="fas fa-hashtag"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="descripcion" label="Descripción"
                                    placeholder="ingrese la descripcion del Producto..." label-class="text-dark"
                                    value="{{ old('descripcion') }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-fw fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="precio" label="Precio"
                                    placeholder="precio del producto..." type="number" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-dark">
                                            <i class="fas fa-hashtag"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-select name="categoria_id" label="Categoria" label-class="text-dark"
                                    igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </div>
                                    </x-slot>
                                    <option value="" selected disabled>SELECCIONE LA CATEGORIA</option>
                                    @foreach ($categorias as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Imagen del Producto:</label>
                                    <input class="form-control" type="file" name="img_path" id="formFile">
                                </div>
                                <x-adminlte-select name="color_id" label="Color" label-class="text-dark" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </div>
                                    </x-slot>
                                    <option value="" selected disabled>SELECCIONE EL COLOR</option>
                                    @foreach ($colors as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </x-adminlte-select>
                                <x-adminlte-select name="marca_id" label="Marca" label-class="text-dark" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </div>
                                    </x-slot>
                                    <option value="" selected disabled>SELECCIONE LA MARCA</option>
                                    @foreach ($marcas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </x-adminlte-select>
                                <x-adminlte-select name="talla_id" label="Talla" label-class="text-dark" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </div>
                                    </x-slot>
                                    <option value="" selected disabled>SELECCIONE LA TALLA</option>
                                    @foreach ($tallas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                    </div>
                </div>
                <x-adminlte-button type="submit" label="Guardar" theme="primary" icon="fas fa-save mr-2" />
            </form>
        </div>
    </div>
@stop