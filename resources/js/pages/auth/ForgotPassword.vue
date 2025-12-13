<template>
  <GuestLayout>
    <div class="text-center mb-8">
      <h1 class="text-h4 font-weight-bold text-white mb-2 glowing-text">Reset Password</h1>
      <p class="text-white text-body-2">Enter your email to receive a reset link</p>
    </div>

    <v-form @submit.prevent="handleSubmit" v-model="isFormValid">
      <div v-if="status" class="mb-4 text-success text-body-2 font-weight-bold">
        {{ status }}
      </div>

      <v-text-field
        v-model="form.email"
        label="Email Address"
        variant="outlined"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-email-outline"
        :rules="[rules.required, rules.email]"
        class="mb-6 futuristic-input"
        rounded="lg"
      ></v-text-field>

      <v-btn
        block
        size="large"
        color="primary"
        type="submit"
        :loading="loading"
        class="futuristic-btn mb-6"
        elevation="4"
        rounded="lg"
      >
        Send Reset Link
      </v-btn>

      <div class="text-center text-body-2 text-white">
        Remember your password?
        <router-link to="/login" class="text-decoration-none text-primary font-weight-bold hover-glow ml-1">
          Back to Login
        </router-link>
      </div>
    </v-form>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import GuestLayout from '@/layouts/GuestLayout.vue';

const loading = ref(false);
const isFormValid = ref(false);
const status = ref('');

const form = reactive({
  email: ''
});

const rules = {
  required: value => !!value || 'Required.',
  email: value => {
    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    return pattern.test(value) || 'Invalid e-mail.'
  }
};

const handleSubmit = async () => {
  if (!isFormValid.value) return;
  
  loading.value = true;
  status.value = '';
  
  try {
    console.log('Forgot password attempt:', form);
    // await axios.post('/api/forgot-password', form);
    setTimeout(() => {
        status.value = 'We have emailed your password reset link.';
    }, 1000);
  } catch (error) {
    console.error('Failed to send link', error);
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

.hover-glow:hover {
  text-shadow: 0 0 10px currentColor;
}
</style>
