<template>

    <Head>
        <title>{{ title }} | {{ siteName }}</title>
        <meta name="description" :content="description" head-key="description" />
        <meta property="og:title" :content="title" head-key="og:title" />
        <meta property="og:description" :content="description" head-key="og:description" />
        <meta property="og:image" :content="image" head-key="og:image" />
        <meta property="og:url" :content="url" head-key="og:url" />
        <link rel="canonical" :href="url" head-key="canonical" />
        <meta name="twitter:card" content="summary_large_image" head-key="twitter:card" />
        <meta name="robots" :content="robots" head-key="robots" />
        <slot></slot> <!-- Pour des balises meta supplémentaires -->
    </Head>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    image: {
        type: String,
        default: '/images/og-default.jpg'
    },
    url: {
        type: String,
        default: () => window.location.href
    },
    siteName: {
        type: String,
        default: 'ConseillerImmo'
    },
    robots: {
        type: String,
        default: 'index, follow'
    }
});
</script>