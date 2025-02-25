<script setup>
import { Head, Link } from '@inertiajs/vue3';
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
</script>

<template>
    <Head title="Annonces approuvées" />

    <DashboardLayout title="Annonces approuvées">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Annonces approuvées
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
                            Liste des annonces approuvées
                        </h3>

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
                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                                Approuvée
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ annonce.description && annonce.description.substring(0, 100) }}{{ annonce.description && annonce.description.length > 100 ? '...' : '' }}</p>
                                    </div>
                                    <div>
                                        <Link :href="route('annonces.show', annonce.id)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900 dark:text-indigo-300 dark:hover:bg-indigo-800">
                                            Voir
                                        </Link>
                                    </div>
                                </div>
                            </div>
                            <div v-if="!annonces || annonces.length === 0" class="p-6 text-center text-gray-500 dark:text-gray-400">
                                Aucune annonce approuvée.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template> 