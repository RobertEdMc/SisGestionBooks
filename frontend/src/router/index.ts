import { createRouter, createWebHistory } from 'vue-router';
import type { RouteRecordRaw } from 'vue-router';
import Login from '../views/Login.vue';
import Dashboard from '../views/Dashboard.vue';

const routes: RouteRecordRaw[] = [
  { path: '/', component: Login },
  { path: '/dashboard', component: Dashboard }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

//  Protección de rutas
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  if (to.path === '/dashboard' && !token) {
    next('/');
  } else {
    next();
  }
});

export default router;
