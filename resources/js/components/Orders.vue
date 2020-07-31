<template>
    <div class="orders">
        <sort-buttons @status="getOrders"></sort-buttons>
        <h2 v-if="sorted_orders.length <= 0">Užsakymų kolkas nėra</h2>
        <div v-if="loading === true" class="sk-chase">
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
            <div class="sk-chase-dot"></div>
        </div>
        <order-card v-if="loading === false" :orders="sorted_orders"></order-card>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        props: [],
        data: function () {
            return {
                orders: [],
                display_orders: [],
                sorted_orders: [],
                status: 0,
                loading: true
            }
        },
        methods: {
            read() {
                axios.get('/api/orders').then(response => {
                    response.data.orders.forEach(order => {
                        this.orders.push(order);
                    });
                });
            },
            getOrders(val) {
                this.status = val;
                this.display_orders = [];
                this.sorted_orders = [];
                this.orders.forEach(order => {
                    if (this.status === 3) { //3 stands for ALL ORDERS
                        this.display_orders.push(order);
                    } else if (order.status === this.status) {
                        this.display_orders.push(order);
                    }
                });
                this.loading = false;
                this.sorted_orders = this.display_orders.slice().sort((a, b) => moment(a.end_time).format('HHmmss') - moment(b.end_time).format('HHmmss'));
            }
        },
        mounted() {
            this.read();
            setInterval(function () {
                this.display_orders.forEach(order => {
                    let now = moment();
                    let distance = moment(order.end_time).subtract(now);
                    order.time_left = distance.unix() > 0 ? distance.zone(0).format('HH:mm:ss') : '--:--';
                });
                this.getOrders(this.status);
            }.bind(this), 500);
        }
    }
</script>
