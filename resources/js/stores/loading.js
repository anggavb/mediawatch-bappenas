import { defineStore } from 'pinia';

export const useLoadingStore = defineStore('loading', {
  state: () => ({
    isLoading: false,
    progress: 0,
  }),
  actions: {
    start() {
      this.isLoading = true;
      this.progress = 0;
    },
    finish() {
      setTimeout(() => {
        this.isLoading = false;
        this.progress = 0;
      }, 300);
    },
    setProgress(value) {
      this.progress = value;
    },
  },
});
