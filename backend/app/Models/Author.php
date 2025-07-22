<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    protected $table = 'authors';

    protected $fillable = [
        'name',
        'email',
        'total_books',
    ];

    //La Relación un autor tiene muchos libros
    public function libs()
    {
        return $this->hasMany(Libs::class, 'autor_id');
    }
}