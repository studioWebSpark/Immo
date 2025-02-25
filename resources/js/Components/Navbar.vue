<template>
    <nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="container mx-auto px-4">
            <div class="flex justify-between h-16">
                <!-- Logo et navigation principale -->
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <Link href="/" class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600 dark:text-indigo-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">ConseillerImmo</span>
                        </Link>
                    </div>

                    <!-- Navigation principale (desktop) -->
                    <div class="hidden sm:ml-6 sm:flex sm:items-center sm:space-x-4">
                        <Link v-for="item in navigationItems" :key="item.name" :href="item.href"
                            class="relative inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors duration-200"
                            :class="[
                                isActive(item.href)
                                    ? 'text-indigo-600 dark:text-indigo-400'
                                    : 'text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200'
                            ]">
                        {{ item.name }}
                        <div class="absolute bottom-0 left-0 h-0.5 bg-indigo-600 dark:bg-indigo-400 transition-all duration-300"
                            :class="{ 'w-full': isActive(item.href), 'w-0': !isActive(item.href) }"></div>
                        </Link>
                    </div>
                </div>

                <!-- Boutons de droite -->
                <div class="flex items-center">
                    <!-- Bouton de thème sombre/clair -->
                    <button @click="toggleDarkMode"
                        class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none">
                        <svg v-if="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </button>

                    <!-- Notifications -->
                    <div class="ml-3 relative">
                        <button @click="showNotifications = !showNotifications"
                            class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span v-if="notifications.length > 0"
                                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                        </button>

                        <!-- Dropdown notifications -->
                        <div v-if="showNotifications"
                            class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Notifications</h3>
                                </div>
                                <div v-if="notifications.length === 0"
                                    class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                    Aucune notification
                                </div>
                                <div v-else class="max-h-60 overflow-y-auto">
                                    <Link v-for="notification in notifications" :key="notification.id"
                                        :href="notification.href"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <span class="inline-block h-2 w-2 rounded-full mt-1 mr-2" :class="{
                                                'bg-blue-500': notification.type === 'info',
                                                'bg-green-500': notification.type === 'success',
                                                'bg-yellow-500': notification.type === 'warning',
                                                'bg-red-500': notification.type === 'error'
                                            }"></span>
                                        </div>
                                        <div>
                                            <p class="font-medium">{{ notification.title }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{
                                                formatNotificationTime(notification.time) }}</p>
                                        </div>
                                    </div>
                                    </Link>
                                </div>
                                <div class="border-t border-gray-200 dark:border-gray-700">
                                    <Link href="/notifications"
                                        class="block px-4 py-2 text-sm text-center text-indigo-600 dark:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Voir toutes les notifications
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="ml-3 relative">
                        <button @click="showMessages = !showMessages"
                            class="p-2 rounded-md text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span v-if="unreadMessages > 0"
                                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-red-500"></span>
                        </button>

                        <!-- Dropdown messages -->
                        <div v-if="showMessages"
                            class="origin-top-right absolute right-0 mt-2 w-80 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <h3 class="text-sm font-medium text-gray-900 dark:text-white">Messages</h3>
                                </div>
                                <div v-if="messages.length === 0"
                                    class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">
                                    Aucun message
                                </div>
                                <div v-else class="max-h-60 overflow-y-auto">
                                    <Link v-for="message in messages" :key="message.id"
                                        :href="`/messages/${message.conversationId}`"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <div class="flex items-start">
                                        <img :src="message.sender.avatar" :alt="message.sender.name"
                                            class="h-10 w-10 rounded-full mr-3" />
                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium">{{ message.sender.name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{
                                                message.content }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{
                                                formatMessageTime(message.time) }}</p>
                                        </div>
                                        <div v-if="!message.read" class="ml-2 flex-shrink-0">
                                            <span class="inline-block h-2 w-2 rounded-full bg-indigo-500"></span>
                                        </div>
                                    </div>
                                    </Link>
                                </div>
                                <div class="border-t border-gray-200 dark:border-gray-700">
                                    <Link href="/messages"
                                        class="block px-4 py-2 text-sm text-center text-indigo-600 dark:text-indigo-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Voir tous les messages
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Menu utilisateur -->
                    <div class="ml-3 relative">
                        <div>
                            <button @click="showUserMenu = !showUserMenu"
                                class="flex text-sm rounded-full focus:outline-none">
                                <img class="h-8 w-8 rounded-full" :src="user.avatar" :alt="user.name" />
                            </button>
                        </div>

                        <!-- Dropdown menu utilisateur -->
                        <div v-if="showUserMenu"
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ user.name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ user.email }}</p>
                                </div>

                                <Link href="/dashboard"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Tableau de bord
                                </Link>

                                <Link href="/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Mon profil
                                </Link>

                                <Link href="/appointments"
                                    class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Mes rendez-vous
                                </Link>

                                <div v-if="user.role === 'advisor'"
                                    class="border-t border-gray-200 dark:border-gray-700">
                                    <Link href="/advisor/clients"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Mes clients
                                    </Link>

                                    <Link href="/advisor/visits"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Visites
                                    </Link>
                                </div>

                                <div v-if="user.role === 'admin'" class="border-t border-gray-200 dark:border-gray-700">
                                    <Link href="/admin/statistics"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Statistiques
                                    </Link>

                                    <Link href="/admin/users"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Utilisateurs
                                    </Link>

                                    <Link href="/admin/properties"
                                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Propriétés
                                    </Link>
                                </div>

                                <div class="border-t border-gray-200 dark:border-gray-700">
                                    <button @click="logout"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Déconnexion
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton menu mobile -->
                    <div class="flex items-center sm:hidden ml-3">
                        <button @click="showMobileMenu = !showMobileMenu"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none">
                            <svg class="h-6 w-6" :class="{ 'hidden': showMobileMenu, 'block': !showMobileMenu }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="h-6 w-6" :class="{ 'block': showMobileMenu, 'hidden': !showMobileMenu }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div :class="{ 'block': showMobileMenu, 'hidden': !showMobileMenu }" class="sm:hidden">
            <div class="pt-2 pb-3 space-y-1">
                <Link v-for="item in navigationItems" :key="item.name" :href="item.href" :class="[
                    isActive(item.href)
                        ? 'bg-indigo-50 dark:bg-indigo-900 border-indigo-500 text-indigo-700 dark:text-indigo-300'
                        : 'border-transparent text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 hover:text-gray-800 dark:hover:text-gray-200',
                    'block pl-3 pr-4 py-2 border-l-4 text-base font-medium'
                ]">
                {{ item.name }}
                </Link>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { useDarkMode } from '@/Composables/useDarkMode';

// Utiliser notre composable pour le mode sombre
const { darkMode, toggleDarkMode } = useDarkMode();

// État pour les menus déroulants
const showUserMenu = ref(false);
const showNotifications = ref(false);
const showMessages = ref(false);
const showMobileMenu = ref(false);

// Obtenir la page actuelle
const page = usePage();

// Éléments de navigation
const navigationItems = ref([
    { name: 'Accueil', href: '/' },
    { name: 'Propriétés', href: '/properties' },
    { name: 'À propos', href: '/about' },
    { name: 'Contact', href: '/contact' }
]);

// Utilisateur connecté (simulé)
const user = ref({
    name: 'Jean Dupont',
    email: 'jean.dupont@example.com',
    avatar: 'https://randomuser.me/api/portraits/men/1.jpg',
    role: 'advisor' // 'user', 'advisor', 'admin'
});

// Notifications (simulées)
const notifications = ref([
    {
        id: 1,
        title: 'Nouvelle visite programmée',
        time: new Date(Date.now() - 30 * 60 * 1000), // 30 minutes ago
        type: 'info',
        href: '/appointments'
    },
    {
        id: 2,
        title: 'Nouveau message de Marie Martin',
        time: new Date(Date.now() - 2 * 60 * 60 * 1000), // 2 hours ago
        type: 'success',
        href: '/messages/2'
    },
    {
        id: 3,
        title: 'Rappel: Visite demain à 14h30',
        time: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000), // 1 day ago
        type: 'warning',
        href: '/appointments'
    }
]);

// Messages (simulés)
const messages = ref([
    {
        id: 1,
        conversationId: 1,
        sender: {
            name: 'Marie Martin',
            avatar: 'https://randomuser.me/api/portraits/women/2.jpg'
        },
        content: 'Bonjour, je suis intéressée par la villa que vous proposez...',
        time: new Date(Date.now() - 45 * 60 * 1000), // 45 minutes ago
        read: false
    },
    {
        id: 2,
        conversationId: 2,
        sender: {
            name: 'Pierre Durand',
            avatar: 'https://randomuser.me/api/portraits/men/3.jpg'
        },
        content: 'Merci pour les informations. Pouvons-nous prévoir une visite ?',
        time: new Date(Date.now() - 3 * 60 * 60 * 1000), // 3 hours ago
        read: true
    },
    {
        id: 3,
        conversationId: 3,
        sender: {
            name: 'Sophie Bernard',
            avatar: 'https://randomuser.me/api/portraits/women/4.jpg'
        },
        content: 'Est-ce que le prix est négociable ?',
        time: new Date(Date.now() - 1 * 24 * 60 * 60 * 1000), // 1 day ago
        read: true
    }
]);

// Nombre de messages non lus
const unreadMessages = computed(() => {
    return messages.value.filter(message => !message.read).length;
});

// Vérifier si un lien est actif
const isActive = (href) => {
    const currentPath = page.url;
    console.log('URL Inertia:', currentPath);
    console.log('Href testé:', href);

    // Cas spécial pour la page d'accueil
    if (href === '/') {
        return currentPath === '/';
    }

    // Pour les autres pages
    return currentPath.startsWith(href);
};

// Afficher le chemin actuel dans la console pour le débogage
console.log('Chemin actuel:', window.location.pathname);

// Formater le temps des notifications
const formatNotificationTime = (time) => {
    const now = new Date();
    const diff = now - new Date(time);

    const minutes = Math.floor(diff / (1000 * 60));
    const hours = Math.floor(diff / (1000 * 60 * 60));
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));

    if (minutes < 60) {
        return `Il y a ${minutes} minute${minutes > 1 ? 's' : ''}`;
    } else if (hours < 24) {
        return `Il y a ${hours} heure${hours > 1 ? 's' : ''}`;
    } else {
        return `Il y a ${days} jour${days > 1 ? 's' : ''}`;
    }
};

// Formater le temps des messages
const formatMessageTime = (time) => {
    return formatNotificationTime(time);
};

// Déconnexion
const logout = () => {
    // Ici, vous feriez une requête API pour déconnecter l'utilisateur
    router.post('/logout');
};

// Surveiller les changements de route pour mettre à jour l'état actif
watch(() => page.url, (newUrl) => {
    // Cette fonction sera appelée chaque fois que l'URL change
    // Vous pouvez ajouter ici une logique supplémentaire si nécessaire
}, { immediate: true });

// Fermer les menus déroulants lorsqu'on clique en dehors
onMounted(() => {
    const handleClickOutside = (event) => {
        if (!event.target.closest('.relative')) {
            showUserMenu.value = false;
            showNotifications.value = false;
            showMessages.value = false;
        }
    };

    document.addEventListener('click', handleClickOutside);

    // Nettoyage lors du démontage du composant
    return () => {
        document.removeEventListener('click', handleClickOutside);
    };
});
</script>

<style scoped>
/* Animations pour la ligne d'indication */
.w-0 {
    width: 0;
}

.w-full {
    width: 100%;
}
</style>