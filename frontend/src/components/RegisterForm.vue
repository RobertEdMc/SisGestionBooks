<template>
  <div>
    <h2>📝 Registro</h2>
    <form @submit.prevent="register">
      <input v-model="name" placeholder="Nombre" required minlength="3" />
      <input v-model="email" type="email" placeholder="Email" required />
      <input v-model="password" type="password" placeholder="Contraseña" required minlength="6" />
      <input v-model="confirmPassword" type="password" placeholder="Confirmar contraseña" required minlength="6" />
      <button type="submit">Registrar</button>
    </form>
    <p v-if="success" style="color: green;">{{ success }}</p>
    <p v-if="error" style="color: red;">{{ error }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  setup() {
    const name = ref('');
    const email = ref('');
    const password = ref('');
    const confirmPassword = ref('');
    const success = ref('');
    const error = ref('');
    const API = 'http://localhost:8000/api';

    const register = async () => {
      error.value = '';
      success.value = '';

      if (name.value.length < 3 || password.value.length < 6) {
        error.value = 'Nombre mínimo 3 caracteres, contraseña mínimo 6';
        return;
      }

      if (password.value !== confirmPassword.value) {
        error.value = 'Las contraseñas no coinciden';
        return;
      }

      try {
        const res = await axios.post(`${API}/register`, {
          name: name.value,
          email: email.value,
          password: password.value,
          password_confirmation: confirmPassword.value,
        });
        success.value = res.data.message || 'Usuario registrado correctamente';
        name.value = '';
        email.value = '';
        password.value = '';
        confirmPassword.value = '';
      } catch (err: any) {
        error.value = err.response?.data?.message || 'Error al registrar';
      }
    };

    return { name, email, password, confirmPassword, success, error, register };
  }
});
</script>
