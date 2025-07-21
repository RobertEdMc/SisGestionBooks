<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'autors';

    protected $fillable = [
        'name',
        'email',
        'total_books',
    ];

    //La Relación un autor tiene muchos libros
    public function libros()
    {
        return $this->hasMany(Libs::class, 'autor_id');
    }
}