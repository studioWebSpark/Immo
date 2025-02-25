<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnonceImage extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'annonce_id',
        'chemin',
    ];

    /**
     * Obtenir l'annonce associée à cette image.
     */
    public function annonce()
    {
        return $this->belongsTo(Annonce::class);
    }
}
