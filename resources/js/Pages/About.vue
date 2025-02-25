<template>
    <SeoHead title="À propos de nous"
        description="Découvrez ConseillerImmo, votre partenaire immobilier de confiance. Notre équipe d'experts vous accompagne dans tous vos projets immobiliers."
        image="/images/about-og.jpg" :url="`${baseUrl}/about`" />

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="À propos" />

        <!-- En-tête -->
        <header class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
            <div class="container mx-auto px-4 py-16">
                <h1 class="text-4xl font-bold mb-4">À propos de nous</h1>
                <p class="text-xl max-w-3xl">Votre partenaire de confiance pour tous vos projets immobiliers</p>
            </div>
        </header>

        <!-- Notre histoire -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">Notre histoire</h2>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Fondée en 2010, notre agence immobilière est née de la passion de ses fondateurs pour
                            l'immobilier et le service client. Nous avons commencé comme une petite équipe de 3
                            conseillers déterminés à révolutionner l'expérience immobilière en mettant l'humain au
                            centre de chaque transaction.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">
                            Au fil des années, nous avons grandi pour devenir l'une des agences les plus respectées de
                            la région, tout en conservant nos valeurs fondamentales : transparence, professionnalisme et
                            accompagnement personnalisé.
                        </p>
                        <p class="text-gray-700 dark:text-gray-300">
                            Aujourd'hui, notre équipe compte plus de 20 conseillers experts qui partagent tous la même
                            vision : vous offrir une expérience immobilière sans stress et parfaitement adaptée à vos
                            besoins.
                        </p>
                    </div>
                    <div>
                        <img src="https://via.placeholder.com/600x400" alt="Notre équipe"
                            class="rounded-lg shadow-lg w-full" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Nos valeurs -->
        <section class="py-16 bg-gray-100 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center text-gray-900 dark:text-white">Nos valeurs</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Confiance</h3>
                        <p class="text-gray-600 dark:text-gray-300">Nous bâtissons des relations durables basées sur la
                            confiance et la transparence.</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Excellence</h3>
                        <p class="text-gray-600 dark:text-gray-300">Nous visons l'excellence dans chaque aspect de notre
                            service.</p>
                    </div>

                    <div class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-4 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900 dark:text-white">Accompagnement</h3>
                        <p class="text-gray-600 dark:text-gray-300">Nous vous accompagnons à chaque étape de votre
                            projet immobilier.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Notre équipe -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center text-gray-900 dark:text-white">Notre équipe</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Membre d'équipe (à répéter) -->
                    <div v-for="i in 4" :key="i"
                        class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg text-center">
                        <img src="https://via.placeholder.com/300x300" alt="Membre de l'équipe"
                            class="w-full h-64 object-cover" />
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-1 text-gray-900 dark:text-white">Jean Dupont</h3>
                            <p class="text-indigo-600 dark:text-indigo-400 mb-4">Directeur des ventes</p>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">Plus de 15 ans d'expérience dans
                                l'immobilier de luxe.</p>
                            <div class="flex justify-center space-x-3">
                                <a href="#"
                                    class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="#"
                                    class="text-gray-500 hover:text-indigo-600 dark:text-gray-400 dark:hover:text-indigo-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Témoignages -->
        <section class="py-16 bg-gray-100 dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-12 text-center text-gray-900 dark:text-white">Ce que nos clients disent
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Témoignage (à répéter) -->
                    <div v-for="i in 3" :key="i" class="bg-white dark:bg-gray-700 p-8 rounded-lg shadow-md">
                        <div class="flex items-center mb-4">
                            <div class="text-yellow-400 flex">
                                <svg v-for="j in 5" :key="j" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            "Notre conseiller a été exceptionnel du début à la fin. Il a compris nos besoins et nous a
                            guidés vers la maison parfaite. Le processus a été simple et sans stress."
                        </p>
                        <div class="flex items-center">
                            <img src="https://via.placeholder.com/50x50" alt="Client"
                                class="w-10 h-10 rounded-full mr-3" />
                            <div>
                                <p class="font-bold text-gray-900 dark:text-white">Marie Durand</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Acheteur à Lyon</p>
                            </div>
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
import { Head } from '@inertiajs/vue3';
import SeoHead from '@/Components/SeoHead.vue';
import { computed } from 'vue';

const baseUrl = computed(() => window.location.origin);
</script>
