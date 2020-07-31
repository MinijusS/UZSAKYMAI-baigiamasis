<template>
    <div class="order-list">
        <div class="order" v-for="order in orders">
            <div>
                <h3><i class="material-icons">access_time</i> Liko: <span class="time">{{order.time_left}}</span></h3>
                <span class="created_at">Sukurta: {{format(order.created_at)}}</span>
                <div class="line"></div>
                <button v-if="order.status !== 2" @click="cancel(order.id)" class="btn btn-outline-danger order-delete">
                    <i
                        class="material-icons">clear</i></button>
            </div>
            <ul>
                <li class="product" v-for="item in order.ordered_items">
                    {{ item.quantity }} x {{ item.product.name }} {{ size(item.size) }} ({{sauce(item.sauce_id)}})
                </li>
            </ul>
            <div class="order_summary">
                <span v-if="order.address != null">Adresas: <a :href="'https://maps.google.com/?q=' + order.address +'+Radviliskis'"
                                                               target="_blank" class="bold">{{order.address}}</a></span>
                <span v-if="order.phone != null">Tel: <a :href="'tel:' + order.phone"
                                                         class="bold">{{order.phone}}</a></span>
                <span v-if="order.additional != null">Papildoma info: <span
                    class="bold">{{order.additional}}</span></span>
            </div>
            <div class="action-buttons" v-if="order.status === 0">
                <button class="btn btn-success" @click="done(order.id)"><i class="material-icons">check</i></button>
                <a :href="'/orders/' + order.id + '/edit'" class="btn btn-outline-primary order-send"><i
                    class="material-icons">create</i></a>
            </div>
            <div class="action-button" v-if="order.status === 1 || order.status === 2">
                <button class="btn btn-primary" style="width: 100%" @click="revert(order.id)"><i class="material-icons">replay</i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from "moment";

    export default {
        props: ['orders'],
        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                orders: [],
                sauces: []
            }
        },
        methods: {
            format(val) {
                return moment(val).format('MM-DD HH:mm');
            },
            done(id) {
                this.orders.forEach(order => {
                    if (order.id === id) {
                        order.status = 1;
                        axios.post('/api/orders/' + order.id + '/done', {
                            data: order,
                            headers: {
                                'Content-Type': 'text/plain;charset=utf-8',
                            }
                        }).catch(error => console.log(error));
                    }
                })
            },
            revert(id) {
                this.orders.forEach(order => {
                    if (order.id === id) {
                        order.status = 0;
                        axios.post('/api/orders/' + order.id + '/revert', {
                            data: order,
                            headers: {
                                'Content-Type': 'text/plain;charset=utf-8',
                            }
                        }).catch(error => console.log(error));
                    }
                })
            },
            cancel(id) {
                this.orders.forEach(order => {
                    if (order.id === id) {
                        order.status = 2;
                        axios.post('/api/orders/' + order.id + '/cancel', {
                            data: order,
                            headers: {
                                'Content-Type': 'text/plain;charset=utf-8',
                            }
                        }).catch(error => console.log(error));
                    }
                })
            },
            sauce(id) {
                return id != 0 ? this.sauces[id].name : '-';
            },
            size(id) {
                switch (id) {
                    case '1':
                        return 'M';
                    case '2':
                        return 'D';
                }
            }
        },
        mounted() {
            axios.get('/api/orders').then(response => {
                response.data.sauces.forEach((sauce) => {
                    this.sauces[sauce.id] = sauce;
                });
            });
        }
    }
</script>
