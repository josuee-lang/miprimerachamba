<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Http\Requests\PrestamoRequest;

/**
 * Class PrestamoController
 * @package App\Http\Controllers
 */
class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prestamos = Prestamo::paginate();

        return view('prestamo.index', compact('prestamos'))
            ->with('i', (request()->input('page', 1) - 1) * $prestamos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prestamo = new Prestamo();
        $users = User::all();
        $libros = Libro::all();
        return view('prestamo.create', compact('prestamo', 'users','libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrestamoRequest $request)
    {
        $prestamo = new Prestamo();
        $prestamo->libro_id = $request->libro_id;
        $prestamo->user_id = $request->user_id;
        $prestamo->prestado_el = $request->prestado_el;
        $prestamo->vencimiento_el = $request->vencimiento_el;
        $prestamo->save();
    
        // Reducir la cantidad de copias disponibles del libro prestado
        $libro = Libro::find($request->libro_id); // Buscar el libro por su ID
        $libro->copias -= 1; // Reducir en uno la cantidad de copias disponibles
        $libro->save(); // Guardar el libro actualizado
    
        // Redireccionar al usuario a libros.index después de guardar el préstamo
        return redirect()->back()->with('success', 'El préstamo se ha registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $prestamo = Prestamo::find($id);

        return view('prestamo.show', compact('prestamo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $prestamo = Prestamo::find($id);

        return view('prestamo.edit', compact('prestamo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrestamoRequest $request, Prestamo $prestamo)
    {
        $prestamo->update($request->validated());

        return redirect()->route('prestamos.index')
            ->with('success', 'Prestamo updated successfully');
    }

    public function destroy($id)
    {
    // Buscar el préstamo por su ID
    $prestamo = Prestamo::find($id);

    // Obtener el ID del libro asociado al préstamo
    $libro_id = $prestamo->libro_id;

    // Eliminar el préstamo
    $prestamo->delete();

    // Incrementar la cantidad de copias disponibles del libro
    $libro = Libro::find($libro_id);
    $libro->copias += 1; // Incrementar en uno la cantidad de copias disponibles
    $libro->save(); // Guardar el libro actualizado

    // Redireccionar al usuario al listado de préstamos
    return redirect()->route('prestamos.index')
        ->with('success', 'El préstamo se ha eliminado correctamente y la copia se ha devuelto.');
    }
}
