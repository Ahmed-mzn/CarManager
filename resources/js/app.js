/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

import VueElementLoading from 'vue-element-loading'

Vue.component('VueElementLoading', VueElementLoading)

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

import "animate.css/animate.css";

import VueLazyload from 'vue-lazyload';
Vue.use(VueLazyload);

import moment from 'moment';
import { Form, HasError, AlertError } from "vform";

import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);

import Swal from 'sweetalert2';
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});
window.Swal = Swal;
window.Toast = Toast;


Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.component('pagination', require('laravel-vue-pagination'));
window.Form = Form;

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import VueProgressBar from 'vue-progressbar';
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options)

import Dashboard from "./components/Dashboard.vue";
import Profile from "./components/Profile.vue";
import Users from "./components/Users.vue";
import Cars from "./components/Cars.vue";
import CarDetails from "./components/CarDetails.vue";
import NotFound from "./components/NotFound.vue";
import Invoice from "./components/Invoice.vue";
import AchatCar from "./components/AchatCar.vue";
import ProprietaireList from "./components/ProprietaireList.vue";
import ProprietaireDetails from "./components/ProprietaireDetails.vue";
import CarList from "./components/CarList.vue";
import Vue from 'vue';
let routes = [
    { path: '/dashboard', component: Dashboard, name:"dashboard"},
    { path: '/profile', component: Profile},
    { path: '/users', component: Users},
    { path: '/cars', component: Cars},
    { path: '/cars/:id', component: CarDetails, name:"carDetails"},
    { path: '/carList', component: CarList},
    { path: '', component: Cars},
    { path: '/invoice', component: Invoice, name:"invoice"},
    { path: '/achat', component: AchatCar, name:"achat"},
    { path: '/proprietaire', component: ProprietaireList},
    { path: '/proprietaire/:id', component: ProprietaireDetails},
    { path: '*', component: NotFound}
]



Vue.config.productionTip = false;
const router = new VueRouter({
    mode: 'history',
    routes
})

Vue.filter('uperText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
});
Vue.filter('uper', function(text){
    return text.toUpperCase();
});

Vue.filter('myDate', function(created){
    return moment(created).locale('fr').format('LLL');
});
Vue.filter('moment', function(created){
    return moment(created).locale('fr').calendar();
});
Vue.filter('time', function(created){
    return moment(created).locale('fr').format('L');
});

Vue.filter('Currency', num => {
    if (!num) {
        return '0.00';
    }
    const number = (num / 1).toFixed(2).replace(' ', '.');
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ' ');
});

window.Fire = new Vue();
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
    router,
    data:{
        search: ''
    },
    methods:{
        searchit: _.debounce(() => {
            Fire.$emit('searching');

        },1000)
    }
});
