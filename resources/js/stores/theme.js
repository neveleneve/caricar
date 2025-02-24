import { defineStore } from "pinia";
import { storage } from "@/utils/storage";
import { STORAGE_KEYS } from "@/utils/constants";

export const useThemeStore = defineStore("theme", {
    state: () => {
        const systemPrefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        let isDark;

        try {
            const savedTheme = storage.getItem(STORAGE_KEYS.THEME);
            isDark = savedTheme !== null ? savedTheme : systemPrefersDark;
        } catch (error) {
            isDark = systemPrefersDark;
        }

        return {
            isDark,
            isTransitioning: false,
        };
    },

    actions: {
        initTheme() {
            this.applyTheme();
            if (storage.getItem(STORAGE_KEYS.THEME) === null) {
                storage.setItem(STORAGE_KEYS.THEME, this.isDark);
            }
        },

        toggleTheme() {
            this.isTransitioning = true;
            this.isDark = !this.isDark;
            storage.setItem(STORAGE_KEYS.THEME, this.isDark);
            this.applyTheme();

            setTimeout(() => {
                this.isTransitioning = false;
            }, 300);
        },

        applyTheme() {
            document.documentElement.classList.toggle("dark", this.isDark);
            document.body.classList.toggle("dark", this.isDark);
        },
    },

    persist: true,
});
