<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Http\Requests\LibroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class LibroController
 * @package App\Http\Controllers
 */
class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Libro::query();

        // Filtrar por título
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'like', "%$search%")
                  ->orWhere('autor', 'like', "%$search%");
            });
        }

        // Filtrar por género
        if ($request->has('genre')) {
            $genre = $request->input('genre');
            $query->where('genero', $genre);
        }

        // Obtener los libros paginados
        $libros = $query->paginate(10); // Cambia el número según tus necesidades

        return view('libro.index', compact('libros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $libro = new Libro();
        return view('libro.create', compact('libro'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LibroRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        Libro::create($data);

        return redirect()->route('libros.index')
            ->with('success', 'Libro created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $libro = Libro::find($id);

        return view('libro.show', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $libro = Libro::find($id);

        return view('libro.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LibroRequest $request, Libro $libro)
    {
        $data = $request->validated();

        if ($request->hasFile('imagen')) {
            // Elimina la imagen anterior si existe
            if ($libro->imagen) {
                Storage::disk('public')->delete($libro->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('imagenes', 'public');
        }

        $libro->update($data);

        return redirect()->route('libros.index')
            ->with('success', 'Libro updated successfully');
    }

    public function destroy($id)
    {
        $libro = Libro::find($id);

        if ($libro->imagen) {
            Storage::disk('public')->delete($libro->imagen);
        }

        $libro->delete();

        return redirect()->route('libros.index')
            ->with('success', 'Libro deleted successfully');
    }
}
