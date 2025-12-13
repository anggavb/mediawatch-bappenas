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
    <h1 class="text-h4 font-weight-bold mb-6">Media Library</h1>

    <v-card rounded="lg" elevation="0" class="bg-transparent">
        <v-row>
        <v-col v-for="(img, n) in images" :key="n" cols="12" md="4" lg="3">
            <v-card class="hover-card" rounded="lg">
            <v-img
                :src="img"
                :lazy-src="img"
                aspect-ratio="1.5"
                cover
            >
                <template v-slot:placeholder>
                <v-row align="center" justify="center" class="fill-height ma-0">
                    <v-progress-circular indeterminate color="primary"></v-progress-circular>
                </v-row>
                </template>
            </v-img>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon="mdi-heart" color="error" variant="text"></v-btn>
                <v-btn icon="mdi-share-variant" color="primary" variant="text"></v-btn>
            </v-card-actions>
            </v-card>
        </v-col>
        </v-row>
    </v-card>
  </div>
</template>
