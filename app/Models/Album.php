<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'times_sold',
        'band_id'
    ];

    public $timestamps = false;

    // Get the songs from the album
    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }

    //Get the band that owns the albums.
    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
