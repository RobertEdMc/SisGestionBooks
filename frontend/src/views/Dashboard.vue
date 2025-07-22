<template>
  <div>
    <CreateBookForm @libro-creado="refrescarLibros" />
    <BookList ref="bookList" />
    <CreateAuthorForm @autor-creado="refrescarAutores" />
    <AuthorList ref="authorList" />
    <h2>📤 Exportar Autores y Libros</h2>
    <button @click="exportarExcel">Descargar Excel</button>
    <button @click="logout">Cerrar sesión</button>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import CreateBookForm from '../components/CreateBookForm.vue';
import BookList from '../components/BookList.vue';
import CreateAuthorForm from '../components/CreateAuthorForm.vue';
import AuthorList from '../components/AuthorList.vue';
import { useRouter } from 'vue-router';

export default defineComponent({
  components: { CreateBookForm, BookList, CreateAuthorForm, AuthorList },
  setup() {
    const bookList = ref();
    const authorList = ref();
    const router = useRouter();

    const refrescarLibros = () => bookList.value?.cargarLibros();
    const refrescarAutores = () => authorList.value?.cargarAutores();

    const exportarExcel = () => {
      window.location.href = 'http://localhost:8000/api/export';
    };

    const logout = () => {
      localStorage.removeItem('token');
      router.push('/');
    };

    return { bookList, authorList, refrescarLibros, refrescarAutores, exportarExcel, logout };
  }
});
</script>
