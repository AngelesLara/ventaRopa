<?php

namespace App\Http\Controllers;

use App\Models\Caracteristica;
use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.categorias.index')->only('index');
        $this->middleware('can:admin.categorias.create')->only('create', 'store');
        $this->middleware('can:admin.categorias.edit')->only('edit', 'update');
        $this->middleware('can:admin.categorias.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }


    /*
    public function index()
    {
        $categorias = Categoria::all();
        $caracteristica = $categorias->caracteristica;

        $nobCaracteristica = $caracteristica->nombre;
        $nobDescripcion = $caracteristica->descripcion;


        return view('admin.categorias.index', compact('categorias', 'caracteristica', 'nombreCaracteristica', 'nombreDescripcion'));
    }
*/
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'nombre' => 'required|unique:productos',
        ]);

        // Crear la Caracteristica
        $caracteristicas = Caracteristica::create([
            'nombre' => $request->nombre,
        ]);

        // Usar la ID de la Caracteristica para crear la Categoria
        $caracteristicas->categoria()->create();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoria creada Existosamente...');
    }

    /**
     * Edit the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Buscar la categoría por su ID
        $categorias = Categoria::findOrFail($id);

        return view('admin.categorias.edit', compact('categorias'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Encontrar la categoría por su ID
        $categoria = Categoria::findOrFail($id);

        // Actualizar los datos de la categoría
        $categoria->update([
            'nombre' => $request->nombre
        ]);

        // Redireccionar a la lista de categorías con un mensaje de éxito
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Encontrar la categoría por su ID
        $categoria = Categoria::findOrFail($id);

        // Eliminar la categoría
        $categoria->delete();

        // Redireccionar a la lista de categorías con un mensaje de éxito
        return redirect()->route('admin.categorias.index')->with('success', 'Categoria eliminada exitosamente.');
    }
}
