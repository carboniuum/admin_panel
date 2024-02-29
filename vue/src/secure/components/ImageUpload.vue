<template>
    <label class="btn btn-primary">
        Upload <input type="file" hidden @change="upload($event.target.files)" />
    </label>
</template>

<script>
import axios from 'axios'

export default {
    name: "ImageUpload",
    emits: ['fileUploaded'],
    props: ['id'],

    setup(props, {emit}) {
        const upload = async (files) => {
            const file = files.item(0)

            const data = new FormData()
            if (props.id) {
                data.append('id', props.id)
            }
            data.append('image', file)

            const response = await axios.post('upload', data)
            emit('fileUploaded', response.data.url)
        }

        return {
            upload
        }
    }
}
</script>
