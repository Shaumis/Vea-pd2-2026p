<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'voicebank_id', 'image'])]
class Song extends Model
{
    public function voicebank(): BelongsTo
    {
        return $this->belongsTo(Voicebank::class);
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => intval($this->id),
            'name' => $this->name,
            'voicebank' => $this->voicebank->name,
            'image' => asset('images/' . $this->image),
        ];
    }
}
