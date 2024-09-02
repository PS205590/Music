<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Song;
use Illuminate\Database\Eloquent\Builder;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        return view('albums.index', compact('albums')); // -> index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create'); // -> create.blade.php
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
            'name' => 'required',
            'year' => 'required|integer',
            'times_sold' => 'required|integer'
        ]);
        // De values ophalen van de create.blade form
        $album = new Album([
            'name' => $request->get('name'),
            'year' => $request->get('year'),
            'times_sold' => $request->get('times_sold')
        ]);
        $album->save();
        return redirect('/albums')->with('success', 'Album added.');   // -> index.blade.php
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::find($id);
        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::find($id);

        $songs= Song::whereDoesntHave('albums', function (Builder $query) use ($album) {
            $query->where('album_id', $album->id);
        })->get();

        return view('albums.edit', ['album' => $album, 'songs' => $songs]); // -> edit.blade.php
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
            'name' => 'required',
            'year' => 'required|integer',
            'times_sold' => 'required|integer'
        ]);
        $album = Album::find($id);
        // De values ophalen van de edit.blade form
        $album->name =  $request->get('name');
        $album->year = $request->get('year');
        $album->times_sold = $request->get('times_sold');
        $album->save();

        return redirect('/albums')->with('success', 'Album updated.'); // -> index.blade.php
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        $album->delete();

        return redirect('/albums')->with('success', 'Album removed.');  // -> index.blade.php
    }
}
