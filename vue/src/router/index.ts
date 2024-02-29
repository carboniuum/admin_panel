import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router'
import Register from '@/public/Register.vue'
import Login from '@/public/Login.vue'
import Secure from '@/secure/Secure.vue'
import Dashboard from '@/secure/dashboard/Dashboard.vue'
import Users from '@/secure/users/Users.vue'
import UsersCreate from '@/secure/users/Create.vue'
import UsersEdit from '@/secure/users/Edit.vue'
import Roles from '@/secure/roles/Roles.vue'
import RolesCreate from '@/secure/roles/Create.vue'
import RolesEdit from '@/secure/roles/Edit.vue'
import Products from '@/secure/products/Products.vue'
import ProductsCreate from '@/secure/products/Create.vue'
import ProductsEdit from '@/secure/products/Edit.vue'
import Orders from '@/secure/orders/Orders.vue'
import OrderItems from '@/secure/orders/OrderItems.vue'
import Profile from '@/secure/profile/Profile.vue'

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
            {path: '/profile', name: 'Profile', component: Profile},
            {path: '/users', name: 'Users', component: Users},
            {path: '/users/create', name: 'Users.Create', component: UsersCreate},
            {path: '/users/:id/edit', name: 'Users.Edit', component: UsersEdit},
            {path: '/roles', name: 'Roles', component: Roles},
            {path: '/roles/create', name: 'Roles.Create', component: RolesCreate},
            {path: '/roles/:id/edit', name: 'Roles.Edit', component: RolesEdit},
            {path: '/products', name: 'Products', component: Products},
            {path: '/products/create', name: 'Products.Create', component: ProductsCreate},
            {path: '/products/:id/edit', name: 'Products.Edit', component: ProductsEdit},
            {path: '/orders', name: 'Orders', component: Orders},
            {path: '/orders/:id', name: 'OrderDetails', component: OrderItems}
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
