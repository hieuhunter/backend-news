<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $posts_count = Post::all()->count();
		$tags_count = Tag::all()->count();
		$post_tags = [];
		for ($i = 1; $i <= $posts_count; $i++) {
			for ($j = 1; $j <= $tags_count; $j++) {
				array_push($post_tags, $i . '-' . $j);
			}
		}
		$post_and_tag = $this->faker->unique->randomElement($post_tags);
		$post_and_tag = explode('-', $post_and_tag);
		$post_id = $post_and_tag[0];
		$tag_id = $post_and_tag[1];

		return [
			'post_id' => $post_id,
			'tag_id' => $tag_id
		];
    }
}
