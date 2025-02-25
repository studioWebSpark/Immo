<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\VendeurController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\AdminAnnonceController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes publiques
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/properties', function () {
    return Inertia::render('Properties/Index');
})->name('properties.index');

Route::get('/properties/{id}', function ($id) {
    // Simuler des données d'une propriété
    $property = [
        'id' => $id,
        'title' => 'Belle villa avec piscine',
        'description' => 'Une magnifique villa avec vue sur la mer...',
        'price' => 750000,
        // Ajoutez d'autres données de test
    ];
    return Inertia::render('Properties/Show', ['property' => $property]);
})->name('properties.show');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $data = [];

        if ($user->is_admin) {
            $data = [
                'annonces' => \App\Models\Annonce::with('vendeur')->get(),
                'vendeurs' => \App\Models\User::where('is_admin', false)->withCount('annonces')->get(),
                'annoncesEnAttente' => \App\Models\Annonce::where('status', 'pending')->with('vendeur')->get(),
            ];
        } else {
            $data = [
                'annonces' => \App\Models\Annonce::where('user_id', $user->id)->get(),
            ];
        }

        return Inertia::render('Dashboard', $data);
    })->name('dashboard');

    // Profil utilisateur
    Route::get('/profile', function () {
        return Inertia::render('Profile/Edit');
    })->name('profile.edit');

    // Propriétés (création, édition, suppression)
    Route::get('/properties/create', function () {
        return Inertia::render('Properties/Create');
    })->name('properties.create');

    Route::get('/properties/{id}/edit', function ($id) {
        // Simuler des données d'une propriété
        $property = [
            'id' => $id,
            'title' => 'Belle villa avec piscine',
            'description' => 'Une magnifique villa avec vue sur la mer...',
            'price' => 750000,
            'type' => 'villa',
            'area' => 250,
            'status' => 'active',
            'bedrooms' => 4,
            'bathrooms' => 3,
            'address' => '123 Rue de la Plage',
            'city' => 'Nice',
            'postal_code' => '06000',
            'country' => 'France',
            'energy_class' => 'B',
            'features' => [
                'has_garage' => true,
                'has_garden' => true,
                'has_pool' => true,
                'has_balcony' => false,
                'has_elevator' => false,
                'is_furnished' => false,
                'has_air_conditioning' => true,
                'has_heating' => true,
                'has_security_system' => true
            ],
            'photos' => [
                ['id' => 1, 'url' => 'https://via.placeholder.com/800x600', 'is_main' => true],
                ['id' => 2, 'url' => 'https://via.placeholder.com/800x600', 'is_main' => false],
                ['id' => 3, 'url' => 'https://via.placeholder.com/800x600', 'is_main' => false]
            ],
            'seller_id' => 1
        ];

        // Simuler des données de vendeurs
        $sellers = [
            ['id' => 1, 'name' => 'Jean Dupont', 'email' => 'jean@example.com'],
            ['id' => 2, 'name' => 'Marie Martin', 'email' => 'marie@example.com']
        ];

        return Inertia::render('Properties/Edit', [
            'property' => $property,
            'sellers' => $sellers
        ]);
    })->name('properties.edit');

    // Messages
    Route::get('/messages', function () {
        return Inertia::render('Messages/Index');
    })->name('messages.index');

    Route::get('/messages/{id}', function ($id) {
        // Simuler des données de conversation
        $conversation = [
            'id' => $id,
            'contact' => [
                'id' => 2,
                'name' => 'Marie Martin',
                'avatar' => 'https://via.placeholder.com/40',
                'isOnline' => true,
                'lastSeen' => now()->subHours(2)
            ],
            'messages' => [
                [
                    'sender' => 'contact',
                    'content' => 'Bonjour, je suis intéressé par votre propriété.',
                    'timestamp' => now()->subDays(2),
                    'read' => true
                ],
                [
                    'sender' => 'me',
                    'content' => 'Bonjour, merci pour votre intérêt. Quand souhaiteriez-vous visiter ?',
                    'timestamp' => now()->subDays(2)->addHours(1),
                    'read' => true
                ],
                [
                    'sender' => 'contact',
                    'content' => 'Serait-il possible de visiter ce week-end ?',
                    'timestamp' => now()->subDays(1),
                    'read' => true
                ],
                [
                    'sender' => 'me',
                    'content' => 'Bien sûr, samedi à 14h vous conviendrait ?',
                    'timestamp' => now()->subHours(12),
                    'read' => true
                ]
            ]
        ];

        // Simuler des données de propriétés
        $properties = [
            [
                'id' => 1,
                'title' => 'Belle villa avec piscine',
                'image' => 'https://via.placeholder.com/100',
                'price' => 750000,
                'location' => 'Nice, France'
            ],
            [
                'id' => 2,
                'title' => 'Appartement en centre-ville',
                'image' => 'https://via.placeholder.com/100',
                'price' => 350000,
                'location' => 'Paris, France'
            ]
        ];

        return Inertia::render('Messages/Conversation', [
            'conversation' => $conversation,
            'properties' => $properties
        ]);
    })->name('messages.show');

    // Rendez-vous
    Route::get('/appointments', function () {
        return Inertia::render('Appointments/Index');
    })->name('appointments.index');

    Route::get('/appointments/create', function () {
        return Inertia::render('Appointments/Create');
    })->name('appointments.create');

    Route::get('/appointments/{id}/edit', function ($id) {
        return Inertia::render('Appointments/Edit', ['id' => $id]);
    })->name('appointments.edit');

    // Annonces
    Route::get('/annonces', [AnnonceController::class, 'index'])->name('annonces.index');
    Route::get('/annonces/create', [AnnonceController::class, 'create'])->name('annonces.create');
    Route::post('/annonces', [AnnonceController::class, 'store'])->name('annonces.store');
    Route::get('/annonces/{annonce}', [AnnonceController::class, 'show'])->name('annonces.show');
    Route::get('/annonces/{annonce}/edit', [AnnonceController::class, 'edit'])->name('annonces.edit');
    Route::put('/annonces/{annonce}', [AnnonceController::class, 'update'])->name('annonces.update');
    Route::delete('/annonces/{annonce}', [AnnonceController::class, 'destroy'])->name('annonces.destroy');

    // Routes pour les annonces en attente (admin seulement)
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/annonces-en-attente', [AnnonceController::class, 'pending'])->name('annonces.pending');
        Route::post('/annonces/{annonce}/approve', [AnnonceController::class, 'approve'])->name('annonces.approve');
        Route::post('/annonces/{annonce}/reject', [AnnonceController::class, 'reject'])->name('annonces.reject');

        // Vendeurs
        Route::get('/vendeurs', [VendeurController::class, 'index'])->name('vendeurs.index');
        Route::get('/vendeurs/{vendeur}', [VendeurController::class, 'show'])->name('vendeurs.show');
        Route::get('/vendeurs/{vendeur}/edit', [VendeurController::class, 'edit'])->name('vendeurs.edit');
        Route::put('/vendeurs/{vendeur}', [VendeurController::class, 'update'])->name('vendeurs.update');

        // Statistiques
        Route::get('/statistiques', [StatistiqueController::class, 'index'])->name('statistiques');

        // Nouvelle route pour les annonces approuvées
        Route::get('/annonces-approuvees', [AnnonceController::class, 'approved'])->name('annonces.approved');
    });

    // Route pour les annonces de l'utilisateur connecté
    Route::middleware(['auth'])->get('/mes-annonces', [AnnonceController::class, 'userAnnonces'])->name('annonces.user');

    // Routes pour l'administration des annonces
    Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/annonces-en-attente', [AdminAnnonceController::class, 'pending'])->name('annonces.pending');
        Route::get('/annonces-approuvees', [AdminAnnonceController::class, 'approved'])->name('annonces.approved');
        Route::post('/annonces/{id}/approve', [AdminAnnonceController::class, 'approve'])->name('annonces.approve');
        Route::post('/annonces/{id}/reject', [AdminAnnonceController::class, 'reject'])->name('annonces.reject');
    });

    // Routes pour l'administration des catégories
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('categories', CategoryController::class);
    });
});
