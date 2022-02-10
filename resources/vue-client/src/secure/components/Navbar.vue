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
                        :to="{name: 'Users'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Users
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        :to="{name: 'Roles'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Roles
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link
                        :to="{name: 'Products'}"
                        active-class="active"
                        class="nav-link"
                    >
                        Products
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "Navbar"
    }
</script>

<style scoped>

</style>
