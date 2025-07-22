<template>
  <div>
    <LoginForm @login-success="handleLogin" />
    <RegisterForm />
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import LoginForm from '../components/LoginForm.vue';
import RegisterForm from '../components/RegisterForm.vue';
import { useRouter } from 'vue-router';

export default defineComponent({
  components: { LoginForm, RegisterForm },
  setup() {
    const router = useRouter();
    const handleLogin = (token: string) => {
      localStorage.setItem('token', token);
      router.push('/dashboard');
    };
    return { handleLogin };
  }
});
</script>
