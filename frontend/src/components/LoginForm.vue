<template>
  <div>
    <h2>🔐 Iniciar sesión</h2>
    <form @submit.prevent="login">
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Contraseña" required minlength="6" />
      <button type="submit">Entrar</button>
    </form>
    <p v-if="error" style="color: red;">{{ error }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  emits: ['login-success'],
  setup(_, { emit }) {
    const email = ref('');
    const password = ref('');
    const error = ref('');
    const API = 'http://localhost:8000/api';

    const login = async () => {
      error.value = '';
      if (password.value.length < 6) {
        error.value = 'La contraseña debe tener al menos 6 caracteres';
        return;
      }

      try {
        const res = await axios.post(`${API}/login`, {
          email: email.value,
          password: password.value
        });
        if (res.data.token) {
          localStorage.setItem('token', res.data.token);
          emit('login-success', res.data.token);
        } else {
          error.value = res.data.message || 'Credenciales inválidas';
        }
      } catch (err: any) {
        if (err.response?.status === 401) {
          error.value = 'Email o contraseña incorrectos';
        } else {
          error.value = err.response?.data?.message || 'Error al iniciar sesión';
        }
      }
    };

    return { email, password, error, login };
  }
});
</script>
