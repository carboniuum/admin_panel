import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Register from '@/public/Register.vue'
import Login from '@/public/Login.vue'
import Secure from '@/secure/Secure.vue'
import Dashboard from '@/secure/dashboard/Dashboard.vue'
import Users from '@/secure/users/Users.vue'
import UsersCreate from '@/secure/users/Create.vue'
import UsersEdit from '@/secure/users/Edit.vue'

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
            {path: '/users', name: 'Users', component: Users},
            {path: '/users/create', name: 'Users.Create', component: UsersCreate},
            {path: '/users/:id/edit', name: 'Users.Edit', component: UsersEdit}
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
