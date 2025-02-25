<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AdminAnnonceController extends Controller
{
    /**
     * Constructeur qui vérifie si l'utilisateur est connecté
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Vérifie si l'utilisateur est un administrateur
     *
     * @return bool
     */
    private function isAdmin()
    {
        return Auth::check() && Auth::user()->is_admin;
    }

    /**
     * Vérifie si l'utilisateur est un administrateur et redirige si ce n'est pas le cas
     *
     * @return \Illuminate\Http\RedirectResponse|null
     */
    private function checkAdmin()
    {
        if (!$this->isAdmin()) {
            return redirect()->route('dashboard')
                ->with('error', 'Vous n\'avez pas les droits d\'administrateur nécessaires.');
        }

        return null;
    }

    /**
     * Affiche les annonces en attente d'approbation.
     *
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function pending()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }

        try {
            // Utiliser une requête DB brute pour éviter les problèmes de relations
            $annonces = [];

            // Vérifier si la table existe
            if (DB::getSchemaBuilder()->hasTable('annonces')) {
                $annonces = DB::table('annonces')
                    ->leftJoin('users', 'annonces.user_id', '=', 'users.id')
                    ->leftJoin('categories', 'annonces.categorie_id', '=', 'categories.id')
                    ->select(
                        'annonces.*',
                        'users.name as user_name',
                        'categories.nom as categorie_nom'
                    )
                    ->where('annonces.status', 'pending')
                    ->orderBy('annonces.created_at', 'desc')
                    ->get();
            }

            return Inertia::render('Annonces/Pending', [
                'annonces' => $annonces
            ]);
        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de l\'affichage des annonces en attente: ' . $e->getMessage());

            // Renvoyer une vue avec un message d'erreur
            return Inertia::render('Annonces/Pending', [
                'annonces' => [],
                'error' => 'Une erreur est survenue lors du chargement des annonces: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Affiche les annonces approuvées.
     *
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function approved()
    {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }

        try {
            // Utiliser une requête DB brute pour éviter les problèmes de relations
            $annonces = [];

            // Vérifier si la table existe
            if (DB::getSchemaBuilder()->hasTable('annonces')) {
                $annonces = DB::table('annonces')
                    ->leftJoin('users', 'annonces.user_id', '=', 'users.id')
                    ->leftJoin('categories', 'annonces.categorie_id', '=', 'categories.id')
                    ->select(
                        'annonces.*',
                        'users.name as user_name',
                        'categories.nom as categorie_nom'
                    )
                    ->where('annonces.status', 'approved')
                    ->orderBy('annonces.created_at', 'desc')
                    ->get();
            }

            return Inertia::render('Annonces/Approved', [
                'annonces' => $annonces
            ]);
        } catch (\Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de l\'affichage des annonces approuvées: ' . $e->getMessage());

            // Renvoyer une vue avec un message d'erreur
            return Inertia::render('Annonces/Approved', [
                'annonces' => [],
                'error' => 'Une erreur est survenue lors du chargement des annonces: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Approuve une annonce.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }

        try {
            DB::table('annonces')
                ->where('id', $id)
                ->update(['status' => 'approved']);

            return redirect()->route('admin.annonces.pending')
                ->with('success', 'Annonce approuvée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'approbation de l\'annonce: ' . $e->getMessage());

            return redirect()->route('admin.annonces.pending')
                ->with('error', 'Une erreur est survenue lors de l\'approbation de l\'annonce: ' . $e->getMessage());
        }
    }

    /**
     * Rejette une annonce.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject($id)
    {
        $redirect = $this->checkAdmin();
        if ($redirect) {
            return $redirect;
        }

        try {
            DB::table('annonces')
                ->where('id', $id)
                ->update(['status' => 'rejected']);

            return redirect()->route('admin.annonces.pending')
                ->with('success', 'Annonce rejetée avec succès.');
        } catch (\Exception $e) {
            Log::error('Erreur lors du rejet de l\'annonce: ' . $e->getMessage());

            return redirect()->route('admin.annonces.pending')
                ->with('error', 'Une erreur est survenue lors du rejet de l\'annonce: ' . $e->getMessage());
        }
    }
}
