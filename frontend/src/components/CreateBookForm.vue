<template>
  <div>
    <h2>➕ Crear Libro</h2>
    <form @submit.prevent="crearLibro">
      <input v-model="title" placeholder="Título" required />
      <input v-model="description" placeholder="Descripción"/>
      <input v-model="author_id" type="number" placeholder="ID del Autor" required />
      <button type="submit">Crear</button>
    </form>
    <p v-if="error" style="color: red;">{{ error }}</p>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import axios from 'axios';

export default defineComponent({
  emits: ['libro-creado'],
  setup(_, { emit }) {
    const title = ref('');
    const description = ref('');
    const author_id = ref<number | null>(null);
    const error = ref('');
    const API = 'http://localhost:8000/api';
    const token = localStorage.getItem('token');

    const crearLibro = async () => {
      error.value = '';
      try {
        await axios.post(`${API}/libs`, {
          title: title.value,
          description: description.value,
          author_id: author_id.value
        });
        emit('libro-creado');
        title.value = '';
        description.value = '';
        author_id.value = null;
      } catch (err: any) {
        error.value = err.response?.data?.message || err;
      }
    };

    return { title, description, author_id, error, crearLibro };
  }
});
</script>
