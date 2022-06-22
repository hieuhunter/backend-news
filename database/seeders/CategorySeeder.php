<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                /*    'parent_id' => null, */
                'name' => 'Thế giới',
                'slug' => 'the-gioi',
            ],
            [
                'id' => 2,
                /*  'parent_id' => 1, */
                'name' => 'Kinh tế',
                'slug' => 'kinh-te',
            ],
            [
                'id' => 3,
                /*      'parent_id' => 2, */
                'name' => 'Xã hội',
                'slug' => 'xa-hoi',
            ],
            [
                'id' => 4,
                /*      'parent_id' => 2, */
                'name' => 'Thể thao',
                'slug' => 'the-thao',
            ],
            [
                'id' => 6,
                /*      'parent_id' => 2, */
                'name' => 'Giáo dục',
                'slug' => 'giao-duc',
            ],
        ];
        foreach ($categories as $category) {
            Category::create($category);
        }

        /* Category::fixTree(); */
    }
}
