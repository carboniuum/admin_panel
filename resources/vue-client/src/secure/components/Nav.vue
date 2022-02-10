<template>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Admin Panel Demo</a>

        <nav class="my-2 my-md-0 mr-md-3">
            <router-link
                :to="{name: 'Profile'}"
                class="p-2 text-white"
            >
                {{user?.name}}
            </router-link>
            <a
                class="p-2 text-white"
                href="javascript:void(0)"
                @click="logout"
            >
                Log out
            </a>
        </nav>
    </nav>
</template>

<script>
import {useRouter} from 'vue-router'
import {useStore} from 'vuex'
import {computed} from 'vue'

export default {
    name: "Nav",

    setup() {
        const router = useRouter()
        const store = useStore()

        const user = computed(() => store.state.user.user)

        const logout = () => {
            localStorage.clear()
            router.push({name: 'Login'})
        }

        return {
            user,
            logout
        }
    }
}
</script>

<style scoped>

</style>
