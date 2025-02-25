<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const props = defineProps({
    annonces: {
        type: Array,
        default: () => []
    },
    error: {
        type: String,
        default: null
    }
});

const approveForm = useForm({});
const rejectForm = useForm({});

const approveAnnonce = (annonceId) => {
    approveForm.post(route('admin.annonces.approve', annonceId), {
        preserveScroll: true,
    });
};

const rejectAnnonce = (annonceId) => {
    rejectForm.post(route('admin.annonces.reject', annonceId), {
        preserveScroll: true,
    });
};
</script>

<template>
    <Head title="Annonces en attente" />
    
    <DashboardLayout title="Annonces en attente">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Annonces en attente d'approbation
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- Message d'erreur -->
                <div v-if="error" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Erreur!</strong>
                    <span class="block sm:inline"> {{ error }}</span>
                </div>

                <!-- Message de succès -->
                <div v-if="$page.props.flash && $page.props.flash.success" class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Succès!</strong>
                    <span class="block sm:inline"> {{ $page.props.flash.success }}</span>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-6">
                            Liste des annonces en attente
                        </h3>
                    </div>
                    <div class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <div v-for="annonce in annonces" :key="annonce.id" class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ annonce.titre }}</h4>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ annonce.user_name || 'Utilisateur inconnu' }}
                                        <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">
                                            En attente
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ annonce.description && annonce.description.substring(0, 100) }}{{ annonce.description && annonce.description.length > 100 ? '...' : '' }}</p>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ annonce.localisation }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                        {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(annonce.prix) }}
                                    </div>
                                    <div class="mt-2 flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ new Date(annonce.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' }) }}
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <Link :href="route('annonces.show', annonce.id)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900 dark:text-indigo-300 dark:hover:bg-indigo-800">
                                        Voir
                                    </Link>
                                    <button @click="approveAnnonce(annonce.id)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800">
                                        Approuver
                                    </button>
                                    <button @click="rejectAnnonce(annonce.id)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:bg-red-900 dark:text-red-300 dark:hover:bg-red-800">
                                        Rejeter
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div v-if="!annonces || annonces.length === 0" class="p-6 text-center text-gray-500 dark:text-gray-400">
                            Aucune annonce en attente d'approbation.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template> 