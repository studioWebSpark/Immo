<template>

    <Head>
        <title>Accueil</title>
        <meta name="description"
            content="Trouvez votre propriété idéale avec ConseillerImmo, votre partenaire immobilier de confiance."
            head-key="description" />
        <meta property="og:title" content="ConseillerImmo - Votre partenaire immobilier" head-key="og:title" />
        <meta property="og:description"
            content="Trouvez votre propriété idéale avec ConseillerImmo, votre partenaire immobilier de confiance."
            head-key="og:description" />
        <meta property="og:image" content="/images/og-image.jpg" head-key="og:image" />
        <meta property="og:url" content="https://conseillerimmo.fr" head-key="og:url" />
        <link rel="canonical" href="https://conseillerimmo.fr" head-key="canonical" />
    </Head>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
            <div class="container mx-auto px-4 py-24 md:py-32">
                <div class="max-w-3xl">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Trouvez la propriété de vos rêves</h1>
                    <p class="text-xl mb-8">Un accompagnement personnalisé pour votre projet immobilier</p>

                    <!-- Search Bar -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4">
                        <div class="flex flex-col md:flex-row gap-4">
                            <input type="text" placeholder="Ville, code postal..."
                                class="flex-grow px-4 py-3 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white" />
                            <select
                                class="px-4 py-3 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                <option value="">Type de bien</option>
                                <option value="apartment">Appartement</option>
                                <option value="house">Maison</option>
                                <option value="land">Terrain</option>
                            </select>
                            <button
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md font-medium">
                                Rechercher
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Properties -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-10 text-center dark:text-white">Propriétés à la une</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Property Card (à répéter) -->
                    <div v-for="i in 3" :key="i"
                        class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg transition-transform hover:scale-105">
                        <img src="https://via.placeholder.com/300x400" alt="Property"
                            class="w-full h-48 object-cover" />
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold dark:text-white">Appartement spacieux</h3>
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    À vendre
                                </span>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">Paris 75016</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">450 000 €</span>
                                <div class="flex space-x-2 text-gray-500 dark:text-gray-400">
                                    <span>3 ch</span>
                                    <span>•</span>
                                    <span>2 sdb</span>
                                    <span>•</span>
                                    <span>85m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-10">
                    <a href="#"
                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md font-medium">
                        Voir toutes les propriétés
                    </a>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="py-16 bg-gray-100 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-10 text-center dark:text-white">Nos services</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 dark:text-white">Achat immobilier</h3>
                        <p class="text-gray-600 dark:text-gray-300">Trouvez la propriété idéale avec l'aide de nos
                            conseillers experts.</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 dark:text-white">Vente immobilière</h3>
                        <p class="text-gray-600 dark:text-gray-300">Vendez votre bien au meilleur prix avec notre
                            expertise du marché.</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 dark:text-white">Conseil personnalisé</h3>
                        <p class="text-gray-600 dark:text-gray-300">Bénéficiez d'un accompagnement sur mesure tout au
                            long de votre projet.</p>
                    </div>
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
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';

// Données pour les propriétés à la une (à remplacer par des données réelles)
const featuredProperties = ref([]);

onMounted(() => {
    // Ici vous pourriez charger les propriétés depuis une API
    // fetchFeaturedProperties();
});
</script>
