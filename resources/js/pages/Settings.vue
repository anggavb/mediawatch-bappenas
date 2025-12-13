<script setup>
import { useTheme } from 'vuetify';
import { ref, watch } from 'vue';

const theme = useTheme();
const isDark = ref(theme.global.current.value.dark);

const toggleTheme = () => {
  theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark';
  isDark.value = theme.global.current.value.dark;
};

// Ensure toggle syncs if changed elsewhere
watch(() => theme.global.current.value.dark, (val) => {
    isDark.value = val;
});
</script>

<template>
  <div>
    <h1 class="text-h4 font-weight-bold mb-6">Settings</h1>

    <v-card rounded="lg" class="pa-4 hover-card">
      <v-list-subheader>Appearance</v-list-subheader>
      
      <v-list-item>
        <template v-slot:prepend>
          <v-icon>mdi-theme-light-dark</v-icon>
        </template>
        <v-list-item-title>Dark Mode</v-list-item-title>
        <v-list-item-subtitle>Toggle between light and dark themes</v-list-item-subtitle>
        
        <template v-slot:append>
          <v-switch
            v-model="isDark"
            @change="toggleTheme"
            color="primary"
            hide-details
            inset
          ></v-switch>
        </template>
      </v-list-item>
    </v-card>

    <v-card rounded="lg" class="pa-4 hover-card mt-4">
      <v-list-subheader>Notifications</v-list-subheader>
      
       <v-list-item>
        <template v-slot:prepend>
          <v-icon>mdi-email-outline</v-icon>
        </template>
        <v-list-item-title>Email Notifications</v-list-item-title>
         <template v-slot:append>
          <v-switch color="primary" hide-details inset></v-switch>
        </template>
      </v-list-item>
    </v-card>
  </div>
</template>
