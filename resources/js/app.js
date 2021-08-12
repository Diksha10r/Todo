/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vue from 'vue'

import { createInertiaApp } from '@inertiajs/inertia-vue'

import { InertiaApp } from '@inertiajs/inertia-vue'
// import PortalVue from 'portal-vue';
// import { store } from './store';

Vue.use(InertiaApp);
// Vue.use(PortalVue);

// const app=document.getElementById('app');
// new Vue({
//   render : (h) => h(InertiaApp,{
//     props:{
//       initialPage :JSON.parse(app.dataset.page),
//       resolveComponent : name => require(`./Pages/${name}`).default,
//     },
//   }),
// }).$mount(app);

import VueSessionStorage from 'vue-sessionstorage'
Vue.use(VueSessionStorage)

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props }) {
    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})

// window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('index', require('./Pages/Dashboard/index.vue').default);
// Vue.component('layout', require('./Shared/layout.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
