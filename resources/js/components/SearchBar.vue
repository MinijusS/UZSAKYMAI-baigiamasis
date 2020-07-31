<template>
    <div class="search">
        <input type="text" v-on:keyup="query = $event.target.value; $emit('input', query)" placeholder="Paieška..." class="select-css">
    </div>
</template>

<script>
    export default {
        props: [],
        data: function () {
            return {
                query: ''
            }
        },
        mounted() {

        }
    }
</script>
