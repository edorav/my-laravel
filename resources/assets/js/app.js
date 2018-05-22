
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.config.devtools = true;
Vue.config.performance = true;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//https://vuejsdevelopers.com/2018/02/05/vue-laravel-crud/



Vue.component('new-trip-component', require('./components/NewTrip.vue'));

Vue.component('my-profile', require('./components/MyProfile.vue'));

Vue.component('trip-list', require('./components/TripList.vue'));

const app = new Vue({
    el: '#app'
});
