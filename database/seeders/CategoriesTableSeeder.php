<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0;$i<=5;$i++) {
            if($i==0) {
                Category::create([
                    'name' => 'Root',
                    'slug' => 'category-slug-root',
                    'parent_id' => 0,
                    'description' => 'This is the root category, don\'t delete this one',
                    'status' => 1,
                ]);
            }else{
                Category::create([
                    'name' => 'Category '.$i,
                    'slug' => 'category-slug-' . $i,
                    'parent_id' => 0,
                    'description' => 'This is dummy Category',
                    'status' => 1,
                ]);
            }
        }
    }
}
