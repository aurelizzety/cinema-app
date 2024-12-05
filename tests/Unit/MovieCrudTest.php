<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_movie()
    {
        $movieData = [
            'title' => 'Example Movie',
            'description' => 'This is an example description for the movie.',
            'duration' => 120,
            'genre' => 'Action',
        ];

        $movie = Movie::create($movieData);

        $this->assertDatabaseHas('movies', [
            'title' => 'Example Movie',
        ]);
    }

    public function test_read_movie()
    {
        $movie = Movie::factory()->create([
            'title' => 'Read Test Movie',
        ]);

        $retrievedMovie = Movie::find($movie->id);

        $this->assertEquals($movie->title, $retrievedMovie->title);
    }

    public function test_update_movie()
    {
        $movie = Movie::factory()->create([
            'title' => 'Old Title',
            'description' => 'Old description.',
        ]);

        $movie->update([
            'title' => 'Updated Title',
            'description' => 'Updated description.',
        ]);

        $this->assertDatabaseHas('movies', [
            'title' => 'Updated Title',
        ]);

        $this->assertDatabaseMissing('movies', [
            'title' => 'Old Title',
        ]);
    }

    public function test_delete_movie()
    {
        $movie = Movie::factory()->create([
            'title' => 'Movie to be deleted',
        ]);

        $this->assertDatabaseHas('movies', [
            'title' => 'Movie to be deleted',
        ]);

        $movie->delete();

        $this->assertDatabaseMissing('movies', [
            'title' => 'Movie to be deleted',
        ]);
    }
}
