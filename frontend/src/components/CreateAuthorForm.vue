<template>
  <div>
    <h2>➕ Crear Autor</h2>
    <form @submit.prevent="crearAutor">
      <input v-model="name" placeholder="Nombre" required minlength="3" />
      <input v-model="email" type="email" placeholder="Email" required />
      <button type="submit">Crear</button>
    </form>
    <p v-if="success" style="color: green;">{{ success }}</p>
    <p v-if="error" style="color: red;">{{ error }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  emits: ['autor-creado'],
  setup(_, { emit }) {
    const name = ref('');
    const email = ref('');
    const error = ref('');
    const success = ref('');
    const API = 'http://localhost:8000/api';
    const token = localStorage.getItem('token');

    const crearAutor = async () => {
      error.value = '';
      success.value = '';

      // Validación JS adicional
      if (name.value.length < 3) {
        error.value = 'El nombre debe tener al menos 3 caracteres';
        return;
      }

      try {
        const res = await axios.post(`${API}/authors`, {
          name: name.value,
          email: email.value
        }, {
          headers: { Authorization: `Bearer ${token}` }
        });

        success.value = 'Autor creado correctamente';
        emit('autor-creado');
        name.value = '';
        email.value = '';
      } catch (err: any) {
        if (err.response?.status === 422) {
          error.value = 'Datos inválidos. Verifica los campos.';
        } else if (err.response?.status === 401) {
          error.value = 'No autorizado. Inicia sesión.';
        } else {
          error.value = err.response?.data?.message || 'Error al crear autor';
        }
      }
    };

    return { name, email, error, success, crearAutor };
  }
});
</script>
