<template>
   
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head :title="property.title" />

        <!-- Breadcrumb -->
        <div class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-4 py-3">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="/"
                                class="text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400">
                                Accueil
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="/properties"
                                    class="ml-1 text-gray-700 hover:text-indigo-600 dark:text-gray-300 dark:hover:text-indigo-400 md:ml-2">
                                    Propriétés
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-500 md:ml-2 dark:text-gray-400">{{ property.title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Contenu principal -->
        <main class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Colonne principale -->
                <div class="lg:col-span-2">
                    <!-- Galerie d'images -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
                        <div class="relative h-96">
                            <img :src="currentImage || 'https://via.placeholder.com/1200x800'" :alt="property.title"
                                class="w-full h-full object-cover" />

                            <!-- Navigation galerie -->
                            <button @click="prevImage"
                                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button @click="nextImage"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 hover:bg-opacity-75 text-white p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>

                        <!-- Miniatures -->
                        <div class="flex p-4 space-x-2 overflow-x-auto">
                            <div v-for="(image, index) in property.images" :key="index"
                                @click="currentImageIndex = index"
                                class="w-24 h-16 flex-shrink-0 cursor-pointer rounded-md overflow-hidden"
                                :class="{ 'ring-2 ring-indigo-500': currentImageIndex === index }">
                                <img :src="image" :alt="`Image ${index + 1}`" class="w-full h-full object-cover" />
                            </div>
                        </div>
                    </div>

                    <!-- Détails de la propriété -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ property.title }}
                                </h1>
                                <p class="text-xl text-gray-600 dark:text-gray-300">{{ property.location }}</p>
                            </div>
                            <div>
                                <span
                                    class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                    {{ property.status }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-6 mb-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">{{ property.surface }} m²</span>
                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">{{ property.rooms }} pièces</span>
                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">{{ property.bedrooms }} chambres</span>
                            </div>

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">{{ property.bathrooms }} salles de
                                    bain</span>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Description</h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-6 whitespace-pre-line">{{ property.description }}
                        </p>

                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Caractéristiques</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                            <div v-for="(feature, index) in property.features" :key="index" class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-indigo-600 dark:text-indigo-400 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">{{ feature }}</span>
                            </div>
                        </div>

                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Localisation</h2>
                        <div class="h-64 bg-gray-200 dark:bg-gray-700 rounded-lg mb-6">
                            <!-- Intégration de carte ici (Google Maps, Leaflet, etc.) -->
                            <div
                                class="w-full h-full flex items-center justify-center text-gray-500 dark:text-gray-400">
                                Carte de localisation
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Prix et actions -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                        <div class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mb-6">
                            {{ formatPrice(property.price) }}
                        </div>

                        <div class="space-y-3">
                            <button @click="showContactModal = true"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 px-4 rounded-md font-medium flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                Contacter un conseiller
                            </button>

                            <button @click="scheduleVisit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-md font-medium flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Planifier une visite
                            </button>

                            <button @click="toggleFavorite"
                                class="w-full border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-3 px-4 rounded-md font-medium flex items-center justify-center hover:bg-gray-50 dark:hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                                    :class="{ 'text-red-500 fill-current': isFavorite, 'text-gray-400': !isFavorite }"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                {{ isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris' }}
                            </button>
                        </div>
                    </div>

                    <!-- Informations vendeur/conseiller -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Votre conseiller dédié</h3>
                        <div class="flex items-center mb-4">
                            <img :src="property.advisor.avatar || 'https://via.placeholder.com/100'" alt="Conseiller"
                                class="w-16 h-16 rounded-full object-cover mr-4" />
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">{{ property.advisor.name }}</p>
                                <p class="text-gray-600 dark:text-gray-400">{{ property.advisor.title }}</p>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">{{ property.advisor.phone }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">{{ property.advisor.email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal de contact -->
        <div v-if="showContactModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Contacter un conseiller</h3>

                <form @submit.prevent="sendMessage">
                    <div class="mb-4">
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom</label>
                        <input type="text" id="name" v-model="contactForm.name"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                            required />
                    </div>

                    <div class="mb-4">
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                        <input type="email" id="email" v-model="contactForm.email"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                            required />
                    </div>

                    <div class="mb-4">
                        <label for="phone"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                        <input type="tel" id="phone" v-model="contactForm.phone"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                            required />
                    </div>

                    <div class="mb-6">
                        <label for="message"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message</label>
                        <textarea id="message" v-model="contactForm.message" rows="4"
                            class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                            required></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="showContactModal = false"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-md">
                            Annuler
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
import MainLayout from '@/Layouts/MainLayout.vue';

export default {
    layout: MainLayout
}
</script>
<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import SeoHead from '@/Components/SeoHead.vue';

// Propriété (à remplacer par des données réelles)
const property = ref({
    id: 1,
    title: 'Appartement lumineux avec vue dégagée',
    location: 'Paris 75016, Rue de la Pompe',
    status: 'À vendre',
    price: 450000,
    surface: 85,
    rooms: 4,
    bedrooms: 3,
    bathrooms: 2,
    description: `Magnifique appartement traversant de 85m² situé au 4ème étage d'un immeuble haussmannien avec ascenseur.

Composé d'une entrée, d'un double séjour lumineux, d'une cuisine équipée, de 3 chambres, d'une salle de bain et d'une salle d'eau.

Parquet, moulures, cheminée, hauteur sous plafond de 3m. Excellent état général.

Proche des commerces et des transports (métro ligne 9).`,
    features: [
        'Ascenseur',
        'Balcon',
        'Parquet',
        'Cheminée',
        'Double vitrage',
        'Gardien',
        'Cave',
        'Interphone'
    ],
    images: [
        'https://via.placeholder.com/1200x800',
        'https://via.placeholder.com/1200x800',
        'https://via.placeholder.com/1200x800',
        'https://via.placeholder.com/1200x800'
    ],
    advisor: {
        name: 'Sophie Martin',
        title: 'Conseillère immobilier',
        phone: '01 23 45 67 89',
        email: 'sophie.martin@example.com',
        avatar: 'https://via.placeholder.com/100'
    }
});

// Galerie d'images
const currentImageIndex = ref(0);
const currentImage = computed(() => {
    return property.value.images[currentImageIndex.value];
});

const nextImage = () => {
    if (currentImageIndex.value < property.value.images.length - 1) {
        currentImageIndex.value++;
    } else {
        currentImageIndex.value = 0;
    }
};

const prevImage = () => {
    if (currentImageIndex.value > 0) {
        currentImageIndex.value--;
    } else {
        currentImageIndex.value = property.value.images.length - 1;
    }
};

// Favoris
const isFavorite = ref(false);
const toggleFavorite = () => {
    isFavorite.value = !isFavorite.value;
    // Ici vous feriez une requête API pour ajouter/retirer des favoris
};

// Modal de contact
const showContactModal = ref(false);
const contactForm = ref({
    name: '',
    email: '',
    phone: '',
    message: `Je suis intéressé(e) par cette propriété (${property.value.title}) et je souhaiterais obtenir plus d'informations.`
});

// Envoi du message
const sendMessage = () => {
    // Ici vous feriez une requête API pour envoyer le message
    console.log('Message envoyé:', contactForm.value);

    // Réinitialiser le formulaire et fermer le modal
    contactForm.value = {
        name: '',
        email: '',
        phone: '',
        message: `Je suis intéressé(e) par cette propriété (${property.value.title}) et je souhaiterais obtenir plus d'informations.`
    };
    showContactModal.value = false;
};

// Planifier une visite
const scheduleVisit = () => {
    // Rediriger vers la page de prise de rendez-vous
    window.location.href = `/appointments/create?property=${property.value.id}`;
};

// Formatage du prix
const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price);
};

onMounted(() => {
    // Charger les détails de la propriété
    // fetchPropertyDetails();
});

defineProps({
    seo: Object
});
</script>