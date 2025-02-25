<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Messages" />

        <!-- En-tête -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-4 py-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Messages</h1>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="container mx-auto px-4 py-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
                    <!-- Liste des conversations -->
                    <div class="border-r border-gray-200 dark:border-gray-700">
                        <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                            <div class="relative">
                                <input type="text" v-model="searchQuery" placeholder="Rechercher..."
                                    class="w-full px-4 py-2 pl-10 rounded-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white" />
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 text-gray-400 absolute left-3 top-2.5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="overflow-y-auto max-h-[calc(100vh-200px)]">
                            <div v-for="conversation in filteredConversations" :key="conversation.id"
                                @click="selectConversation(conversation)"
                                class="p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 cursor-pointer"
                                :class="{ 'bg-indigo-50 dark:bg-indigo-900': selectedConversation && selectedConversation.id === conversation.id }">
                                <div class="flex items-start">
                                    <img :src="conversation.participant.avatar" :alt="conversation.participant.name"
                                        class="w-10 h-10 rounded-full mr-3" />
                                    <div class="flex-grow min-w-0">
                                        <div class="flex justify-between items-center mb-1">
                                            <h3 class="font-medium text-gray-900 dark:text-white truncate">{{
                                                conversation.participant.name }}</h3>
                                            <span class="text-xs text-gray-500 dark:text-gray-400">{{
                                                formatDate(conversation.lastMessage.timestamp) }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 truncate">
                                            {{ conversation.lastMessage.content }}
                                        </p>
                                    </div>
                                </div>
                                <div v-if="conversation.unreadCount > 0" class="mt-1 flex justify-end">
                                    <span
                                        class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-indigo-600 rounded-full">
                                        {{ conversation.unreadCount }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Conversation active -->
                    <div class="md:col-span-2 lg:col-span-3 flex flex-col h-[calc(100vh-200px)]">
                        <div v-if="selectedConversation" class="flex-grow flex flex-col">
                            <!-- En-tête de la conversation -->
                            <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center">
                                <img :src="selectedConversation.participant.avatar"
                                    :alt="selectedConversation.participant.name" class="w-10 h-10 rounded-full mr-3" />
                                <div>
                                    <h3 class="font-medium text-gray-900 dark:text-white">{{
                                        selectedConversation.participant.name }}</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ selectedConversation.participant.isOnline ? 'En ligne' : 'Hors ligne' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Messages -->
                            <div class="flex-grow p-4 overflow-y-auto" ref="messagesContainer">
                                <div v-for="(message, index) in selectedConversation.messages" :key="index"
                                    class="mb-4">
                                    <div class="flex" :class="message.isFromMe ? 'justify-end' : 'justify-start'">
                                        <div class="max-w-xs md:max-w-md lg:max-w-lg rounded-lg px-4 py-2"
                                            :class="message.isFromMe ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white'">
                                            <p>{{ message.content }}</p>
                                            <p class="text-xs mt-1 text-right"
                                                :class="message.isFromMe ? 'text-indigo-200' : 'text-gray-500 dark:text-gray-400'">
                                                {{ formatTime(message.timestamp) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Formulaire de message -->
                            <div class="p-4 border-t border-gray-200 dark:border-gray-700">
                                <form @submit.prevent="sendMessage" class="flex">
                                    <input type="text" v-model="newMessage" placeholder="Écrivez votre message..."
                                        class="flex-grow px-4 py-2 rounded-l-md border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"
                                        required />
                                    <button type="submit"
                                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-r-md">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Aucune conversation sélectionnée -->
                        <div v-else class="flex-grow flex items-center justify-center">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400 mx-auto mb-4"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-1">Aucune conversation
                                    sélectionnée</h3>
                                <p class="text-gray-500 dark:text-gray-400">Sélectionnez une conversation pour commencer
                                    à discuter</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script setup>
import { ref, computed, watch, nextTick } from 'vue';
import { Head } from '@inertiajs/vue3';

// Conversations (à remplacer par des données réelles)
const conversations = ref([
    {
        id: 1,
        participant: {
            id: 101,
            name: 'Jean Dupont',
            avatar: 'https://via.placeholder.com/100',
            isOnline: true
        },
        lastMessage: {
            content: 'Bonjour, je suis intéressé par votre appartement',
            timestamp: new Date(2023, 5, 15, 14, 30)
        },
        unreadCount: 2,
        messages: [
            {
                content: 'Bonjour, je suis intéressé par votre appartement au 123 rue de Paris',
                timestamp: new Date(2023, 5, 15, 14, 30),
                isFromMe: false
            },
            {
                content: 'Bonjour ! Bien sûr, je serais ravi de vous donner plus d\'informations',
                timestamp: new Date(2023, 5, 15, 14, 35),
                isFromMe: true
            },
            {
                content: 'Est-ce que je pourrais visiter le bien cette semaine ?',
                timestamp: new Date(2023, 5, 15, 14, 40),
                isFromMe: false
            }
        ]
    },
    {
        id: 2,
        participant: {
            id: 102,
            name: 'Marie Martin',
            avatar: 'https://via.placeholder.com/100',
            isOnline: false
        },
        lastMessage: {
            content: 'Merci pour la visite d\'hier',
            timestamp: new Date(2023, 5, 14, 18, 15)
        },
        unreadCount: 0,
        messages: [
            {
                content: 'Bonjour, je voulais vous remercier pour la visite d\'hier',
                timestamp: new Date(2023, 5, 14, 18, 15),
                isFromMe: false
            },
            {
                content: 'Avec plaisir ! Avez-vous des questions supplémentaires ?',
                timestamp: new Date(2023, 5, 14, 18, 20),
                isFromMe: true
            },
            {
                content: 'Non, tout était très clair. Je vais y réfléchir et je vous recontacte bientôt',
                timestamp: new Date(2023, 5, 14, 18, 25),
                isFromMe: false
            }
        ]
    },
    {
        id: 3,
        participant: {
            id: 103,
            name: 'Pierre Durand',
            avatar: 'https://via.placeholder.com/100',
            isOnline: true
        },
        lastMessage: {
            content: 'Je confirme notre rendez-vous pour demain à 10h',
            timestamp: new Date(2023, 5, 15, 9, 45)
        },
        unreadCount: 1,
        messages: [
            {
                content: 'Bonjour, je voulais confirmer notre rendez-vous pour demain à 10h',
                timestamp: new Date(2023, 5, 15, 9, 45),
                isFromMe: false
            },
            {
                content: 'Bonjour Pierre, c\'est bien noté ! Je vous attendrai à l\'agence',
                timestamp: new Date(2023, 5, 15, 10, 0),
                isFromMe: true
            }
        ]
    }
]);

// Conversation sélectionnée
const selectedConversation = ref(null);

// Nouveau message
const newMessage = ref('');

// Recherche
const searchQuery = ref('');

// Référence au conteneur de messages
const messagesContainer = ref(null);

// Conversations filtrées
const filteredConversations = computed(() => {
    if (!searchQuery.value) return conversations.value;

    const query = searchQuery.value.toLowerCase();
    return conversations.value.filter(conversation =>
        conversation.participant.name.toLowerCase().includes(query)
    );
});

// Sélectionner une conversation
const selectConversation = (conversation) => {
    selectedConversation.value = conversation;

    // Marquer comme lu
    if (conversation.unreadCount > 0) {
        conversation.unreadCount = 0;
    }

    // Faire défiler jusqu'au dernier message
    nextTick(() => {
        if (messagesContainer.value) {
            messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
        }
    });
};

// Envoyer un message
const sendMessage = () => {
    if (!newMessage.value.trim()) return;

    // Ajouter le message à la conversation
    selectedConversation.value.messages.push({
        content: newMessage.value,
        timestamp: new Date(),
        isFromMe: true
    });

    // Mettre à jour le dernier message
    selectedConversation.value.lastMessage = {
        content: newMessage.value,
        timestamp: new Date()
    };

    // Réinitialiser le champ de message
    newMessage.value = '';

    // Faire défiler jusqu'au dernier message
    nextTick(() => {
        if (messagesContainer.value) {
            messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
        }
    });
};

// Formater la date
const formatDate = (date) => {
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    const yesterday = new Date(today);
    yesterday.setDate(yesterday.getDate() - 1);

    if (date >= today) {
        return formatTime(date);
    } else if (date >= yesterday) {
        return 'Hier';
    } else {
        return date.toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' });
    }
};

// Formater l'heure
const formatTime = (date) => {
    return date.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
};

// Surveiller les changements de conversation pour faire défiler
watch(selectedConversation, () => {
    nextTick(() => {
        if (messagesContainer.value) {
            messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
        }
    });
});
</script>
