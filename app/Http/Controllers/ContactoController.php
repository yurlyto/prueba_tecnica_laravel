<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactos = Contacto::all();
        return response()->json($contactos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identificacion' => 'required|unique:contactos',
            'nombre' => 'required|string|max:191',
            'telefono' => 'nullable|string|max:191',
            'direccion' => 'nullable|string|max:191',
            'notas' => 'nullable|string|max:191',
            'fecha_nacimiento' => 'nullable|date',
            'creado_por' => 'nullable|integer',
            'email' => 'nullable|email|max:191|unique:contactos',
            'entidad_id' => 'required|exists:entidades,id',
        ]);

        $contacto = Contacto::create($validatedData);
        return response()->json($contacto, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contacto $contacto)
    {
        return response()->json($contacto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $contacto = Contacto::find($id);

        if (!$contacto) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'identificacion' => 'required|string|max:191|unique:contactos,identificacion,' . $contacto->id,
            'nombre' => 'required|string|max:191',
            'telefono' => 'nullable|string|max:191',
            'direccion' => 'nullable|string|max:191',
            'notas' => 'nullable|string|max:191',
            'fecha_nacimiento' => 'nullable|date',
            'creado_por' => 'nullable|integer',
            'email' => 'nullable|email|max:191|unique:contactos,email,' . $contacto->id,
            'entidad_id' => 'required|exists:entidades,id',
        ]);

        $contacto->update($validatedData);
        return response()->json($contacto, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contacto $contacto)
    {
        $contacto->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
