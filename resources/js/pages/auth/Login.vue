<template>
  <GuestLayout>
    <div class="text-center mb-8">
      <h1 class="text-h4 font-weight-bold text-white mb-2 glowing-text">Welcome Back</h1>
      <p class="text-white text-body-2">Sign in to continue your journey</p>
    </div>

    <v-form @submit.prevent="handleLogin" v-model="isFormValid">
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
      ></v-text-field>

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
        class="mb-1 futuristic-input"
        rounded="lg"
      ></v-text-field>

      <div class="d-flex justify-space-between align-center mb-6">
        <v-checkbox
          v-model="form.remember"
          label="Remember me"
          color="secondary"
          hide-details
          class="text-body-2 small-checkbox"
          density="compact"
        ></v-checkbox>
        <router-link to="/forgot-password" class="text-decoration-none text-secondary text-caption font-weight-bold hover-glow">
          Forgot Password?
        </router-link>
      </div>

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
        Sign In
      </v-btn>

      <div class="d-flex align-center mb-4">
        <v-divider class="border-opacity-40"></v-divider>
        <span class="mx-4 text-caption text-white text-no-wrap">OR CONTINUE WITH</span>
        <v-divider class="border-opacity-40"></v-divider>
      </div>

      <div class="d-flex justify-center gap-4 mb-6">
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

      <div class="text-center text-body-2 text-with">
        Don't have an account? 
        <router-link to="/register" class="text-decoration-none text-primary font-weight-bold hover-glow ml-1">
          Create Account
        </router-link>
      </div>
    </v-form>
  </GuestLayout>
</template>

<script setup>
import { ref, reactive } from 'vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { useRouter } from 'vue-router';
// import { useAuthStore } from '@/stores/auth'; // Assuming store existence, otherwise direct axios

const router = useRouter();
const loading = ref(false);
const isFormValid = ref(false);
const showPassword = ref(false);

const form = reactive({
  email: '',
  password: '',
  remember: false
});

const rules = {
  required: value => !!value || 'Required.',
  email: value => {
    const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    return pattern.test(value) || 'Invalid e-mail.'
  }
};

const handleLogin = async () => {
  if (!isFormValid.value) return;
  
  loading.value = true;
  try {
    // Mimic API call
    console.log('Login attempt:', form);
    // await axios.post('/api/auth/login', form);
    setTimeout(() => {
        // router.push({ name: 'Dashboard' });
    }, 1000);
  } catch (error) {
    console.error('Login failed', error);
  } finally {
    loading.value = false;
  }
};

const socialLogin = (provider) => {
  console.log(`Login with ${provider}`);
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
  border-color: #38bdf8 !important; /* Sky Blue */
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

.small-checkbox :deep(.v-label) {
  opacity: 0.7;
}

/* Gap helper */
.gap-4 {
  gap: 16px;
}
</style>
