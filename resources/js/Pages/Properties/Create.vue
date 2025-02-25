<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Ajouter une propriété" />

        <!-- En-tête -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Ajouter une propriété</h1>
            </div>
        </header>

        <!-- Formulaire -->
        <main class="container mx-auto px-4 py-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                <form @submit.prevent="submitForm">
                    <!-- Informations générales -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Informations générales</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="title"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Titre de
                                    l'annonce *</label>
                                <input type="text" id="title" v-model="form.title"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                                <p v-if="errors.title" class="mt-1 text-sm text-red-600">{{ errors.title }}</p>
                            </div>

                            <div>
                                <label for="property_type"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de bien
                                    *</label>
                                <select id="property_type" v-model="form.property_type_id"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required>
                                    <option value="">Sélectionnez un type</option>
                                    <option v-for="type in propertyTypes" :key="type.id" :value="type.id">{{ type.name
                                        }}</option>
                                </select>
                                <p v-if="errors.property_type_id" class="mt-1 text-sm text-red-600">{{
                                    errors.property_type_id }}</p>
                            </div>

                            <div>
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prix (€)
                                    *</label>
                                <input type="number" id="price" v-model="form.price"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required min="0" step="1000" />
                                <p v-if="errors.price" class="mt-1 text-sm text-red-600">{{ errors.price }}</p>
                            </div>

                            <div>
                                <label for="surface"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Surface (m²)
                                    *</label>
                                <input type="number" id="surface" v-model="form.surface"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required min="1" />
                                <p v-if="errors.surface" class="mt-1 text-sm text-red-600">{{ errors.surface }}</p>
                            </div>

                            <div>
                                <label for="rooms"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de
                                    pièces *</label>
                                <input type="number" id="rooms" v-model="form.rooms"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required min="1" />
                                <p v-if="errors.rooms" class="mt-1 text-sm text-red-600">{{ errors.rooms }}</p>
                            </div>

                            <div>
                                <label for="bedrooms"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de
                                    chambres</label>
                                <input type="number" id="bedrooms" v-model="form.bedrooms"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    min="0" />
                                <p v-if="errors.bedrooms" class="mt-1 text-sm text-red-600">{{ errors.bedrooms }}</p>
                            </div>

                            <div>
                                <label for="bathrooms"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre de
                                    salles de bain</label>
                                <input type="number" id="bathrooms" v-model="form.bathrooms"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    min="0" />
                                <p v-if="errors.bathrooms" class="mt-1 text-sm text-red-600">{{ errors.bathrooms }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Description</h2>

                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description
                                détaillée *</label>
                            <textarea id="description" v-model="form.description" rows="6"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                            <p v-if="errors.description" class="mt-1 text-sm text-red-600">{{ errors.description }}</p>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Localisation</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="address"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adresse
                                    *</label>
                                <input type="text" id="address" v-model="form.address"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                                <p v-if="errors.address" class="mt-1 text-sm text-red-600">{{ errors.address }}</p>
                            </div>

                            <div>
                                <label for="city"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ville
                                    *</label>
                                <input type="text" id="city" v-model="form.city"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                                <p v-if="errors.city" class="mt-1 text-sm text-red-600">{{ errors.city }}</p>
                            </div>

                            <div>
                                <label for="postal_code"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Code postal
                                    *</label>
                                <input type="text" id="postal_code" v-model="form.postal_code"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                                <p v-if="errors.postal_code" class="mt-1 text-sm text-red-600">{{ errors.postal_code }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Photos -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Photos</h2>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ajouter des
                                photos</label>
                            <div class="flex items-center justify-center w-full">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-700 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold">Cliquez pour télécharger</span> ou glissez-déposez
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG ou JPEG (MAX. 5 Mo)
                                        </p>
                                    </div>
                                    <input type="file" class="hidden" multiple accept="image/*"
                                        @change="handleFileUpload" />
                                </label>
                            </div>
                            <p v-if="errors.images" class="mt-1 text-sm text-red-600">{{ errors.images }}</p>
                        </div>

                        <!-- Aperçu des images -->
                        <div v-if="imagePreviewUrls.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                            <div v-for="(url, index) in imagePreviewUrls" :key="index" class="relative">
                                <img :src="url" alt="Preview" class="w-full h-32 object-cover rounded-lg" />
                                <button type="button" @click="removeImage(index)"
                                    class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Options de publication -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Options de publication</h2>

                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="is_published" v-model="form.is_published"
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600" />
                            <label for="is_published" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                                Publier immédiatement
                            </label>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" @click="cancel"
                            class="px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-md font-medium">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-medium"
                            :disabled="processing">
                            <span v-if="processing">Traitement en cours...</span>
                            <span v-else>Enregistrer</span>
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3';

// Types de propriétés (à remplacer par des données réelles)
const propertyTypes = ref([
    { id: 1, name: 'Appartement' },
    { id: 2, name: 'Maison' },
    { id: 3, name: 'Terrain' },
    { id: 4, name: 'Local commercial' },
    { id: 5, name: 'Immeuble' }
]);

// Formulaire
const form = reactive({
    title: '',
    property_type_id: '',
    price: '',
    surface: '',
    rooms: '',
    bedrooms: '',
    bathrooms: '',
    description: '',
    address: '',
    city: '',
    postal_code: '',
    is_published: false,
    images: []
});

// Gestion des erreurs
const errors = ref({});
const processing = ref(false);

// Prévisualisation des images
const imagePreviewUrls = ref([]);

// Gestion du téléchargement de fichiers
const handleFileUpload = (event) => {
    const files = event.target.files;

    if (files.length > 0) {
        for (let i = 0; i < files.length; i++) {
            const file = files[i];

            // Vérifier la taille du fichier (5 Mo max)
            if (file.size > 5 * 1024 * 1024) {
                errors.value.images = 'Les fichiers ne doivent pas dépasser 5 Mo.';
                return;
            }

            // Ajouter le fichier au formulaire
            form.images.push(file);

            // Créer une URL pour la prévisualisation
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreviewUrls.value.push(e.target.result);
            };
            reader.readAsDataURL(file);
        }
    }
};

// Supprimer une image
const removeImage = (index) => {
    form.images.splice(index, 1);
    imagePreviewUrls.value.splice(index, 1);
};

// Soumission du formulaire
const submitForm = () => {
    processing.value = true;

    // Ici vous utiliseriez Inertia.js pour soumettre le formulaire
    // Par exemple:
    /*
    router.post('/properties', form, {
      forceFormData: true,
      onSuccess: () => {
        router.visit('/dashboard/seller/properties');
      },
      onError: (errors) => {
        errors.value = errors;
        processing.value = false;
      }
    });
    */

    // Simulation pour l'exemple
    setTimeout(() => {
        console.log('Formulaire soumis:', form);
        processing.value = false;
        router.visit('/dashboard/seller/properties');
    }, 1500);
};

// Annuler
const cancel = () => {
    router.visit('/dashboard/seller/properties');
};
</script>
