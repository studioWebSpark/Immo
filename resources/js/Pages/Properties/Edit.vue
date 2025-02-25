<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Modifier la propriété" />

        <!-- En-tête -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-4 py-6">
                <div class="flex items-center">
                    <button @click="router.visit('/properties')"
                        class="mr-4 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </button>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Modifier la propriété</h1>
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <form @submit.prevent="updateProperty">
                    <!-- Informations générales -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Informations générales</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="title"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Titre
                                    *</label>
                                <input type="text" id="title" v-model="form.title"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>

                            <div>
                                <label for="type"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Type de bien
                                    *</label>
                                <select id="type" v-model="form.type"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required>
                                    <option value="">Sélectionner un type</option>
                                    <option value="apartment">Appartement</option>
                                    <option value="house">Maison</option>
                                    <option value="villa">Villa</option>
                                    <option value="land">Terrain</option>
                                    <option value="commercial">Local commercial</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                            <div>
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prix
                                    *</label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 dark:text-gray-400">€</span>
                                    <input type="number" id="price" v-model="form.price"
                                        class="w-full pl-8 px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                        min="0" required />
                                </div>
                            </div>

                            <div>
                                <label for="area"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Surface (m²)
                                    *</label>
                                <div class="relative">
                                    <input type="number" id="area" v-model="form.area"
                                        class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                        min="0" required />
                                    <span
                                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 dark:text-gray-400">m²</span>
                                </div>
                            </div>

                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Statut
                                    *</label>
                                <select id="status" v-model="form.status"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required>
                                    <option value="active">À vendre</option>
                                    <option value="pending">En attente</option>
                                    <option value="sold">Vendu</option>
                                    <option value="inactive">Inactif</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description
                                *</label>
                            <textarea id="description" v-model="form.description" rows="5"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="bedrooms"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Chambres</label>
                                <input type="number" id="bedrooms" v-model="form.bedrooms"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    min="0" />
                            </div>

                            <div>
                                <label for="bathrooms"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Salles de
                                    bain</label>
                                <input type="number" id="bathrooms" v-model="form.bathrooms"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    min="0" />
                            </div>
                        </div>
                    </div>

                    <!-- Localisation -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Localisation</h2>

                        <div class="mb-6">
                            <label for="address"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Adresse complète
                                *</label>
                            <input type="text" id="address" v-model="form.address"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="city"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ville
                                    *</label>
                                <input type="text" id="city" v-model="form.city"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>

                            <div>
                                <label for="postal_code"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Code postal
                                    *</label>
                                <input type="text" id="postal_code" v-model="form.postal_code"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>

                            <div>
                                <label for="country"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pays
                                    *</label>
                                <input type="text" id="country" v-model="form.country"
                                    class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                    required />
                            </div>
                        </div>
                    </div>

                    <!-- Caractéristiques -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Caractéristiques</h2>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                            <div class="flex items-center">
                                <input type="checkbox" id="has_garage" v-model="form.features.has_garage"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_garage" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Garage
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="has_garden" v-model="form.features.has_garden"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_garden" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Jardin
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="has_pool" v-model="form.features.has_pool"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_pool" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Piscine
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="has_balcony" v-model="form.features.has_balcony"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_balcony" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Balcon
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="has_elevator" v-model="form.features.has_elevator"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_elevator" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Ascenseur
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="is_furnished" v-model="form.features.is_furnished"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="is_furnished" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Meublé
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="has_air_conditioning"
                                    v-model="form.features.has_air_conditioning"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_air_conditioning"
                                    class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Climatisation
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="has_heating" v-model="form.features.has_heating"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_heating" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Chauffage
                                </label>
                            </div>

                            <div class="flex items-center">
                                <input type="checkbox" id="has_security_system"
                                    v-model="form.features.has_security_system"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                <label for="has_security_system"
                                    class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                    Système de sécurité
                                </label>
                            </div>
                        </div>

                        <div>
                            <label for="energy_class"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Classe
                                énergétique</label>
                            <select id="energy_class" v-model="form.energy_class"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                <option value="">Non spécifiée</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                                <option value="F">F</option>
                                <option value="G">G</option>
                            </select>
                        </div>
                    </div>

                    <!-- Photos -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Photos</h2>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Photos
                                actuelles</label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                <div v-for="(photo, index) in form.photos" :key="index" class="relative">
                                    <img :src="photo.url" :alt="`Photo ${index + 1}`"
                                        class="h-32 w-full object-cover rounded-md" />
                                    <button type="button" @click="removePhoto(index)"
                                        class="absolute top-2 right-2 bg-red-600 text-white rounded-full p-1 hover:bg-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="setMainPhoto(index)"
                                        class="absolute bottom-2 right-2 bg-indigo-600 text-white rounded-full p-1 hover:bg-indigo-700"
                                        :class="{ 'bg-green-600 hover:bg-green-700': photo.is_main }">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ajouter des
                                photos</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-700 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="file-upload"
                                            class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none">
                                            <span>Télécharger des fichiers</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only"
                                                multiple @change="handleFileUpload" accept="image/*" />
                                        </label>
                                        <p class="pl-1">ou glisser-déposer</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PNG, JPG, GIF jusqu'à 10MB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vendeur -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-8">
                        <h2 class="text-xl font-bold mb-6 text-gray-900 dark:text-white">Vendeur</h2>

                        <div class="mb-6">
                            <label for="seller"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Vendeur
                                *</label>
                            <select id="seller" v-model="form.seller_id"
                                class="w-full px-4 py-2 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                required>
                                <option value="">Sélectionner un vendeur</option>
                                <option v-for="seller in sellers" :key="seller.id" :value="seller.id">
                                    {{ seller.name }}
                                </option>
                            </select>
                        </div>

                        <div v-if="form.seller_id">
                            <div class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <img :src="getSellerById(form.seller_id).avatar"
                                    :alt="getSellerById(form.seller_id).name" class="w-12 h-12 rounded-full mr-4" />
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{
                                        getSellerById(form.seller_id).name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{
                                        getSellerById(form.seller_id).email }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{
                                        getSellerById(form.seller_id).phone }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex justify-between">
                        <button type="button" @click="router.visit('/properties')"
                            class="px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-md">
                            Annuler
                        </button>

                        <div class="flex space-x-4">
                            <button type="button" @click="confirmDeleteProperty"
                                class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-md">
                                Supprimer
                            </button>

                            <button type="submit"
                                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md"
                                :disabled="processing">
                                <span v-if="processing">Enregistrement...</span>
                                <span v-else>Enregistrer les modifications</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </main>

        <!-- Modal de confirmation de suppression -->
        <div v-if="showDeleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Confirmer la suppression</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-6">
                    Êtes-vous sûr de vouloir supprimer cette propriété ? Cette action est irréversible.
                </p>
                <div class="flex justify-end space-x-4">
                    <button @click="showDeleteModal = false"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-md">
                        Annuler
                    </button>
                    <button @click="deleteProperty" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';

// Propriétés
const props = defineProps({
    property: {
        type: Object,
        required: true
    },
    sellers: {
        type: Array,
        default: () => []
    }
});

// État
const form = ref({
    title: props.property.title,
    type: props.property.type,
    price: props.property.price,
    area: props.property.area,
    status: props.property.status,
    description: props.property.description,
    bedrooms: props.property.bedrooms,
    bathrooms: props.property.bathrooms,
    address: props.property.address,
    city: props.property.city,
    postal_code: props.property.postal_code,
    country: props.property.country,
    energy_class: props.property.energy_class,
    features: {
        has_garage: props.property.features?.has_garage || false,
        has_garden: props.property.features?.has_garden || false,
        has_pool: props.property.features?.has_pool || false,
        has_balcony: props.property.features?.has_balcony || false,
        has_elevator: props.property.features?.has_elevator || false,
        is_furnished: props.property.features?.is_furnished || false,
        has_air_conditioning: props.property.features?.has_air_conditioning || false,
        has_heating: props.property.features?.has_heating || false,
        has_security_system: props.property.features?.has_security_system || false
    },
    photos: props.property.photos || [],
    seller_id: props.property.seller_id
});

const processing = ref(false);
const showDeleteModal = ref(false);

// Obtenir un vendeur par son ID
const getSellerById = (id) => {
    return props.sellers.find(seller => seller.id === id) || {};
};

// Gérer le téléchargement de fichiers
const handleFileUpload = (event) => {
    const files = event.target.files;

    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();

        reader.onload = (e) => {
            form.value.photos.push({
                id: Date.now() + i, // ID temporaire
                url: e.target.result,
                is_main: form.value.photos.length === 0, // La première photo est la principale par défaut
                file: file // Conserver le fichier pour l'envoi au serveur
            });
        };

        reader.readAsDataURL(file);
    }

    // Réinitialiser l'input file
    event.target.value = '';
};

// Supprimer une photo
const removePhoto = (index) => {
    const removedPhoto = form.value.photos.splice(index, 1)[0];

    // Si la photo supprimée était la principale, définir la première photo restante comme principale
    if (removedPhoto.is_main && form.value.photos.length > 0) {
        form.value.photos[0].is_main = true;
    }
};

// Définir une photo comme principale
const setMainPhoto = (index) => {
    form.value.photos.forEach((photo, i) => {
        photo.is_main = i === index;
    });
};

// Confirmer la suppression de la propriété
const confirmDeleteProperty = () => {
    showDeleteModal.value = true;
};

// Supprimer la propriété
const deleteProperty = () => {
    router.delete(`/properties/${props.property.id}`, {
        onSuccess: () => {
            // Redirection vers la liste des propriétés
            router.visit('/properties');
        }
    });
};

// Mettre à jour la propriété
const updateProperty = () => {
    processing.value = true;

    // Ici, vous feriez une requête API pour mettre à jour la propriété
    // Simulons une requête avec un délai
    setTimeout(() => {
        console.log('Propriété mise à jour:', form.value);
        processing.value = false;

        // Redirection vers la page de détail de la propriété
        router.visit(`/properties/${props.property.id}`);
    }, 1500);
};
</script>