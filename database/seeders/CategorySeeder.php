<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'nom' => 'Maison',
                'description' => 'Maisons individuelles, villas, pavillons',
            ],
            [
                'nom' => 'Appartement',
                'description' => 'Appartements, studios, lofts',
            ],
            [
                'nom' => 'Terrain',
                'description' => 'Terrains constructibles ou non constructibles',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'nom' => $category['nom'],
                'slug' => Str::slug($category['nom']),
                'description' => $category['description'],
                'active' => true,
            ]);
        }
    }
}
