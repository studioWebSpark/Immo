<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Modifier mon profil" />

        <!-- En-tête -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Mon profil</h1>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="container mx-auto px-4 py-8">
            <div class="max-w-3xl mx-auto">
                <!-- Informations personnelles -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                    <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Informations personnelles</h2>

                    <form @submit.prevent="updateProfile">
                        <div class="mb-6">
                            <div class="flex items-center mb-4">
                                <div class="mr-4">
                                    <img :src="form.avatar || 'https://via.placeholder.com/100'" alt="Avatar"
                                        class="w-20 h-20 rounded-full object-cover" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Photo
                                        de profil</label>
                                    <input type="file" @change="handleAvatarUpload" accept="image/*" class="block w-full text-sm text-gray-500 dark:text-gray-400
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-md file:border-0
                      file:text-sm file:font-medium
                      file:bg-indigo-50 file:text-indigo-700
                      dark:file:bg-indigo-900 dark:file:text-indigo-300
                      hover:file:bg-indigo-100 dark:hover:file:bg-indigo-800
                    " />
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nom complet
                                    *</label>
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
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Téléphone</label>
                                <input type="tel" id="phone" v-model="form.phone"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white" />
                            </div>

                            <div>
                                <label for="address"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adresse</label>
                                <input type="text" id="address" v-model="form.address"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white" />
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="bio"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Biographie</label>
                            <textarea id="bio" v-model="form.bio" rows="4"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md"
                                :disabled="processing">
                                <span v-if="processing">Enregistrement...</span>
                                <span v-else>Enregistrer les modifications</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Changer le mot de passe -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                    <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Changer le mot de passe</h2>

                    <form @submit.prevent="updatePassword">
                        <div class="mb-6">
                            <label for="current_password"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mot de passe
                                actuel *</label>
                            <input type="password" id="current_password" v-model="passwordForm.current_password"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="new_password"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nouveau mot
                                    de passe *</label>
                                <input type="password" id="new_password" v-model="passwordForm.new_password"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>

                            <div>
                                <label for="new_password_confirmation"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Confirmer le
                                    nouveau mot de passe *</label>
                                <input type="password" id="new_password_confirmation"
                                    v-model="passwordForm.new_password_confirmation"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md"
                                :disabled="passwordProcessing">
                                <span v-if="passwordProcessing">Mise à jour...</span>
                                <span v-else>Mettre à jour le mot de passe</span>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Préférences de notification -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Préférences de notification</h2>

                    <form @submit.prevent="updateNotifications">
                        <div class="space-y-4 mb-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="email_notifications"
                                        v-model="notificationForm.email_notifications"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="email_notifications"
                                        class="font-medium text-gray-700 dark:text-gray-300">Notifications par
                                        email</label>
                                    <p class="text-gray-500 dark:text-gray-400">Recevoir des emails concernant vos
                                        activités, rendez-vous et messages.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="sms_notifications"
                                        v-model="notificationForm.sms_notifications"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="sms_notifications"
                                        class="font-medium text-gray-700 dark:text-gray-300">Notifications par
                                        SMS</label>
                                    <p class="text-gray-500 dark:text-gray-400">Recevoir des SMS pour les rappels de
                                        rendez-vous et les messages urgents.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="property_alerts"
                                        v-model="notificationForm.property_alerts"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="property_alerts"
                                        class="font-medium text-gray-700 dark:text-gray-300">Alertes de
                                        propriétés</label>
                                    <p class="text-gray-500 dark:text-gray-400">Recevoir des notifications lorsque de
                                        nouvelles propriétés correspondant à vos critères sont disponibles.</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="marketing_emails"
                                        v-model="notificationForm.marketing_emails"
                                        class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600" />
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="marketing_emails"
                                        class="font-medium text-gray-700 dark:text-gray-300">Emails marketing</label>
                                    <p class="text-gray-500 dark:text-gray-400">Recevoir des emails concernant nos
                                        offres spéciales, événements et actualités.</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md"
                                :disabled="notificationProcessing">
                                <span v-if="notificationProcessing">Enregistrement...</span>
                                <span v-else>Enregistrer les préférences</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';

// Formulaire du profil
const form = reactive({
    name: 'Jean Dupont',
    email: 'jean.dupont@example.com',
    phone: '06 12 34 56 78',
    address: '123 rue de Paris, 75001 Paris',
    bio: 'Passionné d\'immobilier et à la recherche de ma résidence principale dans le sud de la France.',
    avatar: null
});

const processing = ref(false);

// Formulaire de mot de passe
const passwordForm = reactive({
    current_password: '',
    new_password: '',
    new_password_confirmation: ''
});

const passwordProcessing = ref(false);

// Formulaire de notifications
const notificationForm = reactive({
    email_notifications: true,
    sms_notifications: false,
    property_alerts: true,
    marketing_emails: false
});

const notificationProcessing = ref(false);

// Gérer l'upload d'avatar
const handleAvatarUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            form.avatar = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

// Mettre à jour le profil
const updateProfile = () => {
    processing.value = true;

    // Ici vous feriez une requête API pour mettre à jour le profil
    setTimeout(() => {
        console.log('Profil mis à jour:', form);
        processing.value = false;

        // Afficher un message de succès
        alert('Profil mis à jour avec succès !');
    }, 1500);
};

// Mettre à jour le mot de passe
const updatePassword = () => {
    passwordProcessing.value = true;

    // Vérifier que les mots de passe correspondent
    if (passwordForm.new_password !== passwordForm.new_password_confirmation) {
        alert('Les mots de passe ne correspondent pas.');
        passwordProcessing.value = false;
        return;
    }

    // Ici vous feriez une requête API pour mettre à jour le mot de passe
    setTimeout(() => {
        console.log('Mot de passe mis à jour');

        // Réinitialiser le formulaire
        passwordForm.current_password = '';
        passwordForm.new_password = '';
        passwordForm.new_password_confirmation = '';

        passwordProcessing.value = false;

        // Afficher un message de succès
        alert('Mot de passe mis à jour avec succès !');
    }, 1500);
};

// Mettre à jour les préférences de notification
const updateNotifications = () => {
    notificationProcessing.value = true;

    // Ici vous feriez une requête API pour mettre à jour les préférences
    setTimeout(() => {
        console.log('Préférences de notification mises à jour:', notificationForm);
        notificationProcessing.value = false;

        // Afficher un message de succès
        alert('Préférences de notification mises à jour avec succès !');
    }, 1500);
};
</script>