<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Afficher le tableau de bord.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->is_admin) {
            // Pour les administrateurs
            $annoncesRecentes = Annonce::with('vendeur:id,name,prenom,email,telephone,profile_photo_path')
                ->with('categorie:id,nom')
                ->latest()
                ->take(5)
                ->get();

            $annoncesEnAttente = Annonce::with('vendeur:id,name,prenom,email,telephone,profile_photo_path')
                ->with('categorie:id,nom')
                ->where('status', 'pending')
                ->latest()
                ->take(5)
                ->get();

            $totalAnnonces = Annonce::count();
            $totalVendeurs = User::where('is_admin', false)->count();
            $totalAnnoncesApprouvees = Annonce::where('status', 'approved')->count();
            $totalAnnoncesEnAttente = Annonce::where('status', 'pending')->count();

            return Inertia::render('Dashboard', [
                'annoncesRecentes' => $annoncesRecentes,
                'annoncesEnAttente' => $annoncesEnAttente,
                'totalAnnonces' => $totalAnnonces,
                'totalVendeurs' => $totalVendeurs,
                'totalAnnoncesApprouvees' => $totalAnnoncesApprouvees,
                'totalAnnoncesEnAttente' => $totalAnnoncesEnAttente,
            ]);
        } else {
            // Pour les vendeurs
            $annoncesRecentes = Annonce::with('categorie:id,nom')
                ->where('user_id', $user->id)
                ->latest()
                ->take(5)
                ->get();

            return Inertia::render('Dashboard', [
                'annoncesRecentes' => $annoncesRecentes,
                'annoncesEnAttente' => [],
                'totalAnnonces' => Annonce::where('user_id', $user->id)->count(),
                'totalAnnoncesApprouvees' => Annonce::where('user_id', $user->id)->where('status', 'approved')->count(),
                'totalAnnoncesEnAttente' => Annonce::where('user_id', $user->id)->where('status', 'pending')->count(),
            ]);
        }
    }
}
