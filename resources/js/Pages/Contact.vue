<template>
    <SeoHead
        title="Contactez-nous"
        description="Besoin d'aide pour votre projet immobilier ? Contactez notre équipe de conseillers immobiliers experts. Nous sommes là pour vous aider."
        image="/images/contact-og.jpg"
        :url="`${baseUrl}/contact`"
    >
        
    </SeoHead>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Contact" />

        <!-- En-tête -->
        <header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
            <div class="container mx-auto px-4 py-16">
                <h1 class="text-4xl font-bold mb-4">Contactez-nous</h1>
                <p class="text-xl max-w-3xl">Nous sommes là pour répondre à toutes vos questions</p>
            </div>
        </header>

        <!-- Contenu principal -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <!-- Formulaire de contact -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Envoyez-nous un message</h2>

                        <form @submit.prevent="submitForm">
                            <div class="mb-6">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom complet
                                    *</label>
                                <input type="text" id="name" v-model="form.name"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>

                            <div class="mb-6">
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email
                                    *</label>
                                <input type="email" id="email" v-model="form.email"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>

                            <div class="mb-6">
                                <label for="phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                                <input type="tel" id="phone" v-model="form.phone"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white" />
                            </div>

                            <div class="mb-6">
                                <label for="subject"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sujet
                                    *</label>
                                <select id="subject" v-model="form.subject"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required>
                                    <option value="">Sélectionnez un sujet</option>
                                    <option value="achat">Achat immobilier</option>
                                    <option value="vente">Vente immobilière</option>
                                    <option value="location">Location</option>
                                    <option value="conseil">Conseil immobilier</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="message"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Message
                                    *</label>
                                <textarea id="message" v-model="form.message" rows="5"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required></textarea>
                            </div>

                            <div class="flex items-center mb-6">
                                <input type="checkbox" id="privacy" v-model="form.privacy"
                                    class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600"
                                    required />
                                <label for="privacy" class="ml-2 text-sm text-gray-700 dark:text-gray-300">
                                    J'accepte que mes données soient traitées conformément à la politique de
                                    confidentialité
                                </label>
                            </div>

                            <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md font-medium"
                                :disabled="processing">
                                <span v-if="processing">Envoi en cours...</span>
                                <span v-else>Envoyer le message</span>
                            </button>
                        </form>

                        <!-- Message de succès -->
                        <div v-if="success" class="mt-6 p-4 bg-green-100 text-green-800 rounded-md">
                            Votre message a été envoyé avec succès. Nous vous répondrons dans les plus brefs délais.
                        </div>
                    </div>

                    <!-- Informations de contact -->
                    <div>
                        <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">Nos coordonnées</h2>

                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                            <div class="flex items-start mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-indigo-600 dark:text-indigo-400 mr-3 mt-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Adresse</h3>
                                    <p class="text-gray-600 dark:text-gray-300">123 Avenue des Champs-Élysées<br>75008
                                        Paris, France</p>
                                </div>
                            </div>

                            <div class="flex items-start mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-indigo-600 dark:text-indigo-400 mr-3 mt-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Téléphone</h3>
                                    <p class="text-gray-600 dark:text-gray-300">+33 1 23 45 67 89</p>
                                </div>
                            </div>

                            <div class="flex items-start mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-indigo-600 dark:text-indigo-400 mr-3 mt-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Email</h3>
                                    <p class="text-gray-600 dark:text-gray-300">contact@conseillerimmo.fr</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 text-indigo-600 dark:text-indigo-400 mr-3 mt-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <h3 class="font-bold text-gray-900 dark:text-white mb-1">Horaires d'ouverture</h3>
                                    <p class="text-gray-600 dark:text-gray-300">
                                        Lundi - Vendredi: 9h00 - 19h00<br>
                                        Samedi: 10h00 - 17h00<br>
                                        Dimanche: Fermé
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Carte -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 h-80">
                            <!-- Intégrer ici une carte Google Maps ou autre -->
                            <div
                                class="w-full h-full bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                <p class="text-gray-500 dark:text-gray-400">Carte Google Maps</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="py-16 bg-gray-100 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center text-gray-900 dark:text-white">Questions fréquentes</h2>

                <div class="max-w-3xl mx-auto">
                    <div v-for="(faq, index) in faqs" :key="index" class="mb-6">
                        <button @click="toggleFaq(index)"
                            class="flex justify-between items-center w-full p-5 bg-white dark:bg-gray-700 rounded-lg shadow text-left">
                            <span class="text-lg font-medium text-gray-900 dark:text-white">{{ faq.question }}</span>
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400 transform transition-transform duration-200"
                                :class="{ 'rotate-180': faq.open }" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div v-show="faq.open" class="mt-2 p-5 bg-white dark:bg-gray-700 rounded-lg shadow">
                            <p class="text-gray-600 dark:text-gray-300">{{ faq.answer }}</p>
                        </div>
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
import { ref, reactive } from 'vue';
import { Head } from '@inertiajs/vue3';
import SeoHead from '@/Components/SeoHead.vue';
import { computed } from 'vue';

// Formulaire de contact
const form = reactive({
    name: '',
    email: '',
    phone: '',
    subject: '',
    message: '',
    privacy: false
});

const processing = ref(false);
const success = ref(false);

// Soumission du formulaire
const submitForm = () => {
    processing.value = true;

    // Ici vous feriez une requête API pour envoyer le message
    setTimeout(() => {
        console.log('Formulaire soumis:', form);

        // Réinitialiser le formulaire
        form.name = '';
        form.email = '';
        form.phone = '';
        form.subject = '';
        form.message = '';
        form.privacy = false;

        // Afficher le message de succès
        success.value = true;
        processing.value = false;

        // Masquer le message après 5 secondes
        setTimeout(() => {
            success.value = false;
        }, 5000);
    }, 1500);
};

// FAQ
const faqs = reactive([
    {
        question: "Comment fonctionne le processus d'achat immobilier ?",
        answer: "Le processus d'achat immobilier comprend plusieurs étapes : définition de votre projet, recherche de biens, visites, offre d'achat, compromis de vente, obtention de financement, et enfin signature chez le notaire. Nos conseillers vous accompagnent à chaque étape.",
        open: false
    },
    {
        question: "Quels sont les frais à prévoir lors d'un achat immobilier ?",
        answer: "Lors d'un achat immobilier, vous devez prévoir le prix du bien, les frais de notaire (généralement 7-8% pour l'ancien, 2-3% pour le neuf), les frais d'agence, les frais de dossier bancaire, et éventuellement des frais de garantie hypothécaire.",
        open: false
    },
    {
        question: "Comment estimer la valeur de mon bien immobilier ?",
        answer: "L'estimation de votre bien prend en compte plusieurs facteurs : la localisation, la surface, le nombre de pièces, l'état général, les prestations, l'orientation, l'étage, etc. Nos experts réalisent une estimation précise basée sur leur connaissance du marché local et des transactions récentes.",
        open: false
    },
    {
        question: "Combien de temps dure généralement une vente immobilière ?",
        answer: "La durée d'une vente immobilière varie selon plusieurs facteurs, mais en moyenne, comptez 3 à 4 mois entre la mise en vente et la signature définitive chez le notaire. Ce délai inclut la période de recherche d'acquéreur, le délai de rétractation, et les démarches administratives.",
        open: false
    },
    {
        question: "Quels sont vos honoraires d'agence ?",
        answer: "Nos honoraires varient selon le type de bien et la prestation choisie. Ils sont généralement compris entre 4% et 6% du prix de vente pour une transaction classique. Nous vous proposons un devis personnalisé lors de notre première rencontre.",
        open: false
    }
]);

// Ouvrir/fermer une FAQ
const toggleFaq = (index) => {
    faqs[index].open = !faqs[index].open;
};

const baseUrl = computed(() => window.location.origin);
</script>