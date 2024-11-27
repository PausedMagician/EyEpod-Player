<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Song extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'album_id',
        'genre_id',
        'length'
    ];
    
    public function album(): BelongsTo{
        return $this->belongsTo(Album::class);
    }

    public function genre(): BelongsTo{
        return $this->belongsTo(Genre::class);
    }
}
