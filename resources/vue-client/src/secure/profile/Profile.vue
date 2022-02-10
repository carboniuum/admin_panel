<template>
    <h2>Account Details</h2>
    <hr />
    <form @submit.prevent="submitInfo">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" v-model="firstName" />
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" v-model="lastName" />
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" v-model="email" />
        </div>

        <button class="btn btn-outline-secondary">Save</button>
    </form>

    <h2 class="mt-4">Change password</h2>
    <hr />
    <form @submit.prevent="submitPassword">
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" v-model="password" />
        </div>

        <div class="form-group">
            <label>Password Confirm</label>
            <input type="password" class="form-control" v-model="passwordConfirm" />
        </div>

        <button class="btn btn-outline-secondary">Save</button>
    </form>
</template>

<script lang="ts">
import {ref, onMounted, computed} from 'vue'
import axios from 'axios'
import {User} from '@/classes/user'
import {useStore} from 'vuex'

export default {
    name: "Profile",

    setup() {
        const firstName = ref('')
        const lastName = ref('')
        const email = ref('')
        const password = ref('')
        const passwordConfirm = ref('')
        const store = useStore()

        const submitInfo = async () => {
            const response = await axios.put('users/info', {
                first_name: firstName.value,
                last_name: lastName.value,
                email: email.value
            })

            const u: User = response.data

            await store.dispatch('user/setUser', new User(
                u.id,
                u.first_name,
                u.last_name,
                u.email,
                u.role,
                u.permissions
            ))
        }

        const submitPassword = async () => {
            await axios.put('users/password', {
                password: password.value,
                password_confirm: passwordConfirm.value
            })

            password.value = ''
            passwordConfirm.value = ''
        }

        onMounted(async () => {
            const user = computed(() => store.state.user.user)

            firstName.value = user.value.first_name
            lastName.value = user.value.last_name
            email.value = user.value.email
        })

        return {
            firstName,
            lastName,
            email,
            password,
            passwordConfirm,
            submitInfo,
            submitPassword
        }
    }
}
</script>

<style scoped>

</style>
