<script setup>
</script>

<template>
  <div>
    <h1 class="text-h4 font-weight-bold mb-6">Dashboard</h1>
    
    <v-row>
      <v-col cols="12" sm="6" md="3" v-for="i in 4" :key="i">
        <v-card class="hover-card" rounded="lg" elevation="2">
          <v-card-text class="d-flex flex-column align-center pa-6">
            <v-icon color="primary" size="x-large" class="mb-3">mdi-chart-box-outline</v-icon>
            <div class="text-h4 font-weight-bold mb-1">1,245</div>
            <div class="text-subtitle-2 text-medium-emphasis">Active Users</div>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row class="mt-6">
      <v-col cols="12" md="8">
        <v-card rounded="lg" elevation="2" class="hover-card">
          <v-card-title class="pa-4">Revenue Overview</v-card-title>
          <v-card-text style="height: 300px;" class="d-flex align-center justify-center text-medium-emphasis bg-surface-variant">
            [Chart Area Placeholder]
          </v-card-text>
        </v-card>
      </v-col>
      <v-col cols="12" md="4">
        <v-card rounded="lg" elevation="2" class="hover-card" height="100%">
          <v-card-title class="pa-4">Recent Activity</v-card-title>
          <v-list lines="two">
            <v-list-item v-for="n in 5" :key="n" :subtitle="'Just now'" title="New order received">
              <template v-slot:prepend>
                <v-avatar color="primary" variant="tonal" size="small">
                  <v-icon size="small">mdi-basket-outline</v-icon>
                </v-avatar>
              </template>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>
