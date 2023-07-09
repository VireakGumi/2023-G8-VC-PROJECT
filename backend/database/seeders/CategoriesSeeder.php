<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
                ['category_name' => 'Cartoon'],
                ['category_name' => 'Comedy'],
                ['category_name' => 'Education'],
                ['category_name' => 'Explore'],
                ['category_name' => 'Technology'],
                ['category_name' => 'Sports'],
                ['category_name' => 'Show'],
                ['category_name' => 'Creativity'],
                ['category_name' => 'Art'],
                ['category_name' => 'Animation'],
        ];
        foreach ($categories as $category){
            Categories::create($category);
        }
    }
}
