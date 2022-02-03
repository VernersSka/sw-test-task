import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/addproduct',
    name: 'AddProduct',
    // route level code-splitting
    // this generates a separate chunk (addproduct.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import('../views/AddProduct.vue'),
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
