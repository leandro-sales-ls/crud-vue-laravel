import Vue from 'vue'
import VueRouter from 'vue-router'
import Usuarios from '../views/usuarios/Usuarios.vue'
import UsuarioForm from '../views/usuarios/UsuarioForm.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Usuarios',
    component: Usuarios
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/cadastrar',
    name: 'UsuarioForm',
    component: UsuarioForm,
    props: true,
  },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
