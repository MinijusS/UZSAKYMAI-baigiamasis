<template>
    <div class="card">
        <div class="card-header">
            <span>Sukurti užsakymą</span>
            <button class="btn btn-outline-danger" @click="clear">Išvalyti</button>
        </div>
        <form class="card-body order-products" action="/orders" method="post">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="product_count" :value="input_count.length">
            <div class="order-info">
                <h3>Pagrindinė užsakymo informacija</h3>
                <div class="info-row" v-for="(input, index) in input_count" :key="input">
                    <select class="select-css" :name="'quantity-' +index" id="quantity">
                        <option v-for="quantity in 20" :value="quantity">{{quantity}}</option>
                    </select>
                    <select id="product" class="select-css" :name="'product-' +index">
                        <option v-for="product in products" :value="product.id">{{product.name}}</option>
                    </select>
                    <select id="size" class="select-css" :name="'size-' +index">
                        <option :value="1">M</option>
                        <option :value="2">D</option>
                    </select>
                    <select id="sauce" class="select-css" :name="'sauce-' + index">
                        <option :value="0">-</option>
                        <option v-for="sauce in sauces" :value="sauce.id">{{sauce.name}}</option>
                    </select>
                    <button class="btn btn-outline-danger order-delete" @click="removeProduct(index)"><i
                        class="material-icons">close</i></button>
                </div>

            </div>
            <div class="order-details">
                <h3>Papildoma užsakymo informacija</h3>
                <div class="inputs">
                    <div>
                        <label for="address">Adresas</label>
                        <input class="select-css" id="address" name="address" type="text"
                               placeholder="Vilniaus g. 112B">
                    </div>
                    <div>
                        <label for="tel">Tel. Nr.</label>
                        <input class="select-css" id="tel" name="phone" type="tel" placeholder="860560288">
                    </div>
                    <div>
                        <label for="additional">Papildoma informacija</label>
                        <textarea class="select-css" id="additional" name="additional"
                                  placeholder="(Nebūtina)"></textarea>
                    </div>
                    <div>
                        <label>Padarysime už.</label>
                        <select class="select-css" name="end_time">
                            <option selected disabled>-</option>
                            <option value="5">5min</option>
                            <option value="10">10min</option>
                            <option value="15">15min</option>
                            <option value="20">20min</option>
                            <option value="30">30min</option>
                            <option value="45">45min</option>
                            <option value="60">60min</option>
                            <option value="75">1val 15min</option>
                            <option value="90">1val 30min</option>
                            <option value="105">1val 45min</option>
                            <option value="120">2val</option>
                        </select>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-primary add-product" @click.prevent="addProduct">Pridėti patiekalą</button>
            <button class="btn btn-success create-order">Sukurti užsakyma</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: [],
        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                products: [],
                sauces: [],
                input_count: [{}],
            }
        },
        methods: {
            read() {
                axios.get('/api/order_create').then(response => {
                    response.data.products.forEach(product => {
                        this.products.push(product);
                    });
                    response.data.sauces.forEach(sauce => {
                        this.sauces.push(sauce);
                    })
                });
            },
            addProduct() {
                this.input_count.push({});
            },
            removeProduct(index) {
                this.input_count.splice(index, 1);
            },
            clear() {
                this.input_count = [{}];
            }
        },
        mounted() {
            this.read();
        }
    }
</script>
