<template>
    <div class="menu">
        <div class="category" v-for="category in categories">
            <h2>{{category.name}}</h2>
            <div class="products">
                <div v-for="product in products" class="card" v-if="product.category_id == category.id">
                    <div class="card-header">
                        <h4>{{product.name}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-image">
                            <img
                                :src="product.photo">
                        </div>
                        <div class="description">
                            <span>{{product.description}}</span>
                        </div>
                        <div class="prices">
                            <div class="price" v-if="product.price_small != 0">
                                <span>M</span>
                                <span>{{product.price_small}}€</span>
                            </div>
                            <div class="price" v-if="product.price_big != 0">
                                <span>D</span>
                                <span>{{product.price_big}}€</span>
                            </div>
                        </div>
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
                products: [],
                categories: [],
            }
        },
        methods: {},
        mounted() {
            axios.get('/api/products').then(response => {
                response.data.products.forEach(product => {
                    this.products.push(product);
                });
                response.data.categories.forEach(category => {
                    this.categories.push(category);
                });
            });
            console.log(this.categories);
        }
    }
</script>
