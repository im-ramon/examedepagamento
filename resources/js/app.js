/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import router from './router.js'
import Vuex from 'Vuex';
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        backupForm: false,
        dadosFinanceiros: false,
        activeUser: false,
        contrachequeAtivo: false,
        valorDescontosCC_array_atual: '-',
        valorReceitasCC_array_atual: '-',
        observacoes: '-',
    }
})
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
Vue.component('login-component', require('./views/Login.vue').default);
Vue.component('home-component', require('./components/Home.vue').default);
Vue.component('gerarcontracheque-component', require('./views/GerarContracheque.vue').default);
Vue.component('gerenciarcontracheque-component', require('./views/GerenciarContracheque.vue').default);
Vue.component('ajuda-component', require('./components/Ajuda.vue').default);
Vue.component('ondeencontrar-component', require('./components/OndeEncontrar.vue').default);
Vue.component('loading-component', require('./components/Loading.vue').default);
Vue.component('botao-component', require('./components/Botao.vue').default);
Vue.component('welcome-component', require('./views/Welcome.vue').default);
Vue.component('register-component', require('./views/Register.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store
});
