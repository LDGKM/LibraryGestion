<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'first_name',
        'last_name',
        'bio',
        'birth_date',
        'death_date',
        'nationalite',
        'photo_path'
    ];

    public function books(): BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }

}
