<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextArea from '@/Components/TextArea.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted } from 'vue';

const props = defineProps({
    categories: {
        type: Array,
        default: () => []
    },
});

const form = useForm({
    titre: '',
    description: '',
    prix: '',
    adresse: '',
    ville: '',
    code_postal: '',
    superficie: '',
    nb_pieces: '',
    nb_chambres: '',
    nb_salles_bain: '',
    categorie_id: '',
    images: [],
    image: null,
});

const submit = () => {
    form.post(route('annonces.store'), {
        forceFormData: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

const handleImagesChange = (e) => {
    form.images = Array.from(e.target.files);
};

// Vous pouvez également définir les catégories côté client si nécessaire
const categoryNames = {
    MAISON: 'Maison',
    APPARTEMENT: 'Appartement',
    TERRAIN: 'Terrain'
};

onMounted(() => {
    console.log('Catégories disponibles:', props.categories);
    
    // Si aucune catégorie n'est disponible, utiliser les catégories par défaut
    if (props.categories.length === 0) {
        console.log('Aucune catégorie disponible, utilisation des catégories par défaut');
    }
});
</script>

<template>
    <Head title="Créer une annonce" />

    <AppLayout title="Créer une annonce">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Créer une annonce
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit" class="space-y-6" enctype="multipart/form-data">
                            <div>
                                <InputLabel for="titre" value="Titre de l'annonce" />
                                <TextInput
                                    id="titre"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.titre"
                                    required
                                    autofocus
                                />
                                <InputError :message="form.errors.titre" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="description" value="Description" />
                                <textarea
                                    id="description"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    v-model="form.description"
                                    rows="5"
                                    required
                                ></textarea>
                                <InputError :message="form.errors.description" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="prix" value="Prix (€)" />
                                <TextInput
                                    id="prix"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.prix"
                                    required
                                />
                                <InputError :message="form.errors.prix" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="categorie_id" value="Catégorie" />
                                <select
                                    id="categorie_id"
                                    v-model="form.categorie_id"
                                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="" disabled selected>Sélectionnez une catégorie</option>
                                    <option v-for="category in categories" :key="category.id" :value="category.id">
                                        {{ category.nom }}
                                    </option>
                                    <option v-if="categories.length === 0" value="1">Maison</option>
                                    <option v-if="categories.length === 0" value="2">Appartement</option>
                                    <option v-if="categories.length === 0" value="3">Terrain</option>
                                </select>
                                <InputError :message="form.errors.categorie_id" class="mt-2" />
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
                                <InputError :message="form.errors.adresse" class="mt-2" />
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
                                <InputError :message="form.errors.ville" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="code_postal" value="Code postal" />
                                <TextInput
                                    id="code_postal"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.code_postal"
                                    required
                                />
                                <InputError :message="form.errors.code_postal" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="superficie" value="Superficie (m²)" />
                                <TextInput
                                    id="superficie"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.superficie"
                                    required
                                />
                                <InputError :message="form.errors.superficie" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="nb_pieces" value="Nombre de pièces" />
                                <TextInput
                                    id="nb_pieces"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.nb_pieces"
                                    required
                                />
                                <InputError :message="form.errors.nb_pieces" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="nb_chambres" value="Nombre de chambres" />
                                <TextInput
                                    id="nb_chambres"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.nb_chambres"
                                    required
                                />
                                <InputError :message="form.errors.nb_chambres" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="nb_salles_bain" value="Nombre de salles de bain" />
                                <TextInput
                                    id="nb_salles_bain"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.nb_salles_bain"
                                    required
                                />
                                <InputError :message="form.errors.nb_salles_bain" class="mt-2" />
                            </div>

                            <div>
                                <InputLabel for="image" value="Image principale" />
                                <input
                                    id="image"
                                    type="file"
                                    class="mt-1 block w-full text-gray-700 dark:text-gray-300"
                                    @input="form.image = $event.target.files[0]"
                                    required
                                />
                                <InputError :message="form.errors.image" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Créer l'annonce
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>