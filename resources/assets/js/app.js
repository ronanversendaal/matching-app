
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
window.Vue = require('vue');
Vue.prototype.$http = axios;
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// var vueResource = require('vue-axios')
// Vue.use(vueResource);

// Vue.$http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');


Slick = require('vue-slick');
Vue.use(Slick);

Simplert = require('vue2-simplert');
Vue.use(Simplert);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('picker', require('./components/Picker.vue'));

const app = new Vue({
    el: '#app'
});
