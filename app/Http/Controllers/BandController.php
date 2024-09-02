<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Band;

class BandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bands = Band::all();
        return view('bands.index', compact('bands')); // -> index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bands.create'); // -> create.blade.php
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
            'genre' => 'required',
            'founded' => 'required|integer',
        ]);
        // De values ophalen van de create.blade form
        $band = new Band([
            'name' => $request->get('name'),
            'genre' => $request->get('genre'),
            'founded' => $request->get('founded'),
            'active_till' => $request->get('active_till')
        ]);
        $band->save();
        return redirect('/bands')->with('success', 'Band added.');   // -> index.blade.php
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $band = Band::find($id);
        return view('bands.show', compact('band'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $band = Band::find($id);
        return view('bands.edit', compact('band'));  // -> edit.blade.php
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
            'genre' => 'required',
            'founded' => 'required|integer'
        ]);
        $band = Band::find($id);
        // De values ophalen van de edit.blade form
        $band->name =  $request->get('name');
        $band->genre = $request->get('genre');
        $band->founded = $request->get('founded');
        $band->active_till = $request->get('active_till');
        $band->save();

        return redirect('/bands')->with('success', 'Band updated.'); // -> index.blade.php
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $band = Band::find($id);
        $band->delete();

        return redirect('/bands')->with('success', 'Band removed.');  // -> index.blade.php
    }
}
