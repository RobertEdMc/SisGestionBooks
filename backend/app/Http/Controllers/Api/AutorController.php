<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Autor;
use App\Http\Requests\AutorRequest;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Autor::all();
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $autor = Autor::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'total_books' => 0,
        ]);

        return response()->json(['message' => 'Autor creado exitosamente', 'autor' => $autor], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $autor = Autor::find($id);

        if (!$autor) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }

        return response()->json($autor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $autor = Autor::find($id);

        if (!$autor) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }

        $autor->update($request->validated());

        return response()->json(['message' => 'Autor actualizado correctamente', 'author' => $autor]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $autor = Autor::find($id);

        if (!$autor) {
            return response()->json(['message' => 'Autor no encontrado'], 404);
        }

        $autor->delete();

        return response()->json(['message' => 'Autor eliminado correctamente']);
    }
    
}
