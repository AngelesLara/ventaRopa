<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            AAC-SHOP | CARRITO DE COMPRAS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row">
                @if (Cart::count())
                    <table class="table table-striped">
                        <thead>
                            <th></th>
                            <th>NOMBRE</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>TOTAL</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $item)
                                <tr class="align-middle">
                                    <td>
                                        <img src="{{ $item->options->img_path ? asset('storage/' . $item->options->img_path) : asset('storage/productos/default.webp') }}" style="max-width: 80px; max-height: 100px;" class="card-img-top">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ number_format($item->price, 2) }}</td>
                                    <td>{{ number_format($item->subtotal(), 2) }}</td>
                                    <td>
                                        <form action="{{ route('removeItem') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="rowId" value="{{ $item->rowId }}">
                                            <input type="submit" name="btn" class="btn btn-danger btn-sm"
                                                value="x">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr class="fw-bolder">
                                <td colspan="3"></td>
                                <td class="text-end">SubTotal</td>
                                <td class="text-end">{{ Cart::subtotal() }}</td>
                                <td></td>
                            </tr>
                            <tr class="fw-bolder">
                                <td colspan="3"></td>
                                <td class="text-end">Igv:</td>
                                <td class="text-end">{{ Cart::tax() }}</td>
                                <td></td>
                            </tr>
                            <tr class="fw-bolder">
                                <td colspan="3"></td>
                                <td class="text-end">Total</td>
                                <td class="text-end">{{ Cart::total() }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{route('clear')}}" class="btn btn-danger text-center">Vaciar Carrito</a>
                @else
                    <p>El carrito está vacío</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
