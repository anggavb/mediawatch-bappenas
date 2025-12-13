<script setup>
import { ref, computed } from 'vue';
import { storeToRefs } from 'pinia';
import { useTheme } from 'vuetify';

const drawer = ref(true);
const theme = useTheme();

const items = [
  { title: 'Dashboard', icon: 'mdi-view-dashboard-outline', to: '/', exact: true },
  { title: 'Media Hub', icon: 'mdi-folder-image', to: '/media-hub' },
  { title: 'Analytic', icon: 'mdi-chart-line', to: '/analytic' },
  { title: 'Settings', icon: 'mdi-cog-outline', to: '/settings' },
  { title: 'CRUD', icon: 'mdi-table-edit', to: '/crud' },
];

const backgroundStyle = computed(() => {
  const isDark = theme.global.current.value.dark;
  return {
    background: isDark 
      ? 'linear-gradient(135deg, #28243d 0%, #1e1b2e 100%) !important' 
      : 'linear-gradient(135deg, #f8f7fa 0%, #e6e9f1 100%) !important',
    minHeight: '100vh',
  };
});
</script>

<template>
  <v-app>
    <!-- Global Loading Bar -->
    <v-progress-linear
      v-if="isLoading"
      v-model:model-value="progress"
      indeterminate
      color="primary"
      height="4"
      fixed
      style="z-index: 9999;"
    ></v-progress-linear>

    <!-- Navigation Drawer -->
    <v-navigation-drawer v-model="drawer" :elevation="0" class="border-e bg-surface" width="260">
      <div class="pa-4 d-flex align-center justify-center">
        <v-img
          src="https://cdn.vuetifyjs.com/docs/images/logos/vuetify-logo-v3-slim-text-light.svg"
          alt="Logo"
          max-height="30"
          contain
        ></v-img>
      </div>

      <v-list class="pa-2" density="compact" nav>
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :value="item"
          :to="item.to"
          :exact="item.exact"
          color="primary"
          rounded="lg"
          class="mb-1"
        >
          <template v-slot:prepend>
            <v-icon :icon="item.icon" size="small"></v-icon>
          </template>

          <v-list-item-title class="text-body-2 font-weight-medium">{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <!-- App Bar -->
    <v-app-bar :elevation="0" class="border-b bg-surface" density="compact">
      <v-app-bar-nav-icon @click="drawer = !drawer" variant="text" size="small"></v-app-bar-nav-icon>

      <v-spacer></v-spacer>

      <div class="d-flex align-center w-25 mw-50 me-4">
        <v-text-field
          density="compact"
          variant="outlined"
          label="Search"
          append-inner-icon="mdi-magnify"
          single-line
          hide-details
          rounded="lg"
          color="primary"
          bg-color="grey-lighten-4"
        ></v-text-field>
      </div>

      <v-btn icon class="me-2" size="small">
        <v-badge content="2" color="error" dot>
          <v-icon>mdi-bell-outline</v-icon>
        </v-badge>
      </v-btn>

      <v-menu min-width="200px" rounded>
        <template v-slot:activator="{ props }">
          <v-btn icon v-bind="props" size="small">
            <v-avatar color="primary" variant="tonal" size="32">
              <v-img src="https://randomuser.me/api/portraits/men/85.jpg" alt="John"></v-img>
            </v-avatar>
          </v-btn>
        </template>
        <v-card>
          <v-list-item
            prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
            title="John Doe"
            subtitle="Admin"
          ></v-list-item>
          <v-divider></v-divider>
          <v-list density="compact">
            <v-list-item prepend-icon="mdi-account-outline" title="Profile" value="profile"></v-list-item>
            <v-list-item prepend-icon="mdi-logout" title="Logout" value="logout" color="error"></v-list-item>
          </v-list>
        </v-card>
      </v-menu>
    </v-app-bar>

    <!-- Main Content -->
    <v-main :style="backgroundStyle">
      <v-container fluid class="pa-6">
        <router-view v-slot="{ Component }">
          <transition name="fade" mode="out-in">
            <component :is="Component" />
          </transition>
        </router-view>
      </v-container>
    </v-main>
  </v-app>
</template>

<style scoped>
</style>
