<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(10)->create();

        Storage::deleteDirectory('imagenes');
        Storage::makeDirectory('imagenes');

        // Crear 30 Posts con imágenes asociadas
        $posts = Post::factory(30)->create();
        foreach ($posts as $post) {
            $post->image()->save(Image::factory()->make());
        }

        // Crear 30 Videos con imágenes asociadas
        $videos = Video::factory(30)->create();
        foreach ($videos as $video) {
            $video->image()->save(Image::factory()->make());
        };
    }
}
