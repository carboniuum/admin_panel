<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="btn-toolbar mb-2 mb-md-0">
            <router-link
                :to="{name: 'Roles.Create'}"
                class="btn btn-sm btn-outline-secondary"
            >
                Create
            </router-link>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="role in roles" :key="role.id">
                    <td>{{role.id}}</td>
                    <td>{{role.name}}</td>
                    <td>
                        <div class="btn-group mr-2">
                            <router-link
                                :to="{name: 'Roles.Edit', params: {id: role.id}}"
                                class="btn btn-sm btn-outline-secondary"
                            >
                                Edit
                            </router-link>
                            <a
                                href="javascript:void(0)"
                                class="btn btn-sm btn-outline-secondary"
                                @click="remove(role.id)"
                            >
                                Delete
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script lang="ts">
import {ref, onMounted} from 'vue'
import axios from 'axios'
import {Entity} from "@/interfaces/entity";

export default {
    name: "Roles",

    setup() {
        const roles = ref([])

        const remove = async (id: number) => {
            if (confirm('Are you sure you want to delete this role?')) {
                await axios.delete(`/roles/${id}`)

                roles.value = roles.value.filter((e: Entity) => e.id !== id)
            }
        }

        onMounted(async () => {
            const response = await axios.get('roles')

            roles.value = response.data.data
        })

        return {
            roles,
            remove
        }
    }
}
</script>
