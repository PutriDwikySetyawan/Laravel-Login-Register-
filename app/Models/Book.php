<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'stock',
        'isbn',
    ];

    /**
     * Relasi: satu buku bisa dipinjam di banyak loan.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}
