<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'artist_id',
        'genre_id',
        'release_date',
    ];

    public function artist(): BelongsTo{
        return $this->belongsTo(Artist::class);
    }

    public function genre(): BelongsTo{
        return $this->belongsTo(Genre::class);
    }
}
