<template>
  <v-app>
    <div class="auth-container" @mousemove="handleMouseMove">
      <!-- Cursor Glow Effect -->
      <div 
        class="cursor-glow"
        :style="{ 
          left: `${mouseX}px`, 
          top: `${mouseY}px` 
        }"
      ></div>

      <!-- Background Elements -->
      <div class="bg-shape shape-1"></div>
      <div class="bg-shape shape-2"></div>

      <v-main>
        <v-container fluid class="fill-height justify-center align-center py-12">
          <v-row justify="center" align="center">
            <v-col cols="12" sm="8" md="6" lg="5">
              <div class="auth-card-wrapper">
                <slot></slot>
              </div>
            </v-col>
          </v-row>
        </v-container>
      </v-main>
    </div>
  </v-app>
</template>

<script setup>
import { ref } from 'vue';

const mouseX = ref(0);
const mouseY = ref(0);

const handleMouseMove = (event) => {
  mouseX.value = event.clientX;
  mouseY.value = event.clientY;
};
</script>

<style scoped>
.auth-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
  width: 100vw;
  background: #0f172a; /* Deep dark blue/slate */
  color: #fff;
  position: relative;
  overflow-x: hidden;
}

/* Cursor Glow */
.cursor-glow {
  position: fixed;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(56, 189, 248, 0.15) 0%, rgba(0, 0, 0, 0) 70%);
  border-radius: 50%;
  pointer-events: none;
  transform: translate(-50%, -50%);
  z-index: 1;
  transition: opacity 0.3s ease;
  mix-blend-mode: screen;
}

/* Background Shapes */
.bg-shape {
  position: absolute;
  filter: blur(80px);
  z-index: 0;
  opacity: 0.4;
  animation: float 10s infinite ease-in-out;
}

.shape-1 {
  top: -10%;
  left: -10%;
  width: 500px;
  height: 500px;
  background: #7c3aed; /* Violet */
  border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
}

.shape-2 {
  bottom: -10%;
  right: -10%;
  width: 600px;
  height: 600px;
  background: #2563eb; /* Blue */
  border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
  animation-delay: -5s;
}

@keyframes float {
  0%, 100% { transform: translate(0, 0); }
  50% { transform: translate(30px, 30px); }
}

/* Glassmorphism Wrapper */
.auth-card-wrapper {
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(16px);
  -webkit-backdrop-filter: blur(16px);
  border: 1px solid rgba(255, 255, 255, 0.05);
  border-radius: 24px;
  padding: 40px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
  position: relative;
  z-index: 2;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.auth-card-wrapper:hover {
  transform: translateY(-5px);
  box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.6), 0 0 20px rgba(56, 189, 248, 0.1);
  border-color: rgba(56, 189, 248, 0.2);
}
</style>
