<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Movie::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%")
                ->orWhere('genre', 'like', "%$search%");
        }

        $movies = $query->paginate(10);
        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'genre' => 'required|string|max:100',
        ]);

        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
            'genre' => $request->genre,
        ]);

        return redirect()->route('movies.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer',
            'genre' => 'required|string|max:100',
        ]);

        $movie->update($request->only(['title', 'description', 'duration', 'genre']));

        return redirect()->route('movies.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }
}
