<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artist extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        'bio',
        'user_id',

    ];

    public function user(): belongsTo{
        return $this->belongsTo(User::class);
    }
}
