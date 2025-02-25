<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'slug', 'description', 'active'];

    // Définir les catégories comme constantes
    public const MAISON = 'Maison';
    public const APPARTEMENT = 'Appartement';
    public const TERRAIN = 'Terrain';

    // Tableau des catégories pour faciliter l'accès
    public const CATEGORIES = [
        self::MAISON => 'Maisons individuelles',
        self::APPARTEMENT => 'Appartements et studios',
        self::TERRAIN => 'Terrains constructibles',
    ];

    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'categorie_id');
    }

    // Méthode pour récupérer l'ID d'une catégorie par son nom
    public static function getIdByName($name)
    {
        $category = self::where('nom', $name)->first();
        return $category ? $category->id : null;
    }
}
