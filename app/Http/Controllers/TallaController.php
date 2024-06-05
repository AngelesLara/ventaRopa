<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.tallas.index')->only('index');
        $this->middleware('can:admin.tallas.create')->only('create', 'store');
        $this->middleware('can:admin.tallas.edit')->only('edit', 'update');
        $this->middleware('can:admin.tallas.destroy')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tallas = Talla::all();

        return view('admin.tallas.index', compact('tallas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tallas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        // Crear las tallas
        $tallas = Talla::create([
            'nombre' => $request->nombre,
        ]);

        // Usar la ID de la Caracteristica para crear la Categoria
        $tallas->marca()->create();

        return redirect()->route('admin.tallas.index')->with('success', 'La Talla fue creado Existosamente...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar la categoría por su ID
        $tallas = Talla::findOrFail($id);

        return view('admin.tallas.edit', compact('tallas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontrar la marca por su ID
        $tallas = Talla::findOrFail($id);

        // Actualizar los datos de la marca
        $tallas->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar a la lista de marcas con un mensaje de éxito
        return redirect()->route('admin.tallas.index')->with('success', 'tallas actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encontrar la marca por su ID
        $tallas = Talla::findOrFail($id);

        // Eliminar la marca
        $tallas->delete();

        // Redireccionar a la lista de marcas con un mensaje de éxito
        return redirect()->route('admin.tallas.index')->with('success', 'tallas eliminada exitosamente.');
    }
}
