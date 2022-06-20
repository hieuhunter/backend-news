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
                'name' => 'Test',
                'slug' => 'test'
            ],
            [
                'id' => 2,
               /*  'parent_id' => 1, */
                'name' => 'Test222',
                'slug' => 'test2'
            ],
            [
                'id' => 3,
           /*      'parent_id' => 2, */
                'name' => 'Test333',
                'slug' => 'test3444'
            ]
        ];
        foreach ($categories as $category) {
			Category::create($category);
		}

    }
}
