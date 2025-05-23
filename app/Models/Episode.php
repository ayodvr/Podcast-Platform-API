<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'audio_url', 'duration', 'podcast_id'];

    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
