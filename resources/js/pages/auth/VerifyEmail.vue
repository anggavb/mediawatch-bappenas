<template>
  <GuestLayout>
    <div class="text-center mb-8">
      <h1 class="text-h4 font-weight-bold text-white mb-2 glowing-text">Verify Email</h1>
      <p class="text-white text-body-2" v-if="verificationLinkSent">
        A new verification link has been sent to the email address you provided during registration.
      </p>
      <p class="text-white text-body-2" v-else>
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
      </p>
    </div>

    <v-form @submit.prevent="resendVerification">
      <div class="d-flex flex-column gap-4">
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
          Resend Verification Email
        </v-btn>

        <v-btn
          block
          size="large"
          variant="text"
          color="secondary"
          @click="logout"
          class="text-uppercase letter-spacing-2"
        >
          Log Out
        </v-btn>
      </div>
    </v-form>
  </GuestLayout>
</template>

<script setup>
import { ref } from 'vue';
import GuestLayout from '@/layouts/GuestLayout.vue';
import { useRouter } from 'vue-router';

const router = useRouter();
const loading = ref(false);
const verificationLinkSent = ref(false);

const resendVerification = async () => {
  loading.value = true;
  try {
    console.log('Resend verification email');
    // await axios.post('/api/email/verification-notification');
    setTimeout(() => {
        verificationLinkSent.value = true;
    }, 1000);
  } catch (error) {
    console.error('Failed to resend', error);
  } finally {
    loading.value = false;
  }
};

const logout = async () => {
  try {
      console.log('Logout');
    // await axios.post('/api/logout');
    // router.push({ name: 'Login' });
  } catch (error) {
    console.error('Logout failed', error);
  }
};
</script>

<style scoped>
.glowing-text {
  text-shadow: 0 0 20px rgba(56, 189, 248, 0.5);
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

.gap-4 {
  gap: 16px;
}

.letter-spacing-2 {
  letter-spacing: 2px;
}
</style>
