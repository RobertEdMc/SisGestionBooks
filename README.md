# SisGestionBooks
# 📚 Sistema de Gestión de Libros y Autores

Aplicación web desarrollada con Vue 3 + TypeScript y Laravel 12x para gestionar libros, autores y usuarios. Incluye autenticación, exportación en Excel y validaciones.

## 🛠️ Tecnologías

- Frontend: Vue 3 + Vite + TypeScript
- Backend: Laravel 12x + Sanctum
- Base de datos: PostgreSQL
- Estilos: TailwindCSS (opcional)

## ⚙️ Instalación

##  Frontend
```bash
cd frontend
npm install
npm run dev
```
### Backend

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```
### Base deDatos
Este proyecto utiliza PostgreSQL como motor de base de datos.

1. Crear una base de datos local llamada `sisgestionbooks` (puedes usar pgAdmin, DBeaver o CLI):

   CREATE DATABASE sisgestionbooks;

2. Configurar el archivo `.env` del backend con las credenciales:

   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=sisgestionbooks
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña

3. Ejecutar migraciones para crear las tablas necesarias:

   php artisan migrate

4. (Opcional) Sembrar datos de prueba si tienes seeders:

   php artisan db:seed

## 🔐 Funcionalidades

- Registro y login con token
- CRUD de libros
- CRUD de autores
- Exportación en Excel
- Validaciones HTML5 + JS
- Manejo de errores HTTP
- Rutas protegidas por token

## 📁 Estructura

SisGestionBooks/ 
    ├── backend/ ← Laravel API
    ├── frontend/ ← Vue 3 + Vite + TypeScript 
    └── README.md ← Documentación del proyecto

### 🧪 6. Pruebas

1. Regístrate como nuevo usuario
2. Inicia sesión
3. Accede al dashboard
4. Crea libros y autores
5. Edita y elimina registros
6. Exporta en Excel

## 📦 Cositas a tener en cuenta

- El token se guarda en localStorage
- Axios se usa para consumir la API
- Las rutas están protegidas con Vue Router
- Las relaciones entre libros y autores se manejan en el backend

## Endpoints de el API REST

🔐 AUTENTICACIÓN Y USUARIO

POST    /api/register         → Registro de nuevo usuario (sin token)
POST    /api/login            → Login y obtención de token (sin token)
POST    /api/logout           → Cierre de sesión (requiere token)
GET     /api/user             → Obtener perfil del usuario autenticado (requiere token)

📚 CRUD DE LIBROS

GET     /api/libs             → Listar todos los libros
POST    /api/libs             → Crear nuevo libro (requiere token)
GET     /api/libs/{id}        → Ver detalle de un libro
PUT     /api/libs/{id}        → Actualizar libro (requiere token)
DELETE  /api/libs/{id}        → Eliminar libro (requiere token)


🧑‍🎓 CRUD DE AUTORES

GET     /api/authors          → Listar todos los autores
POST    /api/authors          → Crear nuevo autor (requiere token)
GET     /api/authors/{id}     → Ver detalle de un autor
PUT     /api/authors/{id}     → Actualizar autor (requiere token)
DELETE  /api/authors/{id}     → Eliminar autor (requiere token)


📤 EXPORTACIÓN EN EXCEL

GET     /api/export           → Exportar autores y libros en archivo .xlsx


===========================
🧪 Ejemplos de testeo con cURL
===========================

🔐 Login

curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"usuario@example.com","password":"tu_clave"}'

📚 Crear libro

curl -X POST http://localhost:8000/api/libs \
  -H "Authorization: Bearer TU_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"title":"Nuevo libro","description":"Descripción","autor_id":1}'

📤 Exportar Excel

curl -O http://localhost:8000/api/export

