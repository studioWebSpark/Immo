<script setup>
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const props = defineProps({
    title: String,
});

// Déterminer si l'utilisateur est un administrateur
const isAdmin = computed(() => page.props.auth.user.is_admin);
const sidebarOpen = ref(false);
const annonceDropdownOpen = ref(false);

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value;
};

const toggleAnnonceDropdown = () => {
    annonceDropdownOpen.value = !annonceDropdownOpen.value;
};

const logout = () => {
    router.post(route('logout'));
};

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

// Vérifier si Jetstream est activé et si l'utilisateur a une équipe actuelle
const hasTeamFeatures = computed(() => {
    return page.props.jetstream && page.props.jetstream.hasTeamFeatures;
});

const hasCurrentTeam = computed(() => {
    return page.props.auth.user && page.props.auth.user.current_team;
});
</script>

<template>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <title>{{ title }}</title>
        
        <!-- Sidebar mobile toggle -->
        <div class="lg:hidden fixed top-0 left-0 z-20 w-full bg-white dark:bg-gray-800 shadow-md p-4 flex justify-between items-center">
            <div class="flex items-center">
                <button @click="toggleSidebar" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <span class="ml-2 text-lg font-semibold">{{ title }}</span>
            </div>
            <div class="flex items-center">
                <img class="h-8 w-8 rounded-full" :src="$page.props.auth.user.profile_photo_url" alt="" />
                <span class="ml-2 text-sm font-medium hidden sm:inline">{{ $page.props.auth.user.name }}</span>
            </div>
        </div>

        <!-- Sidebar -->
        <div :class="[
            'fixed inset-y-0 left-0 z-10 w-72 bg-white dark:bg-gray-800 shadow-lg transform transition-transform duration-300 ease-in-out',
            sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
        ]">
            <!-- Logo et Profil en haut -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="/logo.svg" alt="Logo" class="h-10 w-auto" />
                        <span class="ml-3 text-xl font-semibold text-gray-800 dark:text-white">ConseillerImmo</span>
                    </div>
                    <button @click="toggleSidebar" class="lg:hidden text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Profil utilisateur -->
                <div class="mt-4 flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full" :src="$page.props.auth.user.profile_photo_url" alt="" />
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800 dark:text-white">{{ $page.props.auth.user.name }}</div>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $page.props.auth.user.email }}</div>
                    </div>
                </div>
                
                <!-- Actions rapides -->
                <div class="mt-3 flex space-x-2">
                    <Link 
                        :href="route('profile.show')"
                        class="flex-1 inline-flex justify-center items-center px-2 py-1 text-xs font-medium rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600"
                    >
                        Profil
                    </Link>
                    <button 
                        @click="logout"
                        class="flex-1 inline-flex justify-center items-center px-2 py-1 text-xs font-medium rounded-md bg-red-100 text-red-700 hover:bg-red-200 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800"
                    >
                        Déconnexion
                    </button>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex flex-col h-[calc(100%-180px)]">
                <div class="flex-grow py-4 px-4 space-y-2 overflow-y-auto no-scrollbar">
                    <!-- Admin Navigation -->
                    <template v-if="isAdmin">
                        <Link 
                            :href="route('dashboard')"
                            :class="[
                                route().current('dashboard') 
                                    ? 'bg-indigo-500 text-white' 
                                    : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700',
                                'group flex items-center px-3 py-3 text-base font-medium rounded-md w-full'
                            ]"
                        >
                            <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Tableau de bord
                        </Link>

                        <!-- Menu déroulant Annonces -->
                        <div class="mt-2">
                            <button 
                                @click="toggleAnnonceDropdown" 
                                :class="[
                                    route().current('annonces.*') 
                                        ? 'bg-indigo-500 text-white' 
                                        : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700',
                                    'group flex items-center justify-between px-3 py-3 text-base font-medium rounded-md w-full'
                                ]"
                            >
                                <div class="flex items-center">
                                    <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Annonces
                                </div>
                                <svg 
                                    :class="[annonceDropdownOpen ? 'transform rotate-180' : '', 'w-5 h-5']" 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 20 20" 
                                    fill="currentColor"
                                >
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <div v-show="annonceDropdownOpen" class="pl-12 mt-1 space-y-1">
                                <Link 
                                    :href="route('annonces.index')"
                                    :class="[
                                        route().current('annonces.index') 
                                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' 
                                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700',
                                        'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                    ]"
                                >
                                    Toutes les annonces
                                </Link>
                                
                                <Link 
                                    :href="route('annonces.pending')"
                                    :class="[
                                        route().current('annonces.pending') 
                                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' 
                                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700',
                                        'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                    ]"
                                >
                                    Annonces en attente
                                </Link>
                                
                                <Link 
                                    :href="route('annonces.approved')"
                                    :class="[
                                        route().current('annonces.approved') 
                                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' 
                                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700',
                                        'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                    ]"
                                >
                                    Annonces validées
                                </Link>
                                
                                <Link 
                                    :href="route('annonces.create')"
                                    :class="[
                                        route().current('annonces.create') 
                                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' 
                                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700',
                                        'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                    ]"
                                >
                                    Créer une annonce
                                </Link>
                            </div>
                        </div>
                        
                        <Link 
                            :href="route('vendeurs.index')"
                            :class="[
                                route().current('vendeurs.*') 
                                    ? 'bg-indigo-500 text-white' 
                                    : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700',
                                'group flex items-center px-3 py-3 text-base font-medium rounded-md w-full mt-2'
                            ]"
                        >
                            <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Vendeurs
                        </Link>
                        
                        <Link 
                            :href="route('statistiques')"
                            :class="[
                                route().current('statistiques') 
                                    ? 'bg-indigo-500 text-white' 
                                    : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700',
                                'group flex items-center px-3 py-3 text-base font-medium rounded-md w-full mt-2'
                            ]"
                        >
                            <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            Statistiques
                        </Link>
                    </template>
                    
                    <!-- Vendeur Navigation -->
                    <template v-else>
                        <Link 
                            :href="route('dashboard')"
                            :class="[
                                route().current('dashboard') 
                                    ? 'bg-indigo-500 text-white' 
                                    : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700',
                                'group flex items-center px-3 py-3 text-base font-medium rounded-md w-full'
                            ]"
                        >
                            <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            Tableau de bord
                        </Link>
                        
                        <!-- Menu déroulant Annonces pour vendeur -->
                        <div class="mt-2">
                            <button 
                                @click="toggleAnnonceDropdown" 
                                :class="[
                                    route().current('annonces.*') 
                                        ? 'bg-indigo-500 text-white' 
                                        : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700',
                                    'group flex items-center justify-between px-3 py-3 text-base font-medium rounded-md w-full'
                                ]"
                            >
                                <div class="flex items-center">
                                    <svg class="mr-4 h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    Annonces
                                </div>
                                <svg 
                                    :class="[annonceDropdownOpen ? 'transform rotate-180' : '', 'w-5 h-5']" 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    viewBox="0 0 20 20" 
                                    fill="currentColor"
                                >
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <div v-show="annonceDropdownOpen" class="pl-12 mt-1 space-y-1">
                                <Link 
                                    :href="route('annonces.mes-annonces')"
                                    :class="[
                                        route().current('annonces.mes-annonces') 
                                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' 
                                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700',
                                        'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                    ]"
                                >
                                    Mes annonces
                                </Link>
                                
                                <Link 
                                    :href="route('annonces.create')"
                                    :class="[
                                        route().current('annonces.create') 
                                            ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' 
                                            : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700',
                                        'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                    ]"
                                >
                                    Créer une annonce
                                </Link>
                            </div>
                        </div>
                    </template>

                    <!-- Teams Navigation (pour tous) -->
                    <div v-if="hasTeamFeatures" class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
                        <div class="px-3 py-2">
                            <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                Équipes
                            </h3>
                        </div>
                        
                        <!-- Lien vers la page d'équipe actuelle -->
                        <template v-if="hasCurrentTeam">
                            <Link 
                                :href="route('teams.show', $page.props.auth.user.current_team.id)"
                                :class="[
                                    route().current('teams.show') 
                                        ? 'bg-indigo-500 text-white' 
                                        : 'text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700',
                                    'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                ]"
                            >
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                {{ $page.props.auth.user.current_team.name }}
                            </Link>
                            
                            <!-- Lien vers la page de création d'équipe -->
                            <Link 
                                :href="route('teams.create')"
                                :class="[
                                    route().current('teams.create') 
                                        ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300' 
                                        : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-700',
                                    'group flex items-center px-3 py-2 text-sm font-medium rounded-md w-full'
                                ]"
                            >
                                <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Créer une équipe
                            </Link>
                        </template>
                        
                        <!-- Message si pas d'équipe actuelle -->
                        <div v-else class="px-3 py-2 text-sm text-gray-500 dark:text-gray-400">
                            Aucune équipe active. Créez-en une pour commencer.
                            <Link 
                                :href="route('teams.create')"
                                class="mt-2 block text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300"
                            >
                                Créer une équipe
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div :class="['lg:pl-72 flex flex-col flex-1 min-h-screen pt-16 lg:pt-0']">
            <div class="py-6 px-4 sm:px-6 lg:px-8 flex-grow">
                <!-- Header (optionnel) -->
                <header v-if="$slots.header" class="mb-6">
                    <slot name="header" />
                </header>
                
                <!-- Content Area -->
                <main>
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>

<style scoped>
@media (max-width: 1023px) {
    .lg\:pl-72 {
        padding-left: 0;
    }
}

/* Masquer la barre de défilement tout en permettant le défilement */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

.no-scrollbar::-webkit-scrollbar {
    display: none;  /* Chrome, Safari and Opera */
}

/* Styles pour mobile */
@media (max-width: 640px) {
    .sidebar-open {
        width: 100%;
    }
}
</style> 