<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import SeoHead from '@/Components/SeoHead.vue';
import { computed } from 'vue';

defineProps({
    policy: String,
});

const baseUrl = computed(() => window.location.origin);
</script>

<template>

    <Head title="Privacy Policy" />
    <SeoHead title="Politique de confidentialité"
        description="Consultez notre politique de confidentialité. Découvrez comment nous collectons, utilisons et protégeons vos données personnelles chez ConseillerImmo."
        :url="`${baseUrl}/privacy-policy`" robots="noindex, follow" />

    <div class="font-sans text-gray-900 dark:text-gray-100 antialiased">
        <div class="pt-4 bg-gray-100 dark:bg-gray-900">
            <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
                <div>
                    <AuthenticationCardLogo />
                </div>

                <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg prose dark:prose-invert"
                    v-html="policy" />
            </div>
        </div>
    </div>
</template>
