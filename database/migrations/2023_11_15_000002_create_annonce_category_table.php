<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('annonce_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            // Empêcher les doublons
            $table->unique(['annonce_id', 'category_id']);
        });
        
        // Supprimer la colonne category_id de la table annonces si elle existe
        if (Schema::hasColumn('annonces', 'category_id')) {
            Schema::table('annonces', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('annonce_category');
        
        // Recréer la colonne category_id si nécessaire
        Schema::table('annonces', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
        });
    }
}; 