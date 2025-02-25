<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Supprimer d'abord la table annonce_images qui dépend de annonces
        Schema::dropIfExists('annonce_images');

        // Maintenant on peut supprimer la table annonces en toute sécurité
        Schema::dropIfExists('annonces');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cette migration est irréversible
    }
};
