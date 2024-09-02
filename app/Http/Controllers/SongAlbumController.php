<?php

namespace App\Http\Controllers;
use App\Models\Album;
use App\Models\Song;

use Illuminate\Http\Request;

class SongAlbumController extends Controller
{
    public function attachAlbum(Song $song, Album $album)
    {
        $song->albums()->attach($album);
        return redirect()->route('songs.edit', [$song]);
    }

    public function detachAlbum(Song $song, Album $album)
    {
        $song->albums()->detach($album);
        return redirect()->route('songs.edit', [$song]);
    }
}
