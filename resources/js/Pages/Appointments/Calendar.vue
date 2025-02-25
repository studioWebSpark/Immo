<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">

        <Head title="Calendrier des rendez-vous" />

        <!-- En-tête -->
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="container mx-auto px-4 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Calendrier des rendez-vous</h1>
                    <div class="flex space-x-2">
                        <button @click="viewMode = 'month'" class="px-4 py-2 rounded-md"
                            :class="viewMode === 'month' ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'">
                            Mois
                        </button>
                        <button @click="viewMode = 'week'" class="px-4 py-2 rounded-md"
                            :class="viewMode === 'week' ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'">
                            Semaine
                        </button>
                        <button @click="viewMode = 'day'" class="px-4 py-2 rounded-md"
                            :class="viewMode === 'day' ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300'">
                            Jour
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenu principal -->
        <main class="container mx-auto px-4 py-8">
            <!-- Navigation du calendrier -->
            <div class="flex justify-between items-center mb-6">
                <button @click="navigateCalendar('prev')"
                    class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                    {{ calendarTitle }}
                </h2>

                <button @click="navigateCalendar('next')"
                    class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700 dark:text-gray-300" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Vue mensuelle -->
            <div v-if="viewMode === 'month'" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <!-- Jours de la semaine -->
                <div class="grid grid-cols-7 border-b border-gray-200 dark:border-gray-700">
                    <div v-for="day in weekDays" :key="day"
                        class="py-2 text-center text-sm font-medium text-gray-700 dark:text-gray-300">
                        {{ day }}
                    </div>
                </div>

                <!-- Jours du mois -->
                <div class="grid grid-cols-7 auto-rows-fr">
                    <div v-for="(day, index) in calendarDays" :key="index"
                        class="min-h-[100px] p-2 border-b border-r border-gray-200 dark:border-gray-700" :class="{
                            'bg-gray-100 dark:bg-gray-700': day.isToday,
                            'text-gray-400 dark:text-gray-500': !day.isCurrentMonth
                        }">
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm font-medium"
                                :class="day.isToday ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-700 dark:text-gray-300'">
                                {{ day.date }}
                            </span>
                            <span v-if="day.events.length > 0"
                                class="text-xs px-1.5 py-0.5 bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200 rounded-full">
                                {{ day.events.length }}
                            </span>
                        </div>

                        <!-- Événements du jour -->
                        <div class="space-y-1">
                            <div v-for="(event, eventIndex) in day.events.slice(0, 2)" :key="eventIndex"
                                @click="showEventDetails(event)" class="text-xs p-1 rounded truncate cursor-pointer"
                                :class="event.type === 'visit' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200'">
                                {{ event.time }} - {{ event.title }}
                            </div>

                            <div v-if="day.events.length > 2" class="text-xs text-gray-500 dark:text-gray-400 pl-1">
                                + {{ day.events.length - 2 }} autres
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vue hebdomadaire -->
            <div v-else-if="viewMode === 'week'" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <!-- En-tête des jours -->
                <div class="grid grid-cols-8 border-b border-gray-200 dark:border-gray-700">
                    <div
                        class="py-2 text-center text-sm font-medium text-gray-700 dark:text-gray-300 border-r border-gray-200 dark:border-gray-700">
                        Heure
                    </div>
                    <div v-for="day in weekView" :key="day.date"
                        class="py-2 text-center text-sm font-medium border-r border-gray-200 dark:border-gray-700"
                        :class="day.isToday ? 'text-indigo-600 dark:text-indigo-400' : 'text-gray-700 dark:text-gray-300'">
                        {{ day.dayName }}<br>{{ day.date }}
                    </div>
                </div>

                <!-- Heures et événements -->
                <div>
                    <div v-for="hour in hours" :key="hour"
                        class="grid grid-cols-8 border-b border-gray-200 dark:border-gray-700">
                        <div
                            class="py-2 px-2 text-xs text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-700">
                            {{ hour }}
                        </div>

                        <div v-for="(day, dayIndex) in weekView" :key="`${hour}-${dayIndex}`"
                            class="py-2 px-1 border-r border-gray-200 dark:border-gray-700 relative min-h-[50px]">
                            <!-- Événements à cette heure -->
                            <div v-for="(event, eventIndex) in getEventsForHourAndDay(hour, day)" :key="eventIndex"
                                @click="showEventDetails(event)"
                                class="text-xs p-1 rounded absolute inset-x-1 cursor-pointer"
                                :class="event.type === 'visit' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200'"
                                :style="`top: ${eventIndex * 24}px;`">
                                {{ event.time }} - {{ event.title }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vue journalière -->
            <div v-else class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 text-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        {{ dayViewTitle }}
                    </h3>
                </div>

                <!-- Heures et événements -->
                <div>
                    <div v-for="hour in hours" :key="hour" class="flex border-b border-gray-200 dark:border-gray-700">
                        <div
                            class="py-3 px-4 text-sm text-gray-500 dark:text-gray-400 border-r border-gray-200 dark:border-gray-700 w-20">
                            {{ hour }}
                        </div>

                        <div class="flex-grow py-3 px-4 relative min-h-[60px]">
                            <!-- Événements à cette heure -->
                            <div v-for="(event, index) in getEventsForHour(hour)" :key="index"
                                @click="showEventDetails(event)" class="text-sm p-2 rounded mb-1 cursor-pointer"
                                :class="event.type === 'visit' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200'">
                                <div class="font-medium">{{ event.time }} - {{ event.title }}</div>
                                <div class="text-xs mt-1">{{ event.description }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal de détails d'événement -->
        <div v-if="selectedEvent" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-md w-full">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ selectedEvent.title }}</h3>
                    <button @click="selectedEvent = null"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="mb-4">
                    <div class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">{{ selectedEvent.date }} à {{ selectedEvent.time
                            }}</span>
                    </div>

                    <div v-if="selectedEvent.location" class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">{{ selectedEvent.location }}</span>
                    </div>

                    <div v-if="selectedEvent.client" class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-gray-700 dark:text-gray-300">{{ selectedEvent.client }}</span>
                    </div>

                    <div v-if="selectedEvent.type" class="flex items-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500 dark:text-gray-400 mr-2"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        <span class="px-2 py-1 rounded-full text-xs"
                            :class="selectedEvent.type === 'visit' ? 'bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200' : 'bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200'">
                            {{ selectedEvent.type === 'visit' ? 'Visite' : 'Rendez-vous' }}
                        </span>
                    </div>

                    <p v-if="selectedEvent.description" class="text-gray-600 dark:text-gray-300 mb-4">
                        {{ selectedEvent.description }}
                    </p>
                </div>

                <div class="flex justify-end space-x-3">
                    <button @click="selectedEvent = null"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-md">
                        Fermer
                    </button>
                    <button @click="editEvent(selectedEvent)"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                        Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, router } from '@inertiajs/vue3';

// Mode d'affichage (mois, semaine, jour)
const viewMode = ref('month');

// Date actuelle
const currentDate = ref(new Date());

// Événement sélectionné
const selectedEvent = ref(null);

// Jours de la semaine
const weekDays = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

// Heures de la journée
const hours = [
    '08:00', '09:00', '10:00', '11:00', '12:00', '13:00',
    '14:00', '15:00', '16:00', '17:00', '18:00', '19:00'
];

// Titre du calendrier
const calendarTitle = computed(() => {
    const options = { month: 'long', year: 'numeric' };
    if (viewMode.value === 'day') {
        options.day = 'numeric';
    }
    return currentDate.value.toLocaleDateString('fr-FR', options);
});

// Titre de la vue journalière
const dayViewTitle = computed(() => {
    return currentDate.value.toLocaleDateString('fr-FR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
});

// Jours du calendrier (vue mensuelle)
const calendarDays = computed(() => {
    const year = currentDate.value.getFullYear();
    const month = currentDate.value.getMonth();

    // Premier jour du mois
    const firstDay = new Date(year, month, 1);
    // Dernier jour du mois
    const lastDay = new Date(year, month + 1, 0);

    // Jour de la semaine du premier jour (0 = dimanche, 1 = lundi, etc.)
    let firstDayOfWeek = firstDay.getDay();
    // Ajuster pour commencer par lundi (1)
    firstDayOfWeek = firstDayOfWeek === 0 ? 6 : firstDayOfWeek - 1;

    const days = [];

    // Jours du mois précédent
    const prevMonthLastDay = new Date(year, month, 0).getDate();
    for (let i = firstDayOfWeek - 1; i >= 0; i--) {
        const date = prevMonthLastDay - i;
        days.push({
            date,
            isCurrentMonth: false,
            isToday: false,
            events: getEventsForDate(new Date(year, month - 1, date))
        });
    }

    // Jours du mois actuel
    const today = new Date();
    for (let i = 1; i <= lastDay.getDate(); i++) {
        const isToday =
            i === today.getDate() &&
            month === today.getMonth() &&
            year === today.getFullYear();

        days.push({
            date: i,
            isCurrentMonth: true,
            isToday,
            events: getEventsForDate(new Date(year, month, i))
        });
    }

    // Jours du mois suivant
    const remainingDays = 42 - days.length; // 6 semaines * 7 jours = 42
    for (let i = 1; i <= remainingDays; i++) {
        days.push({
            date: i,
            isCurrentMonth: false,
            isToday: false,
            events: getEventsForDate(new Date(year, month + 1, i))
        });
    }

    return days;
});

// Jours de la semaine (vue hebdomadaire)
const weekView = computed(() => {
    const result = [];
    const date = new Date(currentDate.value);

    // Trouver le lundi de la semaine
    const day = date.getDay();
    const diff = date.getDate() - day + (day === 0 ? -6 : 1); // Ajuster quand le jour est dimanche
    date.setDate(diff);

    const today = new Date();

    // Générer les 7 jours de la semaine
    for (let i = 0; i < 7; i++) {
        const currentDate = new Date(date);
        currentDate.setDate(date.getDate() + i);

        const isToday =
            currentDate.getDate() === today.getDate() &&
            currentDate.getMonth() === today.getMonth() &&
            currentDate.getFullYear() === today.getFullYear();

        result.push({
            date: currentDate.getDate(),
            month: currentDate.getMonth(),
            year: currentDate.getFullYear(),
            dayName: currentDate.toLocaleDateString('fr-FR', { weekday: 'short' }),
            isToday,
            fullDate: currentDate,
            events: getEventsForDate(currentDate)
        });
    }

    return result;
});

// Navigation dans le calendrier
const navigateCalendar = (direction) => {
    const date = new Date(currentDate.value);

    if (viewMode.value === 'month') {
        date.setMonth(date.getMonth() + (direction === 'next' ? 1 : -1));
    } else if (viewMode.value === 'week') {
        date.setDate(date.getDate() + (direction === 'next' ? 7 : -7));
    } else {
        date.setDate(date.getDate() + (direction === 'next' ? 1 : -1));
    }

    currentDate.value = date;
};

// Événements (à remplacer par des données réelles)
const events = ref([
    {
        id: 1,
        title: 'Visite appartement',
        description: 'Visite de l\'appartement au 123 rue de Paris avec M. Dupont',
        date: '2023-06-15',
        time: '10:00',
        type: 'visit',
        client: 'Jean Dupont',
        location: '123 rue de Paris, 75001 Paris'
    },
    {
        id: 2,
        title: 'Signature compromis',
        description: 'Signature du compromis de vente avec Mme Martin',
        date: '2023-06-15',
        time: '14:30',
        type: 'meeting',
        client: 'Marie Martin',
        location: 'Agence centrale'
    },
    {
        id: 3,
        title: 'Visite maison',
        description: 'Visite de la maison au 45 avenue des Fleurs avec M. et Mme Bernard',
        date: '2023-06-16',
        time: '11:00',
        type: 'visit',
        client: 'Famille Bernard',
        location: '45 avenue des Fleurs, 75016 Paris'
    },
    {
        id: 4,
        title: 'Rendez-vous estimation',
        description: 'Estimation d\'un appartement pour M. Petit',
        date: '2023-06-18',
        time: '09:30',
        type: 'meeting',
        client: 'Thomas Petit',
        location: '78 boulevard Haussmann, 75008 Paris'
    }
]);

// Récupérer les événements pour une date donnée
const getEventsForDate = (date) => {
    const dateString = date.toISOString().split('T')[0];
    return events.value.filter(event => event.date === dateString);
};

// Récupérer les événements pour une heure et un jour donnés
const getEventsForHourAndDay = (hour, day) => {
    const dateString = `${day.year}-${String(day.month + 1).padStart(2, '0')}-${String(day.date).padStart(2, '0')}`;
    return events.value.filter(event => {
        return event.date === dateString && event.time.startsWith(hour.split(':')[0]);
    });
};

// Récupérer les événements pour une heure donnée
const getEventsForHour = (hour) => {
    const dateString = currentDate.value.toISOString().split('T')[0];
    return events.value.filter(event => {
        return event.date === dateString && event.time.startsWith(hour.split(':')[0]);
    });
};

// Afficher les détails d'un événement
const showEventDetails = (event) => {
    selectedEvent.value = event;
};

// Modifier un événement
const editEvent = (event) => {
    // Rediriger vers la page d'édition de l'événement
    router.visit(`/appointments/${event.id}/edit`);
};

onMounted(() => {
    // Charger les événements
    // fetchEvents();
});
</script>
