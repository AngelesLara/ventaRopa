@extends('adminlte::page')

@section('title', 'PRODUCTOS-EDIT')

@section('content_header')
    <div class="card">
        <div class="card-body">
            <h1 class="text-center">PODRAS EDITAR EL PRODUCTO SELECCIONADO</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.productos.update', $productos->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                {{-- With prepend slot --}}
                                <x-adminlte-input type="text" name="codigo" label="Código"
                                    placeholder="ingrese codigo del producto..." label-class="text-dark"
                                    value="{{ $productos->codigo }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-fw fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="nombre" label="Nombre"
                                    placeholder="ingrese el nombre del Producto..." label-class="text-dark"
                                    value="{{ $productos->nombre }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-fw fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="stock" label="Stock"
                                    placeholder="ingrese el stock del producto..." value="{{ $productos->stock }}"
                                    type="number" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-dark">
                                            <i class="fas fa-hashtag"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="descripcion" label="Descripción"
                                    placeholder="ingrese la descripcion del Producto..." label-class="text-dark"
                                    value="{{ $productos->descripcion }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="far fa-fw fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input type="text" name="precio" label="Precio"
                                    placeholder="precio del producto..." value="{{ $productos->precio }}" type="number"
                                    igroup-size="lg">
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
                                    @foreach ($categorias as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $categoriaAsignada->id ? 'selected' : '' }}>{{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <h3>Imagen actual del Producto:</h3>
                                    <div>
                                        <div class="form-group">
                                            <label for="img_path"></label>
                                            @if ($productos->img_path)
                                                <img src="{{ asset('storage/' . $productos->img_path) }}"
                                                    alt="Imagen del Producto" class="img-thumbnail" width="300px"
                                                    height="300px">
                                            @else
                                                <p>No hay imagen disponible</p>
                                            @endif
                                        </div>
                                        <label class="form-label" for="img_path">Imagen del Producto</label>
                                        <input class="form-control mb-3 ml-3" type="file" name="img_path" id="img_path">
                                    </div>
                                </div>
                                <x-adminlte-select name="color_id" label="Color" label-class="text-dark" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </div>
                                    </x-slot>
                                    @foreach ($colors as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $colorAsignado->id ? 'selected' : '' }}>{{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                                <x-adminlte-select name="marca_id" label="Marca" label-class="text-dark" igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </div>
                                    </x-slot>
                                    @foreach ($marcas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $marcaAsignada->id ? 'selected' : '' }}>{{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                                <x-adminlte-select name="talla_id" label="Talla" label-class="text-dark"
                                    igroup-size="lg">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-gradient-info">
                                            <i class="fas fa-fw fa-cog"></i>
                                        </div>
                                    </x-slot>
                                    @foreach ($tallas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $tallaAsignada->id ? 'selected' : '' }}>{{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select>
                            </div>
                        </div>
                    </div>
                </div>
                <x-adminlte-button type="submit" label="Modificar Producto" theme="primary" icon="fas fa-save"
                    class="float-right mb-2 ml-3" />
            </form>
        </div>
    </div>
@stop
