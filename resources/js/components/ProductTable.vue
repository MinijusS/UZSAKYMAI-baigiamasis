<template>
    <div>
        <div class="table-action">
            <a href="/products/create" class="btn btn-primary"><i class="material-icons">add</i> Pridėti
                produktą</a>
            <search-bar @input="filterProducts"></search-bar>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
            <th>Pavadinimas</th>
            <th>Aprašymas</th>
            <th>Kategorija</th>
            <th>€ M.</th>
            <th>€ D.</th>
            <th>Nuotrauka</th>
            <th>Veiksmai</th>
            </thead>
            <div v-if="loading === true" class="sk-chase">
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
                <div class="sk-chase-dot"></div>
            </div>
            <tbody v-if="loading === false">
            <tr v-for="product in filtered">
                <td>{{product.name}}</td>
                <td>{{product.description}}</td>
                <td>{{categories[product.category_id] ? categories[product.category_id].name : 'Nera kategorijos'}}</td>
                <td>{{product.price_small}}€</td>
                <td>{{product.price_big}}€</td>
                <td><img :src="product.photo" style="width:50px;height:50px"></td>
                <td class="table-action-buttons"><a class="btn btn-primary" :href="'/products/' + product.id + '/edit'"><i
                    class="material-icons">create</i></a>
                    <form :action="'/products/' + product.id" method="post">
                        <input type="hidden" name="_method" value="delete">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <button class="btn btn-danger"><i class=" material-icons">clear</i></button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                products: [],
                categories: [[]],
                filtered: [],
                loading: true
            }
        },
        props: [],
        methods: {
            filterProducts(val) {
                if (val != '') {
                    this.filtered = this.products.filter(function (item) {
                        return item.name.toLowerCase().includes(val.toLowerCase()) || item.description.toLowerCase().includes(val.toLowerCase());
                    });
                } else {
                    this.filtered = this.products;
                }
            }
        },
        computed: {},
        mounted() {
            axios.get('/api/products')
                .then(response => {
                    response.data.products.forEach(product => {
                        this.products.push(product);
                    });
                    response.data.categories.forEach(category => {
                        this.categories.push(category);
                    });
                })
            .then(() => this.loading = false);
            this.filtered = this.products;
        }
    }
</script>
