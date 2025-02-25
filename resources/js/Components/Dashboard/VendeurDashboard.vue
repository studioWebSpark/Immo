<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';

defineProps({
    annonces: Array,
});

const activeTab = ref('mesAnnonces'); // Options: 'mesAnnonces', 'creerAnnonce'
const nouvelleAnnonce = ref({
    titre: '',
    description: '',
    prix: '',
    localisation: '',
    // Autres champs nécessaires
});

const creerAnnonce = () => {
    router.post('/annonces', nouvelleAnnonce.value);
};
</script>

<template>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
        <!-- Onglets de navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button 
                    @click="activeTab = 'mesAnnonces'"
                    :class="[
                        activeTab === 'mesAnnonces' 
                            ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300',
                        'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm'
                    ]"
                >
                    Mes annonces
                </button>
                <button 
                    @click="activeTab = 'creerAnnonce'"
                    :class="[
                        activeTab === 'creerAnnonce' 
                            ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300',
                        'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm'
                    ]"
                >
                    Créer une annonce
                </button>
            </nav>
        </div>

        <!-- Contenu des onglets -->
        <div v-if="activeTab === 'mesAnnonces'" class="space-y-6">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Mes annonces</h3>
                <button 
                    @click="activeTab = 'creerAnnonce'" 
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    Nouvelle annonce
                </button>
            </div>
            
            <div v-if="annonces.length === 0" class="text-gray-500 dark:text-gray-400">
                Vous n'avez pas encore créé d'annonces.
            </div>
            
            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div v-for="annonce in annonces" :key="annonce.id" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <div class="flex justify-between">
                        <h4 class="font-bold">{{ annonce.titre }}</h4>
                        <span 
                            :class="[
                                annonce.statut === 'publiée' ? 'bg-green-100 text-green-800' : 
                                annonce.statut === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : 
                                'bg-red-100 text-red-800',
                                'px-2 py-1 text-xs rounded-full'
                            ]"
                        >
                            {{ 
                                annonce.statut === 'publiée' ? 'Publiée' : 
                                annonce.statut === 'en_attente' ? 'En attente' : 
                                'Rejetée' 
                            }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{{ annonce.description.substring(0, 100) }}...</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Prix: {{ annonce.prix }} €</span>
                        <div class="flex space-x-2">
                            <Link :href="`/annonces/${annonce.id}/edit`" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                Modifier
                            </Link>
                            <button class="text-red-600 dark:text-red-400 hover:underline">Supprimer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="activeTab === 'creerAnnonce'" class="space-y-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Créer une nouvelle annonce</h3>
            
            <form @submit.prevent="creerAnnonce" class="space-y-4">
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titre</label>
                    <input 
                        id="titre" 
                        v-model="nouvelleAnnonce.titre" 
                        type="text" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    >
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea 
                        id="description" 
                        v-model="nouvelleAnnonce.description" 
                        rows="4" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    ></textarea>
                </div>
                
                <div>
                    <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Prix (€)</label>
                    <input 
                        id="prix" 
                        v-model="nouvelleAnnonce.prix" 
                        type="number" 
                        min="0" 
                        step="0.01" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    >
                </div>
                
                <div>
                    <label for="localisation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Localisation</label>
                    <input 
                        id="localisation" 
                        v-model="nouvelleAnnonce.localisation" 
                        type="text" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required
                    >
                </div>
                
                <!-- Ajoutez d'autres champs selon vos besoins -->
                
                <div class="flex justify-end">
                    <button 
                        type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                    >
                        Soumettre l'annonce
                    </button>
                </div>
            </form>
        </div>
    </div>
</template> 