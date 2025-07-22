<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\UpdatedTotalLibsJob;
use App\Models\Libs;
use App\Http\Requests\LibsRequest;

class LibsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libs = Libs::with('author')->get();
        return response()->json($libs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LibsRequest $request)
    {

        $lib = Libs::create([
            'title' => $request->title,
            'description' => $request->description,
            'author_id' => $request->author_id,
        ]);

        // Dispara el job para actualizar la cantidad de libros del author
        UpdatedTotalLibsJob::dispatch($lib->author_id);

        return response()->json(['message' => 'Libro creado exitosamente', 'lib' => $lib], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $lib = Libs::with('author')->find($id);

        if (!$lib) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }
        
        return response()->json($lib);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LibsRequest $request, string $id)
    {
        $lib = Libs::find($id);

        if (!$lib) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        if($lib->author_id != $request->author_id){
            $lastAuthor = $lib->author_id;

            $lib->update($request->validated());

            // Actualiza ambos authores
            UpdatedTotalLibsJob::dispatch($lastAuthor);
            UpdatedTotalLibsJob::dispatch($lib->author_id);

        }else {
             // Actualiza el libro con los datos validados
            $lib->update($request->validated());
        }

        return response()->json(['message' => 'Libro actualizado correctamente', 'lib' => $lib]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $lib = Libs::find($id);

        if (!$lib) {
            return response()->json(['message' => 'Libro no encontrado'], 404);
        }

        $authorId = $lib->author_id;

        $lib->delete();

        // Actualiza la cantidad de libros del author tras eliminar
        UpdatedTotalLibsJob::dispatch($authorId);

        return response()->json(['message' => 'Libro eliminado correctamente', 'lib' => $lib]);
    }
}
