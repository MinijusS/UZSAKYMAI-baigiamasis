<template>
    <input class="select-css" id="address-input" name="address" type="search"
           placeholder="Vilniaus g. 112B"></template>
<script>
    import places from 'places.js';

    export default {
        props: {
            apiKey: {
                type: String,
                required: false,
            },
            appId: {
                type: String,
                required: false,
            },
            type: {
                type: String,
                required: false,
            },
        },
        data() {
            return { instance: null };
        },
        mounted() {
            // make sure Vue does not know about the input
            // this way it can properly unmount
            this.input = document.querySelector('#address-input');

            this.instance = places({
                apiKey: this.apiKey,
                appId: this.appId,
                type: this.type,
                container: this.input,
            });

            this.instance.on('change', e => {
                this.$emit('change', e);
            });
        },
        beforeDestroy() {
            this.instance.off('change');
            this.instance.destroy();
        },
        watch: {
            type(newVal) {
                this.instance.configure({
                    type: newVal,
                });
            },
        },
    };
</script>
