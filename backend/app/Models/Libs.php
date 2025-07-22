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
        'author_id',
    ];

    // Relación: un libro pertenece a un author
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
