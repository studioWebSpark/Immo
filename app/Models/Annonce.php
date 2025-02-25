<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'titre',
        'description',
        'prix',
        'adresse',
        'ville',
        'code_postal',
        'superficie',
        'nb_pieces',
        'nb_chambres',
        'nb_salles_bain',
        'image',
        'categorie_id',
        'status',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'prix' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Obtenir le vendeur de l'annonce.
     */
    public function vendeur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtenir la catégorie de l'annonce.
     */
    public function categorie()
    {
        return $this->belongsTo(Category::class, 'categorie_id');
    }

    /**
     * Obtenir les images de l'annonce.
     */
    public function images()
    {
        return $this->hasMany(AnnonceImage::class);
    }

    public function getMainImageAttribute()
    {
        return $this->images()->first()->chemin ?? null;
    }
}
