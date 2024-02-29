<template>
    <form @submit.prevent="submit">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" v-model="firstName">
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" v-model="lastName">
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" v-model="email">
        </div>

        <div class="form-group">
            <label>Role</label>
            <select class="form-control" v-model="roleId">
                <option value="0">Select Role</option>
                <option
                    v-for="role in roles"
                    :key="role.id"
                    :value="role.id"
                >
                    {{role.name}}
                </option>
            </select>
        </div>

        <button class="btn btn-outline-secondary">Save</button>
    </form>
</template>

<script>
import {ref, onMounted} from 'vue'
import axios from 'axios'
import {useRouter} from 'vue-router'

export default {
    name: "Create",

    setup() {
        const firstName = ref('')
        const lastName = ref('')
        const email = ref('')
        const roleId = ref(0)
        const roles = ref([])
        const router = useRouter()

        const submit = async () => {
            await axios.post('users', {
                first_name: firstName.value,
                last_name: lastName.value,
                email: email.value,
                role_id: roleId.value,
            })

            await router.push({name: 'Users'})
        }

        onMounted(async () => {
            const response = await axios.get('roles')

            roles.value = response.data.data
        })

        return {
            firstName,
            lastName,
            email,
            roleId,
            roles,
            submit
        }
    }
}
</script>
