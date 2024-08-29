<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['genre'];

    public function genre(): BelongsTo {
        return $this->belongsTo(Genre::class);
    }

    public function userGame(): HasMany {
        return $this->hasMany(UserGame::class);
    }
}
