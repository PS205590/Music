<?php

namespace App\Http\Controllers;
use App\Models\Album;
use App\Models\Song;

use Illuminate\Http\Request;

class AlbumSongController extends Controller
{
    public function attachSong(Album $album, Song $song)
    {
        $album->songs()->attach($song);
        return redirect()->route('albums.edit', [$album]);
    }

    public function detachSong(Album $album, Song $song)
    {
        $album->songs()->detach($song);
        return redirect()->route('albums.edit', [$album]);
    }
}
