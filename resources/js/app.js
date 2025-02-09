/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue';
import App from './app.vue';
import '/css/surdash.css';
import axios from 'axios';

require('./bootstrap');

axios.defaults.baseURL = "http://127.0.0.1:8000";
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

import router from './router'; // Import the router

// Register components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('about-us', require('./components/landing.vue').default);
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router, // Use the router
    render: h => h(App)
});


