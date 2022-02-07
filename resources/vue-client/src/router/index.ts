import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Register from '@/public/Register.vue'
import Login from '@/public/Login.vue'
import Secure from '@/secure/Secure.vue'
import Dashboard from '@/secure/dashboard/Dashboard.vue'
import Users from '@/secure/users/Users.vue'

const routes: Array<RouteRecordRaw> = [
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '',
        name: 'Secure',
        component: Secure,
        children: [
            {path: '', redirect: '/dashboard'},
            {path: '/dashboard', name: 'Dashboard', component: Dashboard},
            {path: '/users', name: 'Users', component: Users}
        ]
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    }
]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
