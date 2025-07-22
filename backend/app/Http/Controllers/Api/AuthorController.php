<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::create([
            'name'        => $request->name,
            'email'       => $request->email,
            'total_books' => 0,
        ]);

        return response()->json(['message' => 'Author creado exitosamente', 'author' => $author], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author no encontrado'], 404);
        }

        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AuthorRequest $request, string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author no encontrado'], 404);
        }

        $author->update($request->validated());

        return response()->json(['message' => 'Author actualizado correctamente', 'author' => $author]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);

        if (!$author) {
            return response()->json(['message' => 'Author no encontrado'], 404);
        }

        $author->delete();

        return response()->json(['message' => 'Author eliminado correctamente']);
    }
    
}
