
import Vue from 'vue';
Vue.config.devtools = true;


require('./bootstrap');

window.Vue = Vue;

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('reply', require('./components/Reply.vue').default);


const app = new Vue({
    el: '#vueapp'
});
