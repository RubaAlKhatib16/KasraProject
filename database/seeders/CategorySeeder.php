<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run()
    {
        $categories = ['إلكترونيات', 'ملابس', 'كتب', 'أثاث', 'مستحضرات تجميل', 'رياضة'];
        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
            ]);
        }
    }
}
