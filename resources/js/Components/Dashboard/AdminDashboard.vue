<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    annonces: {
        type: Array,
        default: () => []
    },
    vendeurs: {
        type: Array,
        default: () => []
    },
    annoncesEnAttente: {
        type: Array,
        default: () => []
    }
});

const activeTab = ref('annonces'); // Options: 'annonces', 'vendeurs', 'enAttente'
</script>

<template>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
        <!-- Onglets de navigation -->
        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button 
                    @click="activeTab = 'annonces'"
                    :class="[
                        activeTab === 'annonces' 
                            ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300',
                        'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm'
                    ]"
                >
                    Toutes les annonces
                </button>
                <button 
                    @click="activeTab = 'vendeurs'"
                    :class="[
                        activeTab === 'vendeurs' 
                            ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300',
                        'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm'
                    ]"
                >
                    Vendeurs
                </button>
                <button 
                    @click="activeTab = 'enAttente'"
                    :class="[
                        activeTab === 'enAttente' 
                            ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                            : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300',
                        'whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm'
                    ]"
                >
                    Annonces en attente
                    <span v-if="annoncesEnAttente && annoncesEnAttente.length > 0" class="ml-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                        {{ annoncesEnAttente.length }}
                    </span>
                </button>
            </nav>
        </div>

        <!-- Contenu des onglets -->
        <div v-if="activeTab === 'annonces'" class="space-y-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Toutes les annonces</h3>
            
            <div v-if="!annonces || annonces.length === 0" class="text-gray-500 dark:text-gray-400">
                Aucune annonce disponible.
            </div>
            
            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="annonce in annonces" :key="annonce.id" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <h4 class="font-bold">{{ annonce.titre }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ annonce.description ? annonce.description.substring(0, 100) + '...' : '' }}</p>
                    <div class="mt-2 flex justify-between items-center">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Par: {{ annonce.vendeur ? annonce.vendeur.name : 'Inconnu' }}</span>
                        <Link :href="`/annonces/${annonce.id}`" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            Voir détails
                        </Link>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="activeTab === 'vendeurs'" class="space-y-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Liste des vendeurs</h3>
            
            <div v-if="!vendeurs || vendeurs.length === 0" class="text-gray-500 dark:text-gray-400">
                Aucun vendeur enregistré.
            </div>
            
            <div v-else class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Annonces</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <tr v-for="vendeur in vendeurs" :key="vendeur.id">
                            <td class="px-6 py-4 whitespace-nowrap">{{ vendeur.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ vendeur.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ vendeur.annonces_count || 0 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <Link :href="`/vendeurs/${vendeur.id}`" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                    Voir profil
                                </Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div v-if="activeTab === 'enAttente'" class="space-y-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Annonces en attente de validation</h3>
            
            <div v-if="!annoncesEnAttente || annoncesEnAttente.length === 0" class="text-gray-500 dark:text-gray-400">
                Aucune annonce en attente de validation.
            </div>
            
            <div v-else class="space-y-4">
                <div v-for="annonce in annoncesEnAttente" :key="annonce.id" class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow">
                    <h4 class="font-bold">{{ annonce.titre }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-300">{{ annonce.description ? annonce.description.substring(0, 100) + '...' : '' }}</p>
                    <div class="mt-2 flex justify-between items-center">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Par: {{ annonce.vendeur ? annonce.vendeur.name : 'Inconnu' }}</span>
                        <div class="flex space-x-2">
                            <Link :href="`/annonces/${annonce.id}`" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                Voir détails
                            </Link>
                            <button class="text-green-600 dark:text-green-400 hover:underline">Approuver</button>
                            <button class="text-red-600 dark:text-red-400 hover:underline">Rejeter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template> 