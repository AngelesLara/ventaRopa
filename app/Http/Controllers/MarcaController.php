<?php

namespace App\Http\Controllers;

use App\Models\Caracteristica;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.marcas.index')->only('index');
        $this->middleware('can:admin.marcas.create')->only('create', 'store');
        $this->middleware('can:admin.marcas.edit')->only('edit', 'update');
        $this->middleware('can:admin.marcas.destroy')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::all();

        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);

        // Crear la Caracteristica
        $marcas = Marca::create([
            'nombre' => $request->nombre,
        ]);

        // Usar la ID de la Caracteristica para crear la Categoria
        $marcas->create();

        return redirect()->route('admin.marcas.index')->with('success', 'La Marca fue creado Existosamente...');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar la categoría por su ID
        $marcas = Marca::findOrFail($id);

        return view('admin.marcas.edit', compact('marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontrar la marca por su ID
        $marca = Marca::findOrFail($id);

        // Actualizar los datos de la marca
        $marca->update([
            'nombre' => $request->nombre,
        ]);

        // Redireccionar a la lista de marcas con un mensaje de éxito
        return redirect()->route('admin.marcas.index')->with('success', 'Marca actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encontrar la marca por su ID
        $marca = Marca::findOrFail($id);

        // Eliminar la marca
        $marca->delete();

        // Redireccionar a la lista de marcas con un mensaje de éxito
        return redirect()->route('admin.marcas.index')->with('success', 'Marca eliminada exitosamente.');
    }
}
