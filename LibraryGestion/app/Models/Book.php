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
                    ->withTimestamps();
    }

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)
                    ->withTimestamps();
    }

    public function loans():HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
