<template>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Title</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in orderItems" :key="item.id">
                <td>{{item.id}}</td>
                <td>{{item.product_title}}</td>
                <td>${{item.price}}</td>
                <td>${{item.quantity}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import {ref, onMounted} from 'vue'
import axios from 'axios'
import {useRoute} from 'vue-router'

export default {
    name: "OrderItems",

    setup() {
        const orderItems = ref([])
        const {params} = useRoute()

        onMounted(async () => {
            const response = await axios.get(`orders/${params.id}`)
            orderItems.value = response.data.data.order_items
        })

        return {
            orderItems
        }
    }
}
</script>

<style scoped>

</style>
