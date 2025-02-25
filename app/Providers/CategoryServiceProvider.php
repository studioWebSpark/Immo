<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class CategoryServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Vérifier si la table categories existe
        if (!\Schema::hasTable('categories')) {
            return;
        }

        // Vérifier si des catégories existent déjà
        if (Category::count() === 0) {
            // Créer les catégories à partir des constantes
            foreach (Category::CATEGORIES as $nom => $description) {
                Category::create([
                    'nom' => $nom,
                    'slug' => Str::slug($nom),
                    'description' => $description,
                    'active' => true,
                ]);
            }
        }
    }

    public function register()
    {
        //
    }
}
