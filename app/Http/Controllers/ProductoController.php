<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Color;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Talla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.productos.index')->only('index');
        $this->middleware('can:admin.productos.create')->only('create', 'store');
        $this->middleware('can:admin.productos.edit')->only('edit', 'update');
        $this->middleware('can:admin.productos.delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with(['categoria', 'talla', 'color', 'marca'])->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function dashboard()
    {
        $productos = Producto::all();
        return view('dashboard', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $producto = new Producto();
        $categorias = Categoria::all();
        $tallas = Talla::all();
        $colors = Color::all();
        $marcas = Marca::all();
        return view('admin.productos.create', compact('producto', 'categorias', 'tallas', 'colors', 'marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request);
        $request->validate([
            'codigo' => 'required|unique:productos',
            'nombre' => 'required|unique:productos',
            'stock' => 'required',
            'descripcion' => 'nullable|max:255',
            'precio' => 'required',
            'img_path' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'color_id' => 'required|integer|exists:colors,id',
            'talla_id' => 'required|integer|exists:tallas,id',
            'marca_id' => 'required|integer|exists:marcas,id'
        ]);

        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')->store('productos', 'public');
        } else {
            $imagePath = null;
        }

        Producto::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'stock' => $request->stock,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'img_path' => $imagePath,
            'categoria_id' => $request->categoria_id,
            'color_id' => $request->color_id,
            'talla_id' => $request->talla_id,
            'marca_id' => $request->marca_id,
        ]);

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto creado.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productos = Producto::findOrFail($id);

        // Obtener todos los colores, tallas, marcas y categorías disponibles
        $colors = Color::all();
        $tallas = Talla::all();
        $marcas = Marca::all();
        $categorias = Categoria::all();

        // Obtener el color, talla, marca y categoría asignados al producto
        $colorAsignado = $productos->color;
        $tallaAsignada = $productos->talla;
        $marcaAsignada = $productos->marca;
        $categoriaAsignada = $productos->categoria;

        return view('admin.productos.edit', compact(
            'productos',
            'colors',
            'tallas',
            'marcas',
            'categorias',
            'colorAsignado',
            'tallaAsignada',
            'marcaAsignada',
            'categoriaAsignada'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Producto $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, String $id)
    {

        $productos = Producto::findOrFail($id);

        $request->validate([
            'codigo' => ['required', Rule::unique('productos')->ignore($productos)],
            'nombre' => ['required', Rule::unique('productos')->ignore($productos)],
            'stock' => 'required',
            'descripcion' => 'nullable|max:255',
            'precio' => 'required',
            'img_path' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'color_id' => 'required|integer|exists:colors,id',
            'talla_id' => 'required|integer|exists:tallas,id',
            'marca_id' => 'required|integer|exists:marcas,id'
        ]);

        if ($request->hasFile('img_path')) {
            $imagePath = $request->file('img_path')->store('productos', 'public');
            // Eliminar la imagen anterior si existe
            if ($productos->img_path) {
                Storage::disk('public')->delete($productos->img_path);
            }
        } else {
            $imagePath = $productos->img_path;
        }

        $productos->update(
            [
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'stock' => $request->stock,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'img_path' => $imagePath,
                'categoria_id' => $request->categoria_id,
                'color_id' => $request->color_id,
                'talla_id' => $request->talla_id,
                'marca_id' => $request->marca_id,
            ]
        );

        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto actualizado');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        Producto::find($id)->delete();
        return redirect()->route('admin.productos.index')
            ->with('success', 'Producto eliminado.');
    }
}
