<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use App\Http\Requests\EtiquetaRequest;

/**
 * Class EtiquetaController
 * @package App\Http\Controllers
 */
class EtiquetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etiquetas = Etiqueta::paginate();

        return view('etiqueta.index', compact('etiquetas'))
            ->with('i', (request()->input('page', 1) - 1) * $etiquetas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etiqueta = new Etiqueta();
        return view('etiqueta.create', compact('etiqueta'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EtiquetaRequest $request)
    {
        Etiqueta::create($request->validated());

        return redirect()->route('etiquetas.index')
            ->with('success', 'Etiqueta created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $etiqueta = Etiqueta::find($id);

        return view('etiqueta.show', compact('etiqueta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $etiqueta = Etiqueta::find($id);

        return view('etiqueta.edit', compact('etiqueta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EtiquetaRequest $request, Etiqueta $etiqueta)
    {
        $etiqueta->update($request->validated());

        return redirect()->route('etiquetas.index')
            ->with('success', 'Etiqueta updated successfully');
    }

    public function destroy($id)
    {
        Etiqueta::find($id)->delete();

        return redirect()->route('etiquetas.index')
            ->with('success', 'Etiqueta deleted successfully');
    }
}
