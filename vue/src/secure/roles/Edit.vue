<template>
    <form @submit.prevent="submit">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" v-model="name" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Permissions</label>
            <div class="col-sm-10">
                <div
                    v-for="permission in permissions"
                    :key="permission.id"
                    class="form-check form-check-inline col-3"
                >
                    <input
                        :value="permission.id"
                        :checked="checked(permission.id)"
                        @change="check(permission.id, $event.target.checked)"
                        type="checkbox"
                        class="form-check-input"
                    />
                    <label class="form-check-label">{{permission.name}}</label>
                </div>
            </div>
        </div>

        <button class="btn btn-outline-secondary">Save</button>
    </form>
</template>

<script lang="ts">
import {ref, onMounted} from 'vue'
import axios from 'axios'
import {useRoute, useRouter} from 'vue-router'
import {Role} from '@/classes/role'

export default {
    name: "Edit",

    setup() {
        const name = ref('')
        const permissions = ref([])
        const selected = ref([] as number[])
        const router = useRouter()
        const {params} = useRoute()

        const check = (id: number, checked: boolean) => {
            if (checked) {
                selected.value = [...selected.value, id]
                return
            }

            selected.value = selected.value.filter(s => s !== id)
        }

        const checked = (id: number) => selected.value.some(s => s === id)

        const submit = async () => {
            await axios.put(`roles/${params.id}`, {
                name: name.value,
                permissions: selected.value
            })

            await router.push({name: 'Roles'})
        }

        onMounted(async () => {
            const response = await axios.get('permissions')
            permissions.value = response.data.data

            const getRole = await axios.get(`roles/${params.id}`)
            const role: Role = getRole.data.data
            name.value = role.name
            selected.value = role.permissions.map(p => p.id)
        })

        return {
            name,
            permissions,
            check,
            checked,
            submit
        }
    }
}
</script>
