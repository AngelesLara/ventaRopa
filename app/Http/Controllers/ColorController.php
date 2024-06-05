<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.colors.index')->only('index');
        $this->middleware('can:admin.colors.create')->only('create', 'store');
        $this->middleware('can:admin.colors.edit')->only('edit', 'update');
        $this->middleware('can:admin.colors.destroy')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::all();

        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        // Crear las tallas
        $colors = Color::create([
            'nombre' => $request->nombre,
        ]);

        // Usar la ID de la Caracteristica para crear la Categoria
        $colors->create();

        return redirect()->route('admin.colors.index')->with('success', 'Los colores fueron creados existosamente...');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar la categoría por su ID
        $colors = Color::findOrFail($id);

        return view('admin.colors.edit', compact('colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontrar la marca por su ID
        $colors = Color::findOrFail($id);

        // Actualizar los datos de la marca
        $colors->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar a la lista de marcas con un mensaje de éxito
        return redirect()->route('admin.colors.index')->with('success', 'Color actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encontrar la marca por su ID
        $colors = Color::findOrFail($id);

        // Eliminar la marca
        $colors->delete();

        // Redireccionar a la lista de marcas con un mensaje de éxito
        return redirect()->route('admin.colors.index')->with('success', 'Color eliminado exitosamente.');
    }
}
