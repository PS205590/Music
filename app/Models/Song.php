<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'singer',
        'band',
        'album'
    ];

    // Get the albums the song is in
    public function albums()
    {
        return $this->belongsToMany(Album::class);
    }
}
