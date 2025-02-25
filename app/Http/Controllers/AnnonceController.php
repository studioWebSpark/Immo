<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Categorie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class AnnonceController extends Controller
{
    /**
     * Affiche la liste de toutes les annonces.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $user = Auth::user();

        // Si l'utilisateur est admin, afficher toutes les annonces
        // Sinon, afficher uniquement les annonces approuvées
        $annonces = $user->is_admin
            ? Annonce::with(['vendeur', 'categorie', 'images'])
            ->orderBy('created_at', 'desc')
            ->get()
            : Annonce::with(['vendeur', 'categorie', 'images'])
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Annonces/Index', [
            'annonces' => $annonces
        ]);
    }

    /**
     * Affiche les annonces en attente d'approbation.
     *
     * @return \Inertia\Response
     */
    public function pending()
    {
        $annonces = Annonce::with(['vendeur', 'categorie', 'images'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Annonces/Pending', [
            'annonces' => $annonces
        ]);
    }

    /**
     * Affiche les annonces de l'utilisateur connecté.
     *
     * @return \Inertia\Response
     */
    public function userAnnonces()
    {
        $annonces = Auth::user()->annonces()
            ->with(['categorie'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Annonces/UserAnnonces', [
            'annonces' => $annonces
        ]);
    }

    /**
     * Affiche le formulaire de création d'une annonce.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // Forcer la création des catégories si elles n'existent pas
        if (Category::count() === 0) {
            foreach (Category::CATEGORIES as $nom => $description) {
                Category::create([
                    'nom' => $nom,
                    'slug' => Str::slug($nom),
                    'description' => $description,
                    'active' => true,
                ]);
            }
        }

        // Récupérer toutes les catégories
        $categories = Category::all();

        // Déboguer - Vérifier si des catégories existent
        \Log::info('Catégories disponibles: ' . $categories->count());
        foreach ($categories as $category) {
            \Log::info('Catégorie: ' . $category->id . ' - ' . $category->nom);
        }

        // Si aucune catégorie n'est trouvée, créer un tableau avec les catégories par défaut
        if ($categories->isEmpty()) {
            $categories = [
                ['id' => 1, 'nom' => Category::MAISON],
                ['id' => 2, 'nom' => Category::APPARTEMENT],
                ['id' => 3, 'nom' => Category::TERRAIN],
            ];
        }

        return Inertia::render('Annonces/Create', [
            'categories' => $categories,
        ]);
    }

    /**
     * Enregistre une nouvelle annonce.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'categorie_id' => 'required|exists:categories,id',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'code_postal' => 'required|string',
            'superficie' => 'required|numeric',
            'nb_pieces' => 'required|integer',
            'nb_chambres' => 'required|integer',
            'nb_salles_bain' => 'required|integer',
            'image' => 'required|image|max:2048', // 2MB max
        ]);

        // Créer l'annonce sans l'image
        $annonce = Annonce::create([
            'user_id' => Auth::id(),
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'prix' => $validated['prix'],
            'adresse' => $validated['adresse'],
            'ville' => $validated['ville'],
            'code_postal' => $validated['code_postal'],
            'superficie' => $validated['superficie'],
            'nb_pieces' => $validated['nb_pieces'],
            'nb_chambres' => $validated['nb_chambres'],
            'nb_salles_bain' => $validated['nb_salles_bain'],
            'categorie_id' => $validated['categorie_id'],
            'status' => 'pending',
        ]);

        // Gérer l'upload de l'image et l'enregistrer dans la table annonce_images
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('annonces', 'public');

            // Créer une entrée dans la table annonce_images
            $annonce->images()->create([
                'chemin' => $imagePath
            ]);
        }

        // Rediriger vers la page d'accueil avec un message de succès
        return redirect()->route('dashboard')->with('success', 'Votre annonce a été créée avec succès et sera validée par un administrateur prochainement.');
    }

    /**
     * Affiche une annonce spécifique.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Inertia\Response
     */
    public function show(Annonce $annonce)
    {
        $annonce->load(['vendeur', 'categorie', 'images']);

        return Inertia::render('Annonces/Show', [
            'annonce' => $annonce
        ]);
    }

    /**
     * Affiche le formulaire d'édition d'une annonce.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Inertia\Response
     */
    public function edit(Annonce $annonce)
    {
        // Vérifier que l'utilisateur est le propriétaire de l'annonce ou un admin
        if (Auth::id() !== $annonce->user_id && !Auth::user()->is_admin) {
            abort(403, 'Non autorisé');
        }

        $annonce->load(['categorie', 'images']);
        $categories = Categorie::all();

        return Inertia::render('Annonces/Edit', [
            'annonce' => $annonce,
            'categories' => $categories
        ]);
    }

    /**
     * Met à jour une annonce spécifique.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Annonce $annonce)
    {
        // Vérifier que l'utilisateur est le propriétaire de l'annonce ou un admin
        if (Auth::id() !== $annonce->user_id && !Auth::user()->is_admin) {
            abort(403, 'Non autorisé');
        }

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'prix' => 'required|numeric',
            'adresse' => 'required|string',
            'ville' => 'required|string',
            'code_postal' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Mettre à jour l'annonce
        $annonce->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'prix' => $validated['prix'],
            'adresse' => $validated['adresse'],
            'ville' => $validated['ville'],
            'code_postal' => $validated['code_postal'],
        ]);

        // Synchroniser les catégories (supprimer les anciennes et ajouter les nouvelles)
        $annonce->categories()->sync($validated['category_id']);

        // Traiter les images si présentes
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('annonces', 'public');

                $annonce->images()->create([
                    'chemin' => $path
                ]);
            }
        }

        // Supprimer les images si demandé
        if ($request->has('images_to_delete')) {
            foreach ($request->images_to_delete as $imageId) {
                $image = $annonce->images()->find($imageId);
                if ($image) {
                    Storage::disk('public')->delete($image->chemin);
                    $image->delete();
                }
            }
        }

        return redirect()->route('annonces.show', $annonce)
            ->with('success', 'Annonce mise à jour avec succès' .
                (!Auth::user()->is_admin ? ' et en attente d\'approbation.' : '.'));
    }

    /**
     * Supprime une annonce spécifique.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Annonce $annonce)
    {
        // Vérifier que l'utilisateur est le propriétaire de l'annonce ou un admin
        if (Auth::id() !== $annonce->user_id && !Auth::user()->is_admin) {
            abort(403, 'Non autorisé');
        }

        // Supprimer les images associées
        foreach ($annonce->images as $image) {
            Storage::disk('public')->delete($image->chemin);
            $image->delete();
        }

        $annonce->delete();

        return redirect()->route('annonces.mes-annonces')
            ->with('success', 'Annonce supprimée avec succès');
    }

    /**
     * Approuve une annonce.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\RedirectResponse
     */
    public function approve(Annonce $annonce)
    {
        $annonce->status = 'approved';
        $annonce->save();

        return redirect()->route('annonces.pending')->with('success', 'Annonce approuvée avec succès.');
    }

    /**
     * Rejette une annonce.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reject(Annonce $annonce)
    {
        $annonce->status = 'rejected';
        $annonce->save();

        return redirect()->route('annonces.pending')->with('success', 'Annonce rejetée avec succès.');
    }

    /**
     * Affiche les annonces approuvées.
     *
     * @return \Inertia\Response
     */
    public function approved()
    {
        $annonces = Annonce::with(['vendeur', 'categorie', 'images'])
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Annonces/Approved', [
            'annonces' => $annonces
        ]);
    }
}
