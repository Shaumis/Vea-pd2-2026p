<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Voicebank extends Model
{
    protected $table = 'voicebanks';

    protected $fillable = ['name'];

    public function songs(): HasMany
    {
        return $this->hasMany(Song::class, 'voicebank_id');
    }
}