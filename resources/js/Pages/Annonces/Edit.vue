<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';

const props = defineProps({
    annonce: Object,
    categories: Array,
});

// Préparer les IDs des catégories déjà sélectionnées
const selectedCategoryIds = props.annonce.categories.map(category => category.id);

const form = useForm({
    titre: props.annonce.titre,
    description: props.annonce.description,
    prix: props.annonce.prix,
    adresse: props.annonce.adresse,
    ville: props.annonce.ville,
    code_postal: props.annonce.code_postal,
    category_ids: selectedCategoryIds,
    images: [],
    _method: 'PUT',
});

const existingImages = ref(props.annonce.images || []);
const previewImages = ref([]);
const imagesToDelete = ref([]);

const handleImagesChange = (e) => {
    form.images = e.target.files;
    previewImages.value = [];
    
    for (let i = 0; i < e.target.files.length; i++) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImages.value.push(e.target.result);
        };
        reader.readAsDataURL(form.images[i]);
    }
};

const removeExistingImage = (imageId) => {
    imagesToDelete.value.push(imageId);
    existingImages.value = existingImages.value.filter(img => img.id !== imageId);
};

const submit = () => {
    form.post(route('annonces.update', props.annonce.id), {
        preserveScroll: true,
        data: {
            imagesToDelete: imagesToDelete.value
        },
        onSuccess: () => {
            form.reset();
            previewImages.value = [];
            imagesToDelete.value = [];
        },
    });
};
</script>

<template>
    <Head title="Modifier l'annonce" />

    <DashboardLayout title="Modifier l'annonce">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Modifier l'annonce
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel for="titre" value="Titre" />
                                <TextInput
                                    id="titre"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.titre"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.titre" />
                            </div>

                            <div>
                                <InputLabel for="prix" value="Prix (€)" />
                                <TextInput
                                    id="prix"
                                    type="number"
                                    step="0.01"
                                    min="0"
                                    class="mt-1 block w-full"
                                    v-model="form.prix"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.prix" />
                            </div>

                            <div>
                                <InputLabel for="adresse" value="Adresse" />
                                <TextInput
                                    id="adresse"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.adresse"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.adresse" />
                            </div>

                            <div>
                                <InputLabel for="ville" value="Ville" />
                                <TextInput
                                    id="ville"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.ville"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.ville" />
                            </div>

                            <div>
                                <InputLabel for="code_postal" value="Code Postal" />
                                <TextInput
                                    id="code_postal"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.code_postal"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.code_postal" />
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <InputLabel for="description" value="Description" />
                                <TextArea
                                    id="description"
                                    class="mt-1 block w-full"
                                    v-model="form.description"
                                    rows="6"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>

                            <div class="col-span-1 md:col-span-2">
                                <InputLabel for="images" value="Ajouter des images (max 5)" />
                                <input
                                    id="images"
                                    type="file"
                                    class="mt-1 block w-full text-gray-700 dark:text-gray-300"
                                    @change="handleImagesChange"
                                    multiple
                                    accept="image/*"
                                />
                                <InputError class="mt-2" :message="form.errors.images" />
                                
                                <div v-if="previewImages.length > 0" class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nouvelles images à ajouter:</h4>
                                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                        <div v-for="(image, index) in previewImages" :key="index" class="relative">
                                            <img :src="image" class="w-full h-32 object-cover rounded-md" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div v-if="existingImages.length > 0" class="mt-4">
                                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Images existantes:</h4>
                                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                        <div v-for="image in existingImages" :key="image.id" class="relative">
                                            <img :src="`/storage/${image.chemin}`" class="w-full h-32 object-cover rounded-md" />
                                            <button 
                                                type="button" 
                                                @click="removeExistingImage(image.id)" 
                                                class="absolute top-1 right-1 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Mettre à jour l'annonce
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
