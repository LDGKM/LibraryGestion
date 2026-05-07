<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'titre',
        'description',
        'annee_de_publication',
        'isbn',
        'nb_exemp',
        'image'
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
                    ->withTimestamps()
                    ->withPivot('order')
                    ->wherePivot('active', true);
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)
                    ->withTimestamps()
                    ->withPivot('order')
                    ->wherePivot('active', true);
    }
}
