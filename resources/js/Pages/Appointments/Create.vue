<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Prendre rendez-vous" />

        <!-- En-tête -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Prendre rendez-vous</h1>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="container mx-auto px-4 py-8">
            <div class="max-w-3xl mx-auto">
                <!-- Informations sur la propriété -->
                <div v-if="property" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3 mb-4 md:mb-0 md:mr-6">
                            <img :src="property.image" :alt="property.title" class="w-full h-auto rounded-lg" />
                        </div>
                        <div class="md:w-2/3">
                            <h2 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">{{ property.title }}</h2>
                            <p class="text-gray-600 dark:text-gray-300 mb-2">{{ property.location }}</p>
                            <p class="text-indigo-600 dark:text-indigo-400 font-bold text-lg mb-4">{{
                                formatPrice(property.price) }}</p>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-600 dark:text-gray-300">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    {{ property.rooms }} pièces
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    {{ property.bedrooms }} chambres
                                </div>
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                                    </svg>
                                    {{ property.surface }} m²
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire de rendez-vous -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Planifier une visite</h2>

                    <form @submit.prevent="submitForm">
                        <!-- Type de rendez-vous -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type de
                                visite</label>
                            <div class="flex flex-col md:flex-row gap-4">
                                <label class="inline-flex items-center">
                                    <input type="radio" v-model="form.visitType" value="in_person"
                                        class="form-radio h-5 w-5 text-indigo-600 dark:text-indigo-400" />
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Visite en personne</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" v-model="form.visitType" value="virtual"
                                        class="form-radio h-5 w-5 text-indigo-600 dark:text-indigo-400" />
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Visite virtuelle</span>
                                </label>
                            </div>
                        </div>

                        <!-- Date et heure -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="date"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date
                                    souhaitée *</label>
                                <input type="date" id="date" v-model="form.date"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required :min="minDate" />
                            </div>

                            <div>
                                <label for="time"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Heure
                                    souhaitée *</label>
                                <select id="time" v-model="form.time"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required>
                                    <option value="">Sélectionnez une heure</option>
                                    <option v-for="time in availableTimes" :key="time" :value="time">{{ time }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- Dates alternatives -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Dates
                                alternatives (optionnel)</label>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Si vous avez d'autres
                                disponibilités, veuillez les indiquer ci-dessous.</p>

                            <div v-for="(date, index) in form.alternativeDates" :key="index"
                                class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-2">
                                <input type="date" v-model="form.alternativeDates[index].date"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    :min="minDate" />
                                <div class="flex">
                                    <select v-model="form.alternativeDates[index].time"
                                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                        <option value="">Sélectionnez une heure</option>
                                        <option v-for="time in availableTimes" :key="time" :value="time">{{ time }}
                                        </option>
                                    </select>
                                    <button type="button" @click="removeAlternativeDate(index)"
                                        class="ml-2 p-2 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <button type="button" @click="addAlternativeDate"
                                class="mt-2 text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Ajouter une date alternative
                            </button>
                        </div>

                        <!-- Informations personnelles -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium mb-4 text-gray-900 dark:text-white">Vos informations</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom
                                        complet *</label>
                                    <input type="text" id="name" v-model="form.name"
                                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                        required />
                                </div>

                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email
                                        *</label>
                                    <input type="email" id="email" v-model="form.email"
                                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                        required />
                                </div>

                                <div>
                                    <label for="phone"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone
                                        *</label>
                                    <input type="tel" id="phone" v-model="form.phone"
                                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                        required />
                                </div>
                            </div>
                        </div>

                        <!-- Message -->
                        <div class="mb-6">
                            <label for="message"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message
                                (optionnel)</label>
                            <textarea id="message" v-model="form.message" rows="4"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                placeholder="Questions ou informations supplémentaires..."></textarea>
                        </div>

                        <!-- Consentement -->
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" v-model="form.consent"
                                    class="form-checkbox h-5 w-5 text-indigo-600 dark:text-indigo-400" required />
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    J'accepte que mes données soient traitées conformément à la politique de
                                    confidentialité *
                                </span>
                            </label>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex justify-end space-x-4">
                            <button type="button" @click="cancel"
                                class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Annuler
                            </button>
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md"
                                :disabled="processing">
                                <span v-if="processing">Traitement en cours...</span>
                                <span v-else>Confirmer le rendez-vous</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, reactive, computed, onMounted } from 'vue';
import { Head, router } from '@inertiajs/vue3';

// Propriété (à remplacer par des données réelles)
const property = ref({
    id: 1,
    title: 'Appartement lumineux',
    location: 'Paris 75016',
    price: 450000,
    rooms: 3,
    bedrooms: 2,
    surface: 75,
    image: 'https://via.placeholder.com/600x400'
});

// Formulaire de rendez-vous
const form = reactive({
    propertyId: property.value?.id,
    visitType: 'in_person',
    date: '',
    time: '',
    alternativeDates: [],
    name: '',
    email: '',
    phone: '',
    message: '',
    consent: false
});

const processing = ref(false);

// Date minimale (aujourd'hui + 1 jour)
const minDate = computed(() => {
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    return tomorrow.toISOString().split('T')[0];
});

// Heures disponibles
const availableTimes = [
    '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
    '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'
];

// Ajouter une date alternative
const addAlternativeDate = () => {
    form.alternativeDates.push({ date: '', time: '' });
};

// Supprimer une date alternative
const removeAlternativeDate = (index) => {
    form.alternativeDates.splice(index, 1);
};

// Soumission du formulaire
const submitForm = () => {
    processing.value = true;

    // Ici vous feriez une requête API pour enregistrer le rendez-vous
    setTimeout(() => {
        console.log('Rendez-vous soumis:', form);

        // Redirection vers la page de confirmation
        router.visit('/appointments/confirmation');

        processing.value = false;
    }, 1500);
};

// Annuler
const cancel = () => {
    router.visit(`/properties/${property.value.id}`);
};

// Formatage du prix
const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'EUR' }).format(price);
};

onMounted(() => {
    // Récupérer l'ID de la propriété depuis l'URL
    const urlParams = new URLSearchParams(window.location.search);
    const propertyId = urlParams.get('property');

    if (propertyId) {
        // Charger les détails de la propriété
        // fetchPropertyDetails(propertyId);
        form.propertyId = propertyId;
    }
});
</script>