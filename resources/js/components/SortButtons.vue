<template>
    <div class="sorts">
        <button @click="$emit('status', 3); changeStatus(3)" class="btn btn-outline-dark" v-bind:class="status == 3 ? 'active' : ''">Visi</button>
        <button @click="$emit('status', 0); changeStatus(0)" class="btn btn-outline-primary" v-bind:class="status == 0 ? 'active' : ''">Ruošiami</button>
        <button @click="$emit('status', 1); changeStatus(1)" class="btn btn-outline-success" v-bind:class="status == 1 ? 'active' : ''">Padaryti</button>
        <button @click="$emit('status', 2); changeStatus(2)" class="btn btn-outline-danger" v-bind:class="status == 2 ? 'active' : ''">Atšaukti</button>
    </div>
</template>

<script>
    export default {
        props: [],
        data: function() {
            return {
                status: 0
            }
        },
        methods: {
            changeStatus(val) {
                this.status = val;
            }
        },
        mounted() {
        }
    }
</script>
