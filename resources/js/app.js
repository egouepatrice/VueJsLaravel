require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router';
import VueClipboard from 'vue-clipboard2'

Vue.use(VueRouter);
Vue.use(VueClipboard);

//Administrator import vues
import index from './components/administrator/index.vue';

//Visitor import vues
import home from './components/home.vue';
import page from './components/visitor/page.vue';


Vue.component('main_element', require('./components/main.vue').default);
Vue.component('admin_home', require('./components/administrator/index').default);

const routes = [
    // Administrator routes

    // Visitor routes
    { path: "/", component: home },
    { path: "/page", component: page },

];

const router = new VueRouter({ routes });

const app = new Vue({
    el: '#app',
    router: router
});