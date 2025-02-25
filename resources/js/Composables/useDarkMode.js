import { ref, onMounted, watch } from "vue";

export function useDarkMode() {
    const darkMode = ref(false);

    // Initialiser le mode sombre en fonction de la préférence de l'utilisateur
    onMounted(() => {
        // Vérifier si l'utilisateur a déjà une préférence stockée
        const savedMode = localStorage.getItem("darkMode");

        if (savedMode !== null) {
            // Utiliser la préférence stockée
            darkMode.value = savedMode === "true";
        } else {
            // Sinon, vérifier la préférence du système
            const prefersDark = window.matchMedia(
                "(prefers-color-scheme: dark)"
            ).matches;
            darkMode.value = prefersDark;
        }

        // Appliquer le mode initial
        applyDarkMode(darkMode.value);
    });

    // Observer les changements et mettre à jour le DOM
    watch(darkMode, (newValue) => {
        // Sauvegarder la préférence
        localStorage.setItem("darkMode", newValue);

        // Appliquer le changement
        applyDarkMode(newValue);
    });

    // Fonction pour basculer le mode sombre
    const toggleDarkMode = () => {
        darkMode.value = !darkMode.value;
    };

    // Fonction pour appliquer le mode sombre au DOM
    const applyDarkMode = (isDark) => {
        if (isDark) {
            document.documentElement.classList.add("dark");
        } else {
            document.documentElement.classList.remove("dark");
        }
    };

    return {
        darkMode,
        toggleDarkMode,
    };
}
