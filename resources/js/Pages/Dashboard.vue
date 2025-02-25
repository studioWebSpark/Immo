<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const props = defineProps({
    annoncesRecentes: {
        type: Array,
        default: () => [],
    },
    annoncesEnAttente: {
        type: Array,
        default: () => [],
    },
    totalAnnonces: {
        type: Number,
        default: 0,
    },
    totalVendeurs: {
        type: Number,
        default: 0,
    },
    totalAnnoncesApprouvees: {
        type: Number,
        default: 0,
    },
    totalAnnoncesEnAttente: {
        type: Number,
        default: 0,
    },
});
</script>

<template>

    <Head title="Tableau de bord" />

    <DashboardLayout title="Tableau de bord">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Tableau de bord
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Statistiques pour les admins -->
                <div v-if="$page.props.auth.user.is_admin"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total des annonces</p>
                                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ totalAnnonces }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Annonces approuvées</p>
                                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{
                                    totalAnnoncesApprouvees }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-yellow-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Annonces en attente</p>
                                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{
                                    totalAnnoncesEnAttente }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-500 bg-opacity-75">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total des vendeurs</p>
                                <p class="text-2xl font-semibold text-gray-800 dark:text-white">{{ totalVendeurs }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Annonces en attente pour les admins -->
                <div v-if="$page.props.auth.user.is_admin && annoncesEnAttente && annoncesEnAttente.length > 0"
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Annonces en attente de
                                validation</h3>
                            <Link :href="route('annonces.pending')"
                                class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            Voir toutes
                            </Link>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <div v-for="annonce in annoncesEnAttente" :key="annonce.id" class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ annonce.titre }}
                                    </h4>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{
                                        annonce.description.substring(0, 100) }}{{ annonce.description.length > 100 ?
                                            '...' : '' }}</p>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ annonce.localisation }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        {{ new Intl.NumberFormat('fr-FR', {
                                            style: 'currency', currency: 'EUR'
                                        }).format(annonce.prix) }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ annonce.vendeur.prenom }} {{ annonce.vendeur.name }} - {{
                                            annonce.vendeur.telephone }}
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <Link :href="route('annonces.show', annonce.id)"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900 dark:text-indigo-300 dark:hover:bg-indigo-800">
                                    Voir
                                    </Link>
                                    <Link :href="route('annonces.approve', annonce.id)" method="post" as="button"
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800">
                                    Approuver
                                    </Link>
                                    <Link :href="route('annonces.reject', annonce.id)" method="post" as="button"
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800">
                                    Rejeter
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Annonces récentes -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                {{ $page.props.auth.user.is_admin ? 'Annonces récentes' : 'Mes annonces récentes' }}
                            </h3>
                            <Link
                                :href="$page.props.auth.user.is_admin ? route('annonces.index') : route('annonces.mes-annonces')"
                                class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            Voir toutes
                            </Link>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <div v-for="annonce in annoncesRecentes" :key="annonce.id" class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center">
                                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ annonce.titre
                                        }}</h4>
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                                            :class="{
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': annonce.status === 'approved',
                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': annonce.status === 'pending',
                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': annonce.status === 'rejected'
                                            }">
                                            <span v-if="annonce.status === 'approved'" class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Approuvée
                                            </span>
                                            <span v-else-if="annonce.status === 'pending'" class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                En attente
                                            </span>
                                            <span v-else class="flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Rejetée
                                            </span>
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{
                                        annonce.description.substring(0, 100) }}{{ annonce.description.length > 100 ?
                                            '...' : '' }}</p>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ annonce.localisation }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        {{ new Intl.NumberFormat('fr-FR', {
                                            style: 'currency', currency: 'EUR'
                                        }).format(annonce.prix) }}
                                    </div>
                                    <div v-if="$page.props.auth.user.is_admin && annonce.vendeur"
                                        class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ annonce.vendeur.prenom }} {{ annonce.vendeur.name }} - {{
                                            annonce.vendeur.telephone
                                        }}
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <Link :href="route('annonces.show', annonce.id)"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900 dark:text-indigo-300 dark:hover:bg-indigo-800">
                                    Voir
                                    </Link>
                                    <Link v-if="$page.props.auth.user.is_admin && annonce.status === 'pending'"
                                        :href="route('annonces.approve', annonce.id)" method="post" as="button"
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800">
                                    Approuver
                                    </Link>
                                    <Link v-if="$page.props.auth.user.is_admin && annonce.status === 'pending'"
                                        :href="route('annonces.reject', annonce.id)" method="post" as="button"
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800">
                                    Rejeter
                                    </Link>
                                    <Link
                                        v-if="$page.props.auth.user.id === annonce.user_id || $page.props.auth.user.is_admin"
                                        :href="route('annonces.edit', annonce.id)"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 dark:bg-yellow-900 dark:text-yellow-300 dark:hover:bg-yellow-800">
                                    Modifier
                                    </Link>
                                </div>
                            </div>
                        </div>
                        <div v-if="!annoncesRecentes || annoncesRecentes.length === 0"
                            class="p-6 text-center text-gray-500 dark:text-gray-400">
                            Aucune annonce disponible.
                        </div>
                    </div>
                </div>

                <!-- Bouton de création d'annonce -->
                <div class="mt-8 flex justify-end">
                    <Link :href="route('annonces.create')"
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                        </path>
                    </svg>
                    Créer une annonce
                    </Link>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
