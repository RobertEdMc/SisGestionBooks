<template>
  <div>
    <h2>🧑‍🎓 Autores</h2>
    <table>
      <thead>
        <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Total Libros</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <tr v-for="autor in autores" :key="autor.id">
          <td>{{ autor.id }}</td>
          <td><input v-model="autor.name" /></td>
          <td><input v-model="autor.email" /></td>
          <td>{{ autor.total_books }}</td>
          <td>
            <button @click="actualizarAutor(autor)">💾</button>
            <button @click="eliminarAutor(autor.id)">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import axios from 'axios';
import type { Author } from '../types/models';

export default defineComponent({
  setup() {
    const autores = ref<Author[]>([]);
    const API = 'http://localhost:8000/api';
    const token = localStorage.getItem('token');

    const cargarAutores = async () => {
      const res = await axios.get(`${API}/authors`);
      autores.value = res.data;
    };

    const actualizarAutor = async (autor: Author) => {
      await axios.put(`${API}/authors/${autor.id}`, {
        name: autor.name,
        email: autor.email
      }, {
        headers: { Authorization: `Bearer ${token}` }
      });
      alert('Autor actualizado');
    };

    const eliminarAutor = async (id: number) => {
      if (!confirm('¿Eliminar este autor?')) return;
      await axios.delete(`${API}/authors/${id}`, {
        headers: { Authorization: `Bearer ${token}` }
      });
      await cargarAutores();
    };

    onMounted(cargarAutores);

    return { autores, actualizarAutor, eliminarAutor, cargarAutores };
  }
});
</script>
