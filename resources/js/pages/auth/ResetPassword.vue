<template>
  <GuestLayout>
    <div class="text-center mb-8">
      <h1 class="text-h4 font-weight-bold text-white mb-2 glowing-text">New Password</h1>
      <p class="text-white text-body-2">Create a secure new password</p>
    </div>

    <v-form @submit.prevent="handleReset" v-model="isFormValid">
      <v-text-field
        v-model="form.email"
        label="Email Address"
        variant="outlined"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-email-outline"
        :rules="[rules.required, rules.email]"
        class="mb-2 futuristic-input"
        rounded="lg"
        readonly
      ></v-text-field>

      <v-text-field
        v-model="form.password"
        label="New Password"
        :type="showPassword ? 'text' : 'password'"
        variant="outlined"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-lock-outline"
        :append-inner-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
        @click:append-inner="showPassword = !showPassword"
        :rules="[rules.required, rules.min]"
        class="mb-2 futuristic-input"
        rounded="lg"
      ></v-text-field>

      <v-text-field
        v-model="form.password_confirmation"
        label="Confirm New Password"
        :type="showPassword ? 'text' : 'password'"
        variant="outlined"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-lock-check-outline"
        :rules="[rules.required, rules.match]"
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
        Reset Password
      </v-btn>
    </v-form>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();
const loading = ref(false);
const isFormValid = ref(false);
const showPassword = ref(false);

const form = reactive({
  token: '',
  email: '',
  password: '',
  password_confirmation: ''
});

onMounted(() => {
  form.email = route.query.email || '';
  form.token = route.params.token || '';
});

const rules = {
  required: value => !!value || 'Required.',
  email: value => {
    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    return pattern.test(value) || 'Invalid e-mail.'
  },
  min: value => value.length >= 8 || 'Min 8 characters',
  match: value => value === form.password || 'Passwords do not match'
};

const handleReset = async () => {
  if (!isFormValid.value) return;
  
  loading.value = true;
  try {
    console.log('Reset password attempt:', form);
    // await axios.post('/api/reset-password', form);
    setTimeout(() => {
        // router.push({ name: 'Login' });
    }, 1000);
  } catch (error) {
    console.error('Password reset failed', error);
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
