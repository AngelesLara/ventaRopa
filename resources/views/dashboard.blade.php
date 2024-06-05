<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            AAC-SHOP | DONDE TODO CUESTA MENOS!!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="col-md-12 mb-4">
            <div style="text-align: right;">
                @include('cart.msg')
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                @foreach ($productos as $item)
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('storage/' . ($item->img_path ?: '/productos/default.webp')) }}" class="card-img-top">
                            <div class="card-body text-center">
                                <h2>{{ $item->nombre }}</h2>
                                <p>PEN: {{ $item->precio }}</p>
                            </div>
                            <div class="card-footer">
                                <form action="{{ route('add') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <input type="submit" name="btn" class="btn btn-success w-100"
                                        value="addToCart">
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
