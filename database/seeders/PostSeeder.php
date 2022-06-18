<?php

namespace Database\Seeders;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory(10)->create();
   /*  $json = Storage::disk('public')->get('posts.json');
    $post = json_decode($json);

    foreach ($post as $key => $value) {
        Post::create([  
            'user_id' => $value->user_id,
            'category_id' => $value->category_id,
            'title' => $value->title,
            'slug' => $value->slug,
            'excerpt' => $value->excerpt,
            'content' => $value->content,
            'image' => $value->image,
            'status' => $value->status,
        ]);
    } */
}
}
