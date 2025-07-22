<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Libs extends Model
{
     use HasFactory;

    protected $table = 'libs';

    protected $fillable = [
        'title',
        'genre',
        'autor_id',
    ];

    // Relación: un libro pertenece a un autor
    public function autor()
    {
        return $this->belongsTo(Author::class, 'autor_id');
    }
}
