<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use App\Models\Libs;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{

    // funcion que creara el archivo xlsx y subir todo los datos de los autores y los libros totales
    public function exportAuthorsAndLibs()
    {
        $authors = Author::select('id', 'name', 'email', 'total_books')->get();
        $libs = Libs::with('author')->get()->map(function ($lib) {
            return [
                'ID'          => $lib->id,
                'Autor'       => $lib->author->name ?? 'Sin autor',
                'Título'      => $lib->title,
                'Descripción' => $lib->description
            ];
        });

        $combined = collect([
            ['Sección' => 'Autores'],
            ['ID' => 'ID', 'Nombre' => 'Nombre', 'Email' => 'Email', 'Total Libros' => 'Total Libros'],
        ])
        ->merge($authors->toArray())
        ->merge([
            ['Sección' => 'Libros'],
            ['ID' => 'ID', 'Autor' => 'Autor' ,'Título' => 'Título', 'Descripción' => 'Descripción'],
        ])
        ->merge($libs->toArray());

        return (new FastExcel($combined))->download('authors_libs.xlsx');
    }
}
