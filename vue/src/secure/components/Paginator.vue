<template>
    <div>
        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <a @click="prev" href="javascript:void(0)" class="page-link">Previous</a>
                </li>
                <li class="page-item">
                    <a @click="next" href="javascript:void(0)" class="page-link">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import {ref} from 'vue'

export default {
    name: "Paginator",
    props: {
        lastPage: Number
    },
    emits: ['pageChanged'],

    setup(props, {emit}) {
        const page = ref(1)

        const prev = async () => {
            if (page.value === 1) {
                return
            }

            page.value--
            emit('pageChanged', page.value)
        }

        const next = async () => {
            if (page.value === props.lastPage) {
                return
            }

            page.value++
            emit('pageChanged', page.value)
        }

        return {
            prev,
            next
        }
    }
}
</script>
