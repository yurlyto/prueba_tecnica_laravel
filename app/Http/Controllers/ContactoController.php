<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use App\Models\Entidad;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $contactos = Contacto::with('entidad')->get();
            return response()->json($contactos, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:191',
                'identificacion' => 'required|string|max:191',
                'email' => 'nullable|email|unique:contactos',
                'telefono' => 'nullable|string|max:20',
                'direccion' => 'nullable|string|max:191',
                'notas' => 'nullable|string',
                'entidad_id' => 'required|exists:entidades,id',
                'fecha_nacimiento' => 'nullable|date'
            ]);

            $contacto = Contacto::create($validatedData);
            return response()->json($contacto->load('entidad'), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contacto $contacto)
    {
        try {
            $contacto = Contacto::with('entidad')->findOrFail($contacto->id);
            return response()->json($contacto, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contacto $contacto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contacto $contacto)
    {
        try {
            $contacto = Contacto::findOrFail($contacto->id);
            
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:191',
                'email' => ['nullable', 'email', Rule::unique('contactos')->ignore($contacto->id)],
                'telefono' => 'nullable|string|max:20',
                'direccion' => 'nullable|string|max:191',
                'notas' => 'nullable|string',
                'entidad_id' => 'required|exists:entidades,id',
                'fecha_nacimiento' => 'nullable|date'
            ]);

            $contacto->update($validatedData);
            return response()->json($contacto, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contacto $contacto)
    {
        try {
            $contacto = Contacto::findOrFail($contacto->id);
            $contacto->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Contacto no encontrado'], Response::HTTP_NOT_FOUND);
        }
    }
}
