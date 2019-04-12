
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import Toasted from 'vue-toasted';

import router from './routes';
Vue.use(VueRouter)
Vue.use(Toasted)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.$backroutes = {
    departaments:"/products/departaments",
    categories:"/products/categories",
    products(id){
        if(id){
            return '/products/'+id
        }else{
            return '/products'
        }
    },
    image(cod){
        return "/products/images/"+cod
    },
}
window.rand_code = function (lon){
    var code = ""
    var chars = "0123456789abcdefABCDEF"
    for (let x = 0; x < lon; x++) {
        var rand = Math.floor(Math.random()*chars.length);
        code += chars.substr(rand, 1);
    }
    return code;
}  

const app = new Vue({
    router

}).$mount('#app');
