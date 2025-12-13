<script setup>
const images = [
  'https://picsum.photos/id/11/500/300',
  'https://picsum.photos/id/12/500/300',
  'https://picsum.photos/id/13/500/300',
  'https://picsum.photos/id/14/500/300',
  'https://picsum.photos/id/15/500/300',
  'https://picsum.photos/id/16/500/300',
];
</script>

<template>
  <div>
    <h1 class="text-h4 font-weight-bold mb-6">Media Hub</h1>

    <v-card rounded="lg" elevation="2">
      <v-card-text>
        <v-row>
          <v-col v-for="image in images" :key="image" cols="6" md="4" lg="3">
            <v-img :src="image" aspect-ratio="1" cover></v-img>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </div>
</template>
