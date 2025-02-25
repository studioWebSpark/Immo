<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const props = defineProps({
    annonce: Object,
});
</script>

<template>
    <Head :title="annonce.titre" />

    <DashboardLayout :title="annonce.titre">
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ annonce.titre }}
                </h2>
                <div class="flex space-x-2">
                    <Link :href="route('annonces.index')" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 dark:bg-gray-900 dark:text-gray-300 dark:hover:bg-gray-800">
                        Retour aux annonces
                    </Link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ annonce.titre }}</h3>
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
                                
                                <div class="mt-4 text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(annonce.prix) }}
                                </div>
                                
                                <div class="mt-6">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">Description</h4>
                                    <p class="mt-2 text-gray-600 dark:text-gray-400 whitespace-pre-line">{{ annonce.description }}</p>
                                </div>
                                
                                <div class="mt-6 grid grid-cols-2 gap-4">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Localisation</h4>
                                        <p class="mt-1 text-gray-900 dark:text-white flex items-center">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ annonce.localisation }}
                                        </p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Catégorie</h4>
                                        <p class="mt-1 text-gray-900 dark:text-white">{{ annonce.categorie.nom }}</p>
                                    </div>
                                    
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Date de publication</h4>
                                        <p class="mt-1 text-gray-900 dark:text-white">{{ new Date(annonce.created_at).toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' }) }}</p>
                                    </div>
                                    
                                    <div v-if="annonce.vendeur">
                                        <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Vendeur</h4>
                                        <p class="mt-1 text-gray-900 dark:text-white flex items-center">
                                            <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            {{ annonce.vendeur.prenom }} {{ annonce.vendeur.name }}
                                            <span v-if="$page.props.auth.user.is_admin"> - {{ annonce.vendeur.telephone }}</span>
                                        </p>
                                    </div>
                                </div>
                                
                                <div v-if="annonce.images && annonce.images.length > 0" class="mt-8">
                                    <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Images</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div v-for="image in annonce.images" :key="image.id" class="relative">
                                            <img :src="`/storage/${image.chemin}`" class="w-full h-64 object-cover rounded-md" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 flex justify-end space-x-4">
                            <Link v-if="$page.props.auth.user.is_admin && annonce.status === 'pending'" :href="route('annonces.approve', annonce.id)" method="post" as="button" type="button" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Approuver
                            </Link>
                            
                            <Link v-if="$page.props.auth.user.is_admin && annonce.status === 'pending'" :href="route('annonces.reject', annonce.id)" method="post" as="button" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Rejeter
                            </Link>
                            
                            <Link v-if="$page.props.auth.user.id === annonce.user_id || $page.props.auth.user.is_admin" :href="route('annonces.edit', annonce.id)" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Modifier
                            </Link>
                            
                            <Link v-if="$page.props.auth.user.id === annonce.user_id || $page.props.auth.user.is_admin" :href="route('annonces.destroy', annonce.id)" method="delete" as="button" type="button" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150" @click="confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Supprimer
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template> 