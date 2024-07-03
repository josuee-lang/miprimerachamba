<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Libro; 
use App\Models\Reservar;
use App\Http\Requests\ReservarRequest;

/**
 * Class ReservarController
 * @package App\Http\Controllers
 */
class ReservarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservars = Reservar::paginate();

        return view('reservar.index', compact('reservars'))
            ->with('i', (request()->input('page', 1) - 1) * $reservars->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservar = new Reservar();
        $reservar->status = 'pendiente';
        $users = User::all();
        $libros = Libro::all();
        return view('reservar.create', compact('reservar', 'users','libros'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservarRequest $request)
    {
        $reserva = new Reservar();
        $reserva->user_id = $request->user_id;
        $reserva->libro_id = $request->libro_id;
        $reserva->reservar_at = $request->reservar_at;
        $reserva->status = 'pendiente';
        $reserva->save();
    
        // Reducir la cantidad de copias disponibles del libro reservado
        $libro = Libro::find($request->libro_id); // Buscar el libro por su ID
        $libro->copias -= 1; // Reducir en uno la cantidad de copias disponibles
        $libro->save(); // Guardar el libro actualizado
    
        // Redirigir al usuario a la página de index de libros con mensaje de éxito
        return redirect()->route('libros.index')->with('success', 'La reserva se ha guardado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservar = Reservar::find($id);

        return view('reservar.show', compact('reservar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reservar = Reservar::find($id);

        return view('reservar.edit', compact('reservar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservarRequest $request, Reservar $reservar)
    {
        $reservar->update($request->validated());

        return redirect()->route('reservars.index')
            ->with('success', 'Reservar updated successfully');
    }

    public function destroy($id)
    {
    // Buscar la reserva por su ID
    $reserva = Reservar::find($id);

    // Obtener el ID del libro asociado a la reserva
    $libro_id = $reserva->libro_id;

    // Eliminar la reserva
    $reserva->delete();

    // Incrementar la cantidad de copias disponibles del libro
    $libro = Libro::find($libro_id);
    $libro->copias += 1; // Incrementar en uno la cantidad de copias disponibles
    $libro->save(); // Guardar el libro actualizado

    // Redireccionar al usuario al listado de reservas
    return redirect()->route('reservars.index')
        ->with('success', 'La reserva se ha eliminado correctamente y la copia se ha devuelto.');
    }

}
