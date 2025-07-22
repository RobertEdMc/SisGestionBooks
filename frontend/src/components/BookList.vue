<template>
  <div>
    <h2>📚 Libros</h2>
    <table>
      <thead>
        <tr><th>ID</th><th>Título</th><th>Descripción</th><th>Autor</th><th>Acciones</th></tr>
      </thead>
      <tbody>
        <tr v-for="lib in libros" :key="lib.id">
          <td>{{ lib.id }}</td>
          <td><input v-model="lib.title" /></td>
          <td><input v-model="lib.description" /></td>
          <td>{{ lib.author?.name || 'Sin autor' }}</td>
          <td>
            <button @click="actualizarLibro(lib)">💾</button>
            <button @click="eliminarLibro(lib.id)">🗑️</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted } from 'vue';
import axios from 'axios';
import type { Book } from '../types/models';

export default defineComponent({
  setup() {
    const libros = ref<Book[]>([]);
    const API = 'http://localhost:8000/api';
    const token = localStorage.getItem('token');

    const cargarLibros = async () => {
      const res = await axios.get(`${API}/libs`);
      libros.value = res.data;
    };

    const eliminarLibro = async (id: number) => {
      if (!confirm('¿Eliminar este libro?')) return;
      await axios.delete(`${API}/libs/${id}`, {
        headers: { Authorization: `Bearer ${token}` }
      });
      await cargarLibros();
    };

    const actualizarLibro = async (libro: Book) => {
      await axios.put(`${API}/libs/${libro.id}`, {
        title: libro.title,
        description: libro.description,
        author_id: libro.author.id
      }, {
        headers: { Authorization: `Bearer ${token}` }
      });
      alert('Libro actualizado');
    };

    onMounted(cargarLibros);

    return { libros, eliminarLibro, actualizarLibro, cargarLibros};
  }
});
</script>
