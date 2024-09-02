<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Models\Song;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = Song::all();
        return view('songs.index', compact('songs')); // -> index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // --> Array om songs die door de API opgehaald worden in op te slaan
        $songsFromAPI = [];

        // --> Als de request een title bevat
        if ($request->query->has('title')) {

            // --> API Key van Last.FM
            $api_key = 'e22c613b118c51899292e1b5ed91703e';

            // --> Maakt een variable aan met de title van de song
            $title = $request->query('title');

            // --> Maakt een variable aan met de API URL
            $response = Http::get('http://ws.audioscrobbler.com/2.0/?method=track.search&track=' . $title . '&api_key=' . $api_key . '&format=json')->json();

            // --> Geeft een response als er een resultaat is
            $songsFromAPI = $response["results"]["trackmatches"]["track"];
        }

        return view('songs.create', compact('songsFromAPI')); // -> create.blade.php
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validatie voor de required velden
        $request->validate([
            'title' => 'required',
            'singer' => 'required',
        ]);
        // De values ophalen van de create.blade form
        $song = new Song([
            'title' => $request->get('title'),
            'singer' => $request->get('singer'),
        ]);
        $song->save();
        return redirect('/songs')->with('success', 'Song saved.');   // -> index.blade.php
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $song = Song::find($id);
        return view('songs.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $song = Song::find($id);

        $albums = Album::whereDoesntHave('songs', function (Builder $query) use ($song) {
            $query->where('song_id', $song->id);
        })->get();

        return view('songs.edit', ['song' => $song, 'albums' => $albums]); // -> edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validatie voor de required velden
        $request->validate([
            'title' => 'required',
            'singer' => 'required',
        ]);
        $song = Song::find($id);
        // De values ophalen van de edit.blade form
        $song->title =  $request->get('title');
        $song->singer = $request->get('singer');
        $song->save();

        return redirect('/songs')->with('success', 'Song updated.'); // -> index.blade.php
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = Song::find($id);
        $song->delete();

        return redirect('/songs')->with('success', 'Song removed.');  // -> index.blade.php
    }
}
