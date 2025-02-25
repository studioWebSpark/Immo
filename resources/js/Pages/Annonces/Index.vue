<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const props = defineProps({
    annonces: Array,
});
</script>

<template>
    <Head title="Toutes les annonces" />

    <DashboardLayout title="Toutes les annonces">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Toutes les annonces
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                Liste des annonces
                            </h3>
                            <Link :href="route('annonces.create')" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Créer une annonce
                            </Link>
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
                                            {{ annonce.vendeur ? annonce.vendeur.name : 'Utilisateur inconnu' }}
                                            <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full" 
                                                  :class="{
                                                      'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300': annonce.status === 'approved',
                                                      'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300': annonce.status === 'pending',
                                                      'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300': annonce.status === 'rejected'
                                                  }">
                                                <span v-if="annonce.status === 'approved'" class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Approuvée
                                                </span>
                                                <span v-else-if="annonce.status === 'pending'" class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    En attente
                                                </span>
                                                <span v-else class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Rejetée
                                                </span>
                                            </span>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ annonce.description && annonce.description.substring(0, 100) }}{{ annonce.description && annonce.description.length > 100 ? '...' : '' }}</p>
                                    </div>
                                    <div class="flex space-x-2">
                                        <Link :href="route('annonces.show', annonce.id)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:bg-indigo-900 dark:text-indigo-300 dark:hover:bg-indigo-800">
                                            Voir
                                        </Link>
                                        <Link :href="route('annonces.edit', annonce.id)" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 dark:bg-yellow-900 dark:text-yellow-300 dark:hover:bg-yellow-800">
                                            Modifier
                                        </Link>
                                    </div>
                                </div>
                            </div>
                            <div v-if="!annonces || annonces.length === 0" class="p-6 text-center text-gray-500 dark:text-gray-400">
                                Aucune annonce disponible.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template> 