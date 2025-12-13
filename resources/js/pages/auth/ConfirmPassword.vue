<template>
  <GuestLayout>
    <div class="text-center mb-8">
      <h1 class="text-h4 font-weight-bold text-white mb-2 glowing-text">Confirm Access</h1>
      <p class="text-white text-body-2">This is a secure area of the application. Please confirm your password before continuing.</p>
    </div>

    <v-form @submit.prevent="handleConfirm" v-model="isFormValid">
      <v-text-field
        v-model="form.password"
        label="Password"
        :type="showPassword ? 'text' : 'password'"
        variant="outlined"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-lock-outline"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        @click:append-inner="showPassword = !showPassword"
        :rules="[rules.required]"
        class="mb-6 futuristic-input"
        rounded="lg"
      ></v-text-field>

      <v-btn
        block
        size="large"
        color="primary"
        type="submit"
        :loading="loading"
        class="futuristic-btn"
        elevation="4"
        rounded="lg"
      >
        Confirm
      </v-btn>
    </v-form>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import GuestLayout from '@/layouts/GuestLayout.vue';

const loading = ref(false);
const isFormValid = ref(false);
const showPassword = ref(false);

const form = reactive({
  password: ''
});

const rules = {
  required: value => !!value || 'Required.'
};

const handleConfirm = async () => {
  if (!isFormValid.value) return;
  
  loading.value = true;
  try {
    console.log('Confirm password attempt:', form);
    // await axios.post('/api/confirm-password', form);
    // Redirect intended
  } catch (error) {
    console.error('Confirmation failed', error);
  } finally {
    loading.value = false;
  }
};
</script>

<style scoped>
.glowing-text {
  text-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
}

.futuristic-input :deep(.v-field__outline__start),
.futuristic-input :deep(.v-field__outline__end),
.futuristic-input :deep(.v-field__outline__notch) {
  border-color: rgba(255, 255, 255, 0.1) !important;
}

.futuristic-input :deep(.v-field--focused .v-field__outline__start),
.futuristic-input :deep(.v-field--focused .v-field__outline__end),
.futuristic-input :deep(.v-field--focused .v-field__outline__notch) {
  border-color: #38bdf8 !important;
  box-shadow: 0 0 10px rgba(56, 189, 248, 0.2);
}

.futuristic-btn {
  background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
  transition: all 0.3s ease;
  text-transform: none;
  font-weight: 700;
  letter-spacing: 0.5px;
}

.futuristic-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 0 20px rgba(124, 58, 237, 0.5);
}
</style>
