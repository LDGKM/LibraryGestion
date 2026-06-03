<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Loan extends Model
{
    use HasFactory;
    protected $fillable=
    [
        "book_id",
        "user_id",
        "status",
        "borrowed_at",
        "due_at",
        "returned_at",
        "penality_amount",
        "notes",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book():BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

}
