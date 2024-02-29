<template>
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
        <div class="sidebar-sticky pt-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link
                        :to="{name: 'Dashboard'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Dashboard
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        v-if="user.canView('users')"
                        :to="{name: 'Users'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Users
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        v-if="user.canView('roles')"
                        :to="{name: 'Roles'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Roles
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        v-if="user.canView('products')"
                        :to="{name: 'Products'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Products
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        v-if="user.canView('orders')"
                        :to="{name: 'Orders'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Orders
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
import {computed} from 'vue'
import {useStore} from 'vuex'

export default {
    name: "Sidebar",

    setup() {
        const store = useStore()
        const user = computed(() => store.state.user.user)

        return {
            user
        }
    }
}
</script>

<style scoped>

</style>
