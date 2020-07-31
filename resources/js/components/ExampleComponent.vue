<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        time: {{c_time}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                c_time: null
            }
        },
        props: ['time'],
        mounted() {
            let vm = this;
            this.c_time = this.time;
            setInterval(function () {
                vm.c_time--;
            }, 1000)
        }
    }
</script>
