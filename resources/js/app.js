/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var moment = require('moment');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/Dashboard.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('dashboard', require('./components/Dashboard.vue').default);
Vue.component('product-list', require('./components/ProductList.vue').default);
Vue.component('order-card', require('./components/OrderCard.vue').default);
Vue.component('sort-buttons', require('./components/SortButtons.vue').default);
Vue.component('orders', require('./components/Orders.vue').default);
Vue.component('order-create', require('./components/OrderCreate.vue').default);
Vue.component('order-edit', require('./components/OrderEdit.vue').default);
Vue.component('search-bar', require('./components/SearchBar.vue').default);
Vue.component('product-table', require('./components/ProductTable.vue').default);
Vue.component('app-places', require('./components/Places.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
