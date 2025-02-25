<template>
    <SeoHead title="Propriétés à vendre et à louer"
        description="Découvrez notre sélection de propriétés à vendre et à louer dans toute la France. Appartements, maisons, villas et terrains disponibles."
        image="/images/properties-og.jpg" :url="`${baseUrl}/properties`" />

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Propriétés" />

        <!-- Filtres de recherche -->
        <section class="bg-white dark:bg-gray-800 shadow-md">
            <div class="container mx-auto px-4 py-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Localisation</label>
                        <input type="text" v-model="filters.location" placeholder="Ville, code postal..."
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de
                            bien</label>
                        <select v-model="filters.type"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            <option value="">Tous les types</option>
                            <option value="apartment">Appartement</option>
                            <option value="house">Maison</option>
                            <option value="land">Terrain</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Budget
                            max</label>
                        <select v-model="filters.maxPrice"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            <option value="">Sans limite</option>
                            <option value="100000">100 000 €</option>
                            <option value="200000">200 000 €</option>
                            <option value="300000">300 000 €</option>
                            <option value="500000">500 000 €</option>
                            <option value="1000000">1 000 000 €</option>
                        </select>
                    </div>

                    <div class="flex items-end">
                        <button @click="applyFilters"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium">
                            Filtrer
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Liste des propriétés -->
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold dark:text-white">Propriétés disponibles</h1>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-600 dark:text-gray-300">Trier par:</span>
                        <select v-model="sortBy"
                            class="px-3 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                            <option value="newest">Plus récentes</option>
                            <option value="price_asc">Prix croissant</option>
                            <option value="price_desc">Prix décroissant</option>
                            <option value="surface_desc">Surface décroissante</option>
                        </select>
                    </div>
                </div>

                <!-- Grille de propriétés -->
                <div v-if="properties.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="property in properties" :key="property.id"
                        class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform hover:scale-105">
                        <img :src="property.image || 'https://via.placeholder.com/600x400'" :alt="property.title"
                            class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold dark:text-white">{{ property.title }}</h3>
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    {{ property.status }}
                                </span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ property.location }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{
                                    formatPrice(property.price) }}</span>
                                <div class="flex space-x-2 text-gray-500 dark:text-gray-400">
                                    <span>{{ property.bedrooms }} ch</span>
                                    <span>•</span>
                                    <span>{{ property.bathrooms }} sdb</span>
                                    <span>•</span>
                                    <span>{{ property.surface }}m²</span>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a :href="`/properties/${property.id}`"
                                    class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md font-medium">
                                    Voir le détail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Message si aucune propriété -->
                <div v-else class="text-center py-12">
                    <p class="text-xl text-gray-600 dark:text-gray-300">Aucune propriété ne correspond à vos critères.
                    </p>
                    <button @click="resetFilters"
                        class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-medium">
                        Réinitialiser les filtres
                    </button>
                </div>

                <!-- Pagination -->
                <div class="mt-12 flex justify-center">
                    <!-- Pagination component -->
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    layout: MainLayout
}
</script>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import SeoHead from '@/Components/SeoHead.vue';

// Filtres de recherche
const filters = reactive({
    location: '',
    type: '',
    maxPrice: '',
});

// Tri
const sortBy = ref('newest');

// Propriétés (à remplacer par des données réelles)
const properties = ref([
    {
        id: 1,
        title: 'Appartement lumineux',
        status: 'À vendre',
        location: 'Paris 75016',
        price: 450000,
        bedrooms: 3,
        bathrooms: 2,
        surface: 85,
        image: 'https://via.placeholder.com/600x400'
    },
    {
        id: 2,
        title: 'Maison avec jardin',
        status: 'À vendre',
        location: 'Lyon 69006',
        price: 650000,
        bedrooms: 4,
        bathrooms: 3,
        surface: 120,
        image: 'https://via.placeholder.com/600x400'
    },
    // Ajoutez d'autres propriétés...
]);

// Formatage du prix
const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price);
};

// Appliquer les filtres
const applyFilters = () => {
    // Ici vous feriez une requête API avec les filtres
    console.log('Filtres appliqués:', filters);
};

// Réinitialiser les filtres
const resetFilters = () => {
    filters.location = '';
    filters.type = '';
    filters.maxPrice = '';
    applyFilters();
};

onMounted(() => {
    // Charger les propriétés initiales
    // fetchProperties();
});

const baseUrl = window.location.origin;
</script>
