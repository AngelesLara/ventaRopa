<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productos = Producto::find($request->id);
        if (empty($productos)) {
            return redirect('/');
        }
        
        Cart::add(
            $productos->id,
            $productos->nombre,
            1,
            $productos->precio,
            ["img_path" => $productos->img_path]
        );

        return redirect()->back()->with("success", "Producto Agregado: " . $productos->nombre);
    }

    public function checkout()
    {
        return view('cart.checkout');
    }

    public function removeItem(Request $request){
        Cart::remove($request->rowId);
        return redirect()->back()->with("success", "Producto Eliminado");
    }

    public function clear(){
        Cart::destroy();
        return redirect()->back()->with("success", "Carrito Vacio");
    }
}
