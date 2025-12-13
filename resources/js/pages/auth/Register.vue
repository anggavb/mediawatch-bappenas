<template>
  <GuestLayout>
    <div class="text-center mb-4">
      <h1 class="text-h4 font-weight-bold text-white mb-1 glowing-text">Create Account</h1>
      <p class="text-white text-body-2">Join us and explore the future</p>
    </div>

    <v-form @submit.prevent="handleRegister" v-model="isFormValid">
      <v-text-field
        v-model="form.name"
        label="Full Name"
        variant="outlined"
        density="compact"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-account-outline"
        :rules="[rules.required]"
        class="mb-2 futuristic-input"
        rounded="lg"
      ></v-text-field>

      <v-text-field
        v-model="form.email"
        label="Email Address"
        variant="outlined"
        density="compact"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-email-outline"
        :rules="[rules.required, rules.email]"
        class="mb-2 futuristic-input"
        rounded="lg"
      ></v-text-field>

      <v-text-field
        v-model="form.password"
        label="Password"
        :type="showPassword ? 'text' : 'password'"
        variant="outlined"
        density="compact"
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
        label="Confirm Password"
        :type="showPassword ? 'text' : 'password'"
        variant="outlined"
        density="compact"
        bg-color="rgba(255,255,255,0.05)"
        color="primary"
        prepend-inner-icon="mdi-lock-check-outline"
        :rules="[rules.required, rules.match]"
        class="mb-4 futuristic-input"
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
        Sign Up
      </v-btn>

      <div class="d-flex align-center mb-4">
        <v-divider class="border-opacity-25"></v-divider>
        <span class="mx-4 text-caption text-white text-no-wrap">OR SIGN UP WITH</span>
        <v-divider class="border-opacity-25"></v-divider>
      </div>

      <div class="d-flex justify-center gap-4 mb-4">
        <v-btn
          icon="mdi-google"
          variant="outlined"
          color="white"
          class="social-btn"
          @click="socialLogin('google')"
        ></v-btn>
        <v-btn
          icon="mdi-github"
          variant="outlined"
          color="white"
          class="social-btn"
          @click="socialLogin('github')"
        ></v-btn>
        <v-btn
          icon="mdi-linkedin"
          variant="outlined"
          color="white"
          class="social-btn"
          @click="socialLogin('linkedin')"
        ></v-btn>
      </div>

      <div class="text-center text-body-2 text-white">
        Already have an account? 
        <router-link to="/login" class="text-decoration-none text-primary font-weight-bold hover-glow ml-1">
          Sign In
        </router-link>
      </div>
    </v-form>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const loading = ref(false);
const isFormValid = ref(false);
const showPassword = ref(false);

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
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

const handleRegister = async () => {
  if (!isFormValid.value) return;
  
  loading.value = true;
  try {
    console.log('Register attempt:', form);
    // await axios.post('/api/auth/register', form);
    setTimeout(() => {
        // router.push({ name: 'Dashboard' });
    }, 1000);
  } catch (error) {
    console.error('Registration failed', error);
  } finally {
    loading.value = false;
  }
};

const socialLogin = (provider) => {
  console.log(`Register with ${provider}`);
  // Window.location.href = `/api/auth/${provider}`;
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

.border-opacity-25 {
  border-color: rgba(255, 255, 255, 0.25);
}

.social-btn {
  border-color: rgba(255, 255, 255, 0.2);
  transition: all 0.3s ease;
}

.social-btn:hover {
  background: rgba(255, 255, 255, 0.1);
  border-color: #fff;
  transform: scale(1.1);
}

.gap-4 {
  gap: 16px;
}
</style>
