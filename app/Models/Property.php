<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'bedrooms',
        'bathrooms',
        'area',
        'address',
        'city',
        'postal_code',
        'region',
        'country',
        'latitude',
        'longitude',
        'property_type', // appartement, maison, terrain, etc.
        'status', // à vendre, à louer, vendu, etc.
        'featured',
        'user_id', // l'agent responsable
    ];

    protected $casts = [
        'price' => 'float',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'area' => 'float',
        'featured' => 'boolean',
    ];

    // Relation avec l'utilisateur (agent)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les images
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }

    // Relation avec les caractéristiques
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }
}
